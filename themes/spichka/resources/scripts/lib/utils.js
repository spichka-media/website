/**
 *
 * @returns {boolean}
 */
export function isDeviceHoverable() {
  return window.matchMedia('(hover: hover) and (pointer: fine)').matches;
}

/**
 *
 * @param {string[]} urls
 */
export function preloadImages(urls) {
  for (const url of urls) {
    const image = new Image();
    image.src = url;
  }
}

/**
 * Checks whether any part visible
 * @param Element
 * @returns boolean
 */
export function checkVisible(elm) {
  const rect = elm.getBoundingClientRect();
  const viewHeight = Math.max(
    document.documentElement.clientHeight,
    window.innerHeight,
  );
  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}
