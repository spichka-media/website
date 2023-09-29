import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap'; // TODO: Later leave only needed modules

/**
 * Application entrypoint
 */
domReady(async () => {
  // ...
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
