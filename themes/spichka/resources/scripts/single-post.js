import domReady from '@roots/sage/client/dom-ready';

domReady(async () => {
  jQuery('blockquote > p').addClass('display-7');
  jQuery('blockquote > p').addClass('px-2')
});

