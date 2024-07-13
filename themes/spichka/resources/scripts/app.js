import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap/js/dist/offcanvas';

/**
 * Application entrypoint
 */
domReady(async () => {
  searchInputHandler();
});

function searchInputHandler() {
  const searchInput = document.getElementById('search');
  const resetButton = document.getElementById('search-reset');

  if (!searchInput || !resetButton) {
    return;
  }

  searchInput.addEventListener('input', function () {
    displaySearchResetToggle(searchInput, resetButton);
  });
}

function displaySearchResetToggle(searchInput, resetButton) {
  if (searchInput.value.length > 0) {
    resetButton.classList.remove('d-none');
    resetButton.classList.add('d-block');
  } else {
    resetButton.classList.remove('d-block');
    resetButton.classList.add('d-none');
  }
}

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
