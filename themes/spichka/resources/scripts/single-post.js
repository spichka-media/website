import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  jQuery(document).scroll(() => scrolled());
});

function scrolled() {
  var h = document.documentElement,
    b = document.body,
    st = 'scrollTop',
    sh = 'scrollHeight';
  var p = parseInt(
    ((h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight)) * 100,
  );

  jQuery('#single-post-progressbar .progress-bar').css('width', p + '%');
  jQuery('#single-post-progressbar').attr('aria-valuenow', p);
}
