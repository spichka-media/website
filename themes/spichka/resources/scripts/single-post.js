import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  document.addEventListener('scroll', scrolled);
});

function scrolled() {
  var h = document.documentElement,
    b = document.body,
    st = 'scrollTop',
    sh = 'scrollHeight';
  var p = parseInt(
    ((h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight)) * 100,
  );

  const progress = document.querySelector(
    '#single-post-progressbar .progress-bar',
  );
  const bar = document.querySelector('#single-post-progressbar');

  if (!progress || !bar) {
    return;
  }

  progress.style.width = `${p}%`;

  bar.setAttribute('aria-valuenow', `${p}%`);
}
