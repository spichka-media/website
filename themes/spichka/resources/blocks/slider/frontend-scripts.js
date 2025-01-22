import domReady from '@roots/sage/client/dom-ready';
import {initSliders} from '../../scripts/lib/swiper.js';

domReady(async () => {
  initSliders(
    {
      centeredSlides: true,
      centeredSlidesBounds: true,
    },
    '[data-swiper-type="article-images-block"]',
  );
});
