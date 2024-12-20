import {isDeviceHoverable, preloadImages} from './utils.js';
import {shuffle} from 'lodash-es';
import {emitGtagEvent} from './gtag.js';
import Tooltip from 'bootstrap/js/dist/tooltip';

/**
 * @typedef {import('./portraits.d.ts').ThemeOptionsResponse} ThemeOptionsResponse
 * @typedef {import('./portraits.d.ts').Portrait} Portrait
 */

export async function initPortraits() {
  const footerImage = document.getElementById('footer-image');
  if (!footerImage) {
    console.error('Footer portrait element not found');
    return;
  }

  const tooltip = new Tooltip(footerImage);
  const observer = new IntersectionObserver(
    (entries) => {
      const entry = entries[0];
      if (entry.isIntersecting) {
        setupPortraitLogic(footerImage, tooltip);
        observer.disconnect();
      }
    },
    {root: null, rootMargin: '0px 0px 1000px 0px'},
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

    let portraits = getPortraits(data);

    let portraitIndex = 0;
    let quoteIndex = 0;
    const {staticImage, alt} = portraits[portraitIndex];
    let blinkStop;

    preloadPortraitImages(portraits, portraitIndex);

    footerImage.src = staticImage;
    footerImage.alt = alt;
    footerImage.removeAttribute('width');
    footerImage.removeAttribute('height');

    footerImage.addEventListener('mouseenter', () => {
      if (blinkStop) {
        blinkStop();
      }

      if (!isDeviceHoverable()) {
        return;
      }

      const {extraImage} = portraits[portraitIndex];
      const quote = portraits[portraitIndex].quotes[quoteIndex];

      footerImage.src = extraImage;

      tooltip.setContent({
        '.tooltip-inner': quote,
      });

      emitGtagEvent('portrait_quote_change');
    });

    footerImage.addEventListener('mouseleave', () => {
      const {staticImage} = portraits[portraitIndex];

      footerImage.src = staticImage;

      if (!isDeviceHoverable()) {
        return;
      }

      quoteIndex = (quoteIndex + 1) % portraits[portraitIndex].quotes.length;
    });

    let changePortrait = true;

    footerImage.addEventListener('click', () => {
      if (blinkStop) {
        blinkStop();
      }

      if (isDeviceHoverable()) {
        portraitIndex = (portraitIndex + 1) % portraits.length;
        quoteIndex = 0;

        preloadPortraitImages(portraits, portraitIndex);

        const {staticImage} = portraits[portraitIndex];

        footerImage.src = staticImage;

        tooltip.hide();

        emitGtagEvent('portrait_change');

        return;
      }

      changePortrait = !changePortrait;

      if (changePortrait) {
        portraitIndex = (portraitIndex + 1) % portraits.length;

        preloadPortraitImages(portraits, portraitIndex);

        if (portraitIndex === 0) {
          portraits = shuffle(portraits);

          quoteIndex =
            (quoteIndex + 1) % portraits[portraitIndex].quotes.length;
        }

        const {staticImage} = portraits[portraitIndex];

        footerImage.src = staticImage;

        tooltip.hide();
        emitGtagEvent('portrait_change');
        return;
      }

      const {extraImage} = portraits[portraitIndex];
      const quote = portraits[portraitIndex].quotes[quoteIndex];

      footerImage.src = extraImage;

      tooltip.setContent({
        '.tooltip-inner': quote,
      });

      tooltip.show();

      emitGtagEvent('portrait_quote_change');
    });

    const observer = new IntersectionObserver(
      (entries) => {
        const entry = entries[0];
        if (entry.isIntersecting) {
          blinkStop = initBlink(
            footerImage,
            portraits[portraitIndex].staticImage,
            portraits[portraitIndex].extraImage,
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
    preloadImages([portrait.staticImage, portrait.extraImage]);
  }
}

/**
 * @param {ThemeOptionsResponse} data
 * @return {Portrait[]}
 */
function getPortraits(data) {
  /** @type {Portrait[]} */
  const portraits = data.theme_portraits.map(
    ({static_image, extra_image, quotes, alt}) => {
      return {
        staticImage: static_image,
        alt,
        extraImage: extra_image,
        quotes: shuffle(quotes.map(({quote}) => quote)),
      };
    },
  );

  return shuffle(portraits);
}
