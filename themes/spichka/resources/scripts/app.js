import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap/js/dist/offcanvas';
import {searchInputHandler} from './lib/search.js';
import {initPortraits} from './lib/portraits';
import {setupGtagAttributeListener} from './lib/gtag.js';
import {ScrollButton} from './toTop.js';

/**
 * Application entrypoint
 */
domReady(async () => {
  searchInputHandler();
  initPortraits();
  setupGtagAttributeListener();
  new ScrollButton();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) {
  import.meta.webpackHot.accept(console.error);
}
