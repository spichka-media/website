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

/**
 * Setup click listeners on all [data-gtag-event] elements
 * Emits gtag event with value in the attribute
 */
export function setupGtagAttributeListener() {
  if (typeof gtag !== 'function') {
    return;
  }

  const elements = document.querySelectorAll('[data-gtag-event]');

  for (const element of elements) {
    const value = element.getAttribute('data-gtag-event');
    element.addEventListener('click', () => {
      emitGtagEvent(value);
    });
  }
}
