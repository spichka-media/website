import domReady from '@roots/sage/client/dom-ready';

import Swiper from 'swiper';

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
    loop: true,
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
