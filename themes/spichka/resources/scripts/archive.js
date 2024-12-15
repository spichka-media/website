/* global gtag */
import domReady from '@roots/sage/client/dom-ready';

domReady(async () => {
  registerPaginationLinkEvents();
});

function registerPaginationLinkEvents() {
  if (typeof gtag !== 'function') {
    return;
  }

  const paginationLinks = document.querySelectorAll('a.page-numbers.page-link');

  paginationLinks.forEach((link) => {
    link.addEventListener('click', function () {
      gtag('event', 'pagination_click', {
        event_category: 'Pagination',
        event_label: this.href,
        value: this.textContent,
      });
    });
  });
}
