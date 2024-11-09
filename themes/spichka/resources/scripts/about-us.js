import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import {Autoplay, Pagination} from 'swiper/modules';

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
      autoplay: {
        delay: 5000,
        disableOnInteraction: true,
        pauseOnMouseEnter: true,
      },

      modules: [Pagination, Autoplay],
    };

    new Swiper(container.querySelector('.swiper'), conf);
  });
});
