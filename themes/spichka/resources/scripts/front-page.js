import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import { Navigation } from "swiper/modules";

/**
 * Application entrypoint
 */
domReady(async () => {
  const sliders = document.querySelectorAll('.swiper-container');
  sliders.forEach((container) => {
    const conf = {
      direction: 'horizontal',
      loop: false,
      grabCursor: true,
      spaceBetween: 10,
      slidesPerView: 1,
      breakpoints: {
        370: {
          slidesPerView: 2,
        },
        680: {
          slidesPerView: 3,
        },
        992: {
          slidesPerView: 5,
        },
        1400: {
          slidesPerView: 6,
        },
      },

      navigation: {
        nextEl: container.querySelector('.swiper-button-next'),
        prevEl: container.querySelector('.swiper-button-prev'),
      },

      modules: [Navigation],
    };

    new Swiper(container.querySelector('.swiper'), conf);
  });
});
