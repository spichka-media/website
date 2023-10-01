import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap'; // TODO: Later leave only needed modules

import Glide from '@glidejs/glide';

/**
 * Application entrypoint
 */
domReady(async () => {
  const sliders = document.querySelectorAll('.glide');
  const conf = {
    type: 'carousel',
    startAt: 0,
    perView: 6,
  };
  sliders.forEach((item) => {
    new Glide(item, conf).mount();
  });

  new Glide('.connect', {
    ...conf,
    perView: 4,
  }).mount();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
