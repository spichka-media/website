import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';

domReady(async () => {
  const sliders = document.querySelectorAll('.swiper-container');
  sliders.forEach((container) => {
    const conf = {
      direction: 'horizontal',
      loop: false,
      grabCursor: true,
      spaceBetween: 16,
      slidesPerView: 'auto',
      pagination: {
        el: container.querySelector('.swiper-pagination'),
        clickable: true,
      },

      modules: [Pagination],
    };

    new Swiper(container.querySelector('.swiper'), conf);
  });
});
