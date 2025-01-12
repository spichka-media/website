import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import {Navigation, Pagination} from 'swiper/modules';

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
      spaceBetween: 20,
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        renderFraction: function (currentClass, totalClass) {
          return `<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`;
        },
      },
      slidesPerView: 'auto',
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      modules: [Navigation, Pagination],
    };

    new Swiper(container.querySelector('.swiper'), conf);
  });
}
