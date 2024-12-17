export function isDeviceHoverable() {
  return window.matchMedia('(hover: hover) and (pointer: fine)')?.matches;
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
