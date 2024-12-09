import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  setTimeout(scrolled, 1000);
  document.addEventListener('scroll', scrolled);
});

function scrolled() {
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
    bar.setAttribute('aria-valuenow', `0%`);

    return;
  }

  const srollableContentHeight = height - window.innerHeight;

  const scrolled = (Math.abs(top) / srollableContentHeight) * 100;

  progress.style.width = `${scrolled}%`;

  bar.setAttribute('aria-valuenow', `${scrolled}%`);
}
