import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap'; // TODO: Later leave only needed modules

import Swiper from 'swiper';

// import masonry from 'masonry-layout'; // eslint-disable-line
/**
 * Application entrypoint
 */
domReady(async () => {
  const sliders = document.querySelectorAll('.swiper');
  const conf = {
    direction: 'horizontal',
    loop: true,
    slidesPerView: 5,
    // Responsive breakpoints
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
      },
      // when window width is >= 480px
      480: {
        slidesPerView: 2,
      },
      // when window width is >= 640px
      640: {
        slidesPerView: 5,
      },
    },
  };

  sliders.forEach((item) => {
    new Swiper(item, conf);
  });

  new Swiper('.swiper-connect', {
    direction: 'horizontal',
    loop: false,
    slidesPerView: 4,
    spaceBetween: 10,
    breakpoints: {
      // when window width is >= 320px
      320: {
        slidesPerView: 1,
      },
      // when window width is >= 480px
      480: {
        slidesPerView: 2,
      },
      // when window width is >= 640px
      640: {
        slidesPerView: 4,
      },
    },
  });
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
