import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';

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

  jQuery(document).scroll(() => scrolled());
});

function scrolled() {
  const container = document.getElementById('video-section-container');

  if (!container) {
    return;
  }

  const threshold = window.innerHeight / 3;
  const maxBlur = 20;
  const maxShift = 200;

  const {bottom} = container.getBoundingClientRect();

  if (bottom > threshold) {
    container.style.filter = `blur(0px)`;
    container.style.transform = `translateY(0px)`;
    return;
  }

  if (bottom <= 0) {
    return;
  }

  const blurPx = (1 - bottom / threshold) * maxBlur;

  const shiftPx = (1 - bottom / threshold) * maxShift;

  container.style.filter = `blur(${blurPx}px)`;
  container.style.transform = `translateY(-${shiftPx}px)`;
}
