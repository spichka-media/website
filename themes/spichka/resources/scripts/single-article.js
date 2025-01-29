import domReady from '@roots/sage/client/dom-ready';
import {checkVisible, isDeviceHoverable} from './lib/utils.js';

/**
 * Application entrypoint
 */
domReady(async () => {
  setTimeout(progress, 1000);
  document.addEventListener('scroll', progress);

  if (!isDeviceHoverable()) {
    callToActionCircle();
  }
});

function progress() {
  const content = document.getElementById('content');

  const progress = document.querySelector(
    '#single-article-progressbar .progress-bar',
  );

  const bar = document.querySelector('#single-article-progressbar');

  if (!content || !progress || !bar) {
    return;
  }

  const {top, height} = content.getBoundingClientRect();

  if (top > 0) {
    progress.style.width = `0%`;

    bar.style.width = `100%`;
    bar.style.position = `absolute`;

    bar.setAttribute('aria-valuenow', `0%`);

    return;
  }

  const srollableContentHeight = height - window.innerHeight;

  const scrolled = (Math.abs(top) / srollableContentHeight) * 100;

  progress.style.width = `${scrolled}%`;

  bar.setAttribute('aria-valuenow', `${scrolled}%`);
}

function callToActionCircle() {
  const elementsList = document.getElementsByClassName('call-to-action');
  // just in case keep min value synched with size value in scss
  const [min, max] = [45, 60];
  const range = max - min;

  document.addEventListener('scroll', () => {
    for (const element of elementsList) {
      if (!checkVisible(element)) {
        return;
      }

      const rect = element.getBoundingClientRect();

      const viewHeight = Math.max(
        document.documentElement.clientHeight,
        window.innerHeight,
      );

      const viewHeightHalf = viewHeight / 2;

      // shift of the center of the block relatively to center of the screen
      const shift = rect.top + rect.height / 2 - viewHeightHalf;

      // if passed center - lock on 100% size
      const percent = shift > 0 ? (viewHeightHalf - shift) / viewHeightHalf : 1;

      // applying percent only to the diff between min and max
      // so resulting value is always between min and max
      element.style.setProperty(
        '--clip-path-size',
        min + percent * range + '%',
      );
    }
  });
}
