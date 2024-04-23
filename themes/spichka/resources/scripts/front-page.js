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
    slidesPerView: 1,
    // Responsive breakpoints
    breakpoints: {
      // sm breakpoint
      576: {
        slidesPerView: 2,
      },
      // lg breakpoint
      992: {
        slidesPerView: 5,
      },
    },
  };

  sliders.forEach((item) => {
    new Swiper(item, conf);
  });
});
