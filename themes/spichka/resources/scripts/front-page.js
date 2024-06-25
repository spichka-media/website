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

  scrolled();

  jQuery(document).scroll(() => scrolled());

  document.addEventListener('mousemove', function (e) {
    const image = document.querySelector('.floating-image');

    if (!checkVisible(image)) {
      return;
    }

    const x = e.clientX / window.innerWidth - 0.5;
    const y = e.clientY / window.innerHeight - 0.5;

    const translateX = x * -75;
    const translateY = y * -100;
    const rotateX = y * -75;
    const rotateY = x * 75;

    image.style.transform = `translateX(${translateX}px) translateY(${translateY}px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
  });
});

function scrolled() {
  const container = document.getElementById('video-section-container');

  if (!container) {
    return;
  }

  const threshold = window.innerHeight / 2.5;
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

function checkVisible(elm) {
  var rect = elm.getBoundingClientRect();
  var viewHeight = Math.max(
    document.documentElement.clientHeight,
    window.innerHeight,
  );
  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}
