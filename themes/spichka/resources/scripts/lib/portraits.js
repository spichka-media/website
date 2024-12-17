// @ts-check

import * as bootstrap from 'bootstrap';
import {isDeviceHoverable, preloadImages} from './utils.js';
import {delay, shuffle} from 'lodash-es';

/**
 * @typedef {import('./portraits.d.ts').ThemeOptionsResponse} ThemeOptionsResponse
 * @typedef {import('./portraits.d.ts').Combination} Combination
 */

export async function initPortraits() {
  const footerImage = document.getElementById('footer-image');
  if (!footerImage) {
    console.error('Footer portrait element not found');
    return;
  }

  const tooltip = new bootstrap.Tooltip(footerImage);
  const observer = new IntersectionObserver(
    (entries) => {
      const entry = entries[0];
      if (entry.isIntersecting) {
        setupPortraitLogic(footerImage, tooltip);
        observer.disconnect();
      }
    },
    {root: null, rootMargin: '0px 0px 200px 0px'},
  );

  await observer.observe(footerImage);
}

async function setupPortraitLogic(footerImage, tooltip) {
  try {
    const response = await fetch('/wp-json/custom-fields/theme_options');

    /**
     * @type {ThemeOptionsResponse}
     */
    const data = await response.json();

    if (!data.theme_portraits || !data.theme_portraits.length) {
      console.error('No portraits data available');
      return;
    }

    const combinations = generateCombinations(data);

    let index = 0;
    const {staticImage, alt} = combinations[index];

    preloadCombinationImages(combinations, index);

    footerImage.src = staticImage;
    footerImage.alt = alt;

    let blinkingPaused = false;

    footerImage.addEventListener('mouseenter', () => {
      blinkingPaused = true;
      const {extraImage, quote} = combinations[index];

      footerImage.src = extraImage;

      tooltip.setContent({
        '.tooltip-inner': quote,
      });
    });

    footerImage.addEventListener('mouseleave', () => {
      blinkingPaused = false;

      const {staticImage} = combinations[index];

      footerImage.src = staticImage;
    });

    let changePortraitOnClick = false;

    footerImage.addEventListener('click', () => {
      const changePortrait = isDeviceHoverable() || changePortraitOnClick;

      if (changePortrait) {
        if (index + 1 >= combinations.length) {
          index = 0;
        } else {
          index++;
        }

        preloadCombinationImages(combinations, index);

        const {staticImage} = combinations[index];

        footerImage.src = staticImage;

        tooltip.hide();
        blinkingPaused = false;
      } else {
        blinkingPaused = true;
        const {extraImage, quote} = combinations[index];

        footerImage.src = extraImage;

        tooltip.setContent({
          '.tooltip-inner': quote,
        });

        tooltip.show();
      }

      if (!isDeviceHoverable()) {
        changePortraitOnClick = !changePortraitOnClick;
      }
    });

    setInterval(() => {
      if (blinkingPaused) {
        return;
      }

      const {staticImage, extraImage} = combinations[index];

      footerImage.src = extraImage;

      delay(() => {
        footerImage.src = staticImage;
      }, 500);
    }, 4000);
  } catch (err) {
    console.error('Error initializing portraits:', err);
    return;
  }
}

/**
 * @param {Combination[]} combinations
 * @param {number} index
 * @param {?number} extraCombinationAmount
 */
function preloadCombinationImages(
  combinations,
  index,
  extraCombinationAmount = 1,
) {
  for (let i = 0; i <= extraCombinationAmount; i++) {
    const currentIndex = (index + i) % combinations.length;

    const combination = combinations[currentIndex];
    preloadImages([combination.staticImage, combination.extraImage]);
  }
}

/**
 * @param {ThemeOptionsResponse} data
 * @return {Combination[]}
 */
function generateCombinations(data) {
  const combinations = [];

  data.theme_portraits.forEach((portrait) => {
    const {static_image, extra_images, quotes, alt} = portrait;

    extra_images.forEach((img) => {
      quotes.forEach((quote) => {
        combinations.push({
          staticImage: static_image,
          extraImage: img.extra_image,
          quote: quote.quote,
          alt,
        });
      });
    });
  });

  return shuffle(combinations);
}
