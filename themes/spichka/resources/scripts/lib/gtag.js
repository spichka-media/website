/* global gtag */

/**
 *
 * @param {string} name
 * @param {string} [category]
 * @param {string} [label]
 * @param {string|number} [value]
 * @returns void
 */
export function emitGtagEvent(name, category, label, value) {
  if (typeof gtag !== 'function') {
    return;
  }

  gtag('event', name, {
    event_category: category,
    event_label: label,
    value,
  });
}
