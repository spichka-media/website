import domReady from '@roots/sage/client/dom-ready';

import {Swiper} from 'swiper';
import {Pagination} from 'swiper/modules';

/**
 * Application entrypoint
 */
domReady(async () => {
  initSliders();
  initBannerTransform();
  initFloatingImage();
});

function initBannerTransform() {
  applyBannerTransform();
  document.addEventListener('scroll', applyBannerTransform);
}

function applyBannerTransform() {
  const container = document.getElementById('video-section-container');

  if (!container) {
    return;
  }

  const maxBlur = 20;
  const maxShift = 200;

  const {bottom, y, top} = container.getBoundingClientRect();

  const threshold =
    400 + Math.min(window.innerHeight / 2, y / top + window.scrollY);

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

function initFloatingImage() {
  document.addEventListener('mousemove', function (e) {
    const image = document.querySelector('.floating-image');

    if (!image || !checkVisible(image)) {
      return;
    }

    const mouseX = e.clientX;
    const mouseY = e.clientY;
    const rect = image.getBoundingClientRect();
    const imageX = rect.left + rect.width / 2;
    const imageY = rect.top + rect.height / 2;

    // Calculate distance between mouse and image center
    const distX = mouseX - imageX;
    const distY = mouseY - imageY;

    // Calculate push effect
    const pushX = distX * 0.04; // Adjust 0.1 to control push intensity
    const pushY = distY * 0.04;

    // Calculate 3D slope effect
    const angleX = -distY * 0.04; // Adjust 0.05 to control slope intensity
    const angleY = distX * 0.04;

    // Apply transform with push and 3D slope effect
    image.style.transform = `translate(${pushX}px, ${pushY}px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
  });
}

function initSliders() {
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
}

function checkVisible(elm) {
  var rect = elm.getBoundingClientRect();
  var viewHeight = Math.max(
    document.documentElement.clientHeight,
    window.innerHeight,
  );
  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}
