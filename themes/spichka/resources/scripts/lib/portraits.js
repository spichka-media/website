// @ts-check

import * as bootstrap from 'bootstrap';
import {isDeviceHoverable, preloadImages} from './utils.js';
import {shuffle} from 'lodash-es';
import {emitGtagEvent} from './gtag.js';

/**
 * @typedef {import('./portraits.d.ts').ThemeOptionsResponse} ThemeOptionsResponse
 * @typedef {import('./portraits.d.ts').Combination} Combination
 * @typedef {import('./portraits.d.ts').Portrait} Portrait
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

    const portraits = getPortraits(data);

    let portraitIndex = 0;
    let combinationIndex = 0;
    const {staticImage, alt} = portraits[portraitIndex];
    let blinkStop;

    preloadPortraitImages(portraits, portraitIndex);
    preloadCombinationImages(portraits[portraitIndex], combinationIndex);

    footerImage.src = staticImage;
    footerImage.alt = alt;

    footerImage.addEventListener('mouseenter', () => {
      if (blinkStop) {
        blinkStop();
      }

      const {extraImage, quote} =
        portraits[portraitIndex].combinations[combinationIndex];

      footerImage.src = extraImage;

      tooltip.setContent({
        '.tooltip-inner': quote,
      });

      emitGtagEvent('portrait_combination_change');
    });

    footerImage.addEventListener('mouseleave', () => {
      const {staticImage} = portraits[portraitIndex];

      footerImage.src = staticImage;

      combinationIndex =
        (combinationIndex + 1) % portraits[portraitIndex].combinations.length;

      preloadCombinationImages(portraits[portraitIndex], combinationIndex);
    });

    let changePortraitOnClick = false;

    footerImage.addEventListener('click', () => {
      if (blinkStop) {
        blinkStop();
      }

      const changePortrait = isDeviceHoverable() || changePortraitOnClick;

      if (changePortrait) {
        portraitIndex = (portraitIndex + 1) % portraits.length;

        preloadPortraitImages(portraits, portraitIndex);
        preloadCombinationImages(portraits[portraitIndex], combinationIndex);

        const {staticImage} = portraits[portraitIndex];

        footerImage.src = staticImage;

        tooltip.hide();

        emitGtagEvent('portrait_change');
      } else {
        const {extraImage, quote} =
          portraits[portraitIndex].combinations[combinationIndex];

        footerImage.src = extraImage;

        tooltip.setContent({
          '.tooltip-inner': quote,
        });

        tooltip.show();

        combinationIndex =
          (combinationIndex + 1) % portraits[portraitIndex].combinations.length;

        preloadCombinationImages(portraits[portraitIndex], combinationIndex);

        emitGtagEvent('portrait_combination_change');
      }

      if (!isDeviceHoverable()) {
        changePortraitOnClick = !changePortraitOnClick;
      }
    });

    const observer = new IntersectionObserver(
      (entries) => {
        const entry = entries[0];
        if (entry.isIntersecting) {
          blinkStop = initBlink(
            footerImage,
            portraits[portraitIndex].staticImage,
            portraits[portraitIndex].combinations[combinationIndex].extraImage,
          );

          observer.disconnect();
        }
      },
      {root: null, threshold: 1},
    );

    await observer.observe(footerImage);
  } catch (err) {
    console.error('Error initializing portraits:', err);
    return;
  }
}
function initBlink(footerImage, staticImage, extraImage) {
  setTimeout(() => blink(footerImage, staticImage, extraImage), 1500);

  const handle = setInterval(
    () => blink(footerImage, staticImage, extraImage),
    3500,
  );

  return () => {
    clearInterval(handle);
  };
}
function blink(footerImage, staticImage, extraImage) {
  footerImage.src = extraImage;

  setTimeout(() => {
    footerImage.src = staticImage;
  }, 500);
}

/**
 * @param {Portrait[]} portraits
 * @param {number} portraitIndex
 * @param {?number} extraPortraitsAmount
 */
function preloadPortraitImages(
  portraits,
  portraitIndex,
  extraPortraitsAmount = 1,
) {
  for (let i = 0; i <= extraPortraitsAmount; i++) {
    const currentPortraitIndex = (portraitIndex + i) % portraits.length;

    const portrait = portraits[currentPortraitIndex];
    preloadImages([portrait.staticImage]);
  }
}

/**
 * @param {Portrait} portrait
 * @param {number} combinationIndex
 * @param {?number} extraCombinationAmount
 */
function preloadCombinationImages(
  portrait,
  combinationIndex,
  extraCombinationAmount = 1,
) {
  for (let i = 0; i <= extraCombinationAmount; i++) {
    const currentCombinationIndex =
      (combinationIndex + i) % portrait.combinations.length;

    const combination = portrait.combinations[currentCombinationIndex];
    preloadImages([combination.extraImage]);
  }
}

/**
 * @param {ThemeOptionsResponse} data
 * @return {Portrait[]}
 */
function getPortraits(data) {
  /** @type {Portrait[]} */
  const portraits = data.theme_portraits.map(
    ({static_image, extra_images, quotes, alt}) => {
      const combinations = [];

      extra_images.forEach((img) => {
        quotes.forEach((quote) => {
          combinations.push({
            extraImage: img.extra_image,
            quote: quote.quote,
          });
        });
      });

      return {
        staticImage: static_image,
        alt,
        combinations: shuffle(combinations),
      };
    },
  );

  return shuffle(portraits);
}
