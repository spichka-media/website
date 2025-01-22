import {Swiper} from 'swiper';
import {Navigation, Pagination} from 'swiper/modules';

export const initSliders = (options, targetSelector) => {
  const sliders = document.querySelectorAll(
    '.swiper-block' + (targetSelector || ''),
  );

  for (const container of sliders) {
    const paginationBulletsNode = container.querySelector(
      '.swiper-pagination-bullets',
    );
    const paginationFractionNode = container.querySelector(
      '.swiper-pagination-fractions',
    );
    const navigationNextNode = container.querySelector('.swiper-button-next');
    const navigationPrevNode = container.querySelector('.swiper-button-prev');

    let pagination = null;
    if (paginationBulletsNode) {
      pagination = {
        el: paginationBulletsNode,
        type: 'bullets',
        clickable: true,
      };
    }
    if (paginationFractionNode) {
      pagination = {
        el: paginationFractionNode,
        type: 'fraction',
        renderFraction: function (currentClass, totalClass) {
          return `<span class="${currentClass}"></span>/<span class="${totalClass}"></span>`;
        },
      };
    }

    let navigation = null;
    if (navigationNextNode) {
      if (!navigation) navigation = {};
      navigation.nextEl = navigationNextNode;
    }
    if (navigationPrevNode) {
      if (!navigation) navigation = {};
      navigation.prevEl = navigationPrevNode;
    }

    const modules = [];
    if (navigation) modules.push(Navigation);
    if (pagination) modules.push(Pagination);

    const conf = {
      navigation: navigation,
      pagination: pagination,
      modules: modules,

      direction: 'horizontal',
      loop: false,
      grabCursor: true,
      slidesPerView: 'auto',
      spaceBetween: 20,
      ...options,
    };

    new Swiper(container.querySelector('.swiper'), conf);
  }
};
