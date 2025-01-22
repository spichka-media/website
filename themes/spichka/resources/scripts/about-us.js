import domReady from '@roots/sage/client/dom-ready';
import {initSliders} from './lib/swiper.js';

domReady(async () => {
  initSliders({
    breakpoints: {
      0: {
        slidesPerGroup: 1,
        centeredSlides: true,
      },
      576: {
        slidesPerGroup: 2,
        centeredSlides: false,
      },
      768: {
        slidesPerGroup: 3,
      },
      992: {
        slidesPerGroup: 4,
      },
    },
  });
});
