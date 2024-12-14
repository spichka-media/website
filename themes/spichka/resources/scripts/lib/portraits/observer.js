/**
 * Устанавливает одноразовый наблюдатель пересечения элемента с вьюпортом (Intersection Observer).
 * Наблюдатель срабатывает когда элемент входит в область видимости, учитывая заданную дистанцию сверху.
 * После срабатывания наблюдатель автоматически отключается.
 *
 * @param {Function} callback - Функция, которая будет вызвана при попадании элемента в вьюпорт.
 * @param {Element} targetElement - HTML-элемент, за которым нужно наблюдать.
 * @param {number} [topDistance=200] - Дистанция в пикселях от верхнего края вьюпорта до элемента,
 * при достижении которой срабатывает наблюдатель.
 */
export const initDisposableIntersectionObserver = (callback, targetElement, topDistance = 200) => {
  const handler = () => {
    observer.unobserve(targetElement);
    callback();
  };

  const observer = new IntersectionObserver(handler, {
    rootMargin: `0px 0px ${topDistance}px 0px`,
    threshold: 0,
  });

  observer.observe(targetElement);
};
