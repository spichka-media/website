import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import {Navigation} from 'swiper/modules';

domReady(async () => {
  initSliders();
});

function initSliders() {
  const sliders = document.querySelectorAll('.swiper-container');
  sliders.forEach((container) => {
    const conf = {
      direction: 'horizontal',
      loop: false,
      grabCursor: true,
      spaceBetween: 16,
      slidesPerView: 'auto',
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      modules: [Navigation],
    };

    new Swiper(container.querySelector('.swiper'), conf);
  });
}
