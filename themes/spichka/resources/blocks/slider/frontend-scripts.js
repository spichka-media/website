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
      centeredSlides: true,
      spaceBetween: 20,
      pagination: {
        el: container.querySelector('.swiper-pagination'),
        type: 'fraction',
        renderFraction: function (currentClass, totalClass) {
          return `<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`;
        },
      },
      slidesPerView: 'auto',
      navigation: {
        nextEl: container.querySelector('.swiper-button-next'),
        prevEl: container.querySelector('.swiper-button-prev'),
      },

      modules: [Navigation, Pagination],
    };

    new Swiper(container.querySelector('.swiper'), conf);
  });
}
