import {getHeadlinersData} from './fetch.js'
import {initDisposableIntersectionObserver} from './observer.js'
import {createHeadlinerListController} from './controllers.js'
import { Tooltip } from 'bootstrap';

const isMobile = /Mobi|Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent)
         || 'ontouchstart' in window;

export function initPortraits() {

  const elementForObserve = document.querySelector('#theme-main-footer');

  initDisposableIntersectionObserver(() => {
    const headlinersData = getHeadlinersData()?.theme_portraits;
    if (!headlinersData || headlinersData?.length === 0) return;

    const headlinersPortraitElement = document.querySelector('#theme-main-footer-image');
    const headlinersWrapperElement = document.querySelector('#theme-main-footer-image-wrapper');

    const controller = createHeadlinerListController(headlinersData);
    const tooltip = new Tooltip(headlinersWrapperElement, { placement: 'right', offset: ({ placement, popper }) => {
      const verticalOffset = placement === 'right' ? -popper.height / 2 : 0;
      return [verticalOffset, 30];
    }});

    if (isMobile) {
      headlinersPortraitElement.addEventListener('click', () => {
        const currentState = headlinersPortraitElement.getAttribute('data-state');

        if (!currentState || currentState === 'standard') {
          headlinersPortraitElement.setAttribute('data-state', 'hover');
          headlinersPortraitElement.src = controller.getHeadlinerPortraitURL();
          tooltip.setContent({ '.tooltip-inner': controller.getHeadlinerQuote() });
        } else {
          headlinersPortraitElement.setAttribute('data-state', 'standard');
          controller.changeHeadliner();
          headlinersPortraitElement.src = controller.getHeadlinerPortraitURL();
          tooltip.setContent({ '.tooltip-inner': controller.getHeadlinerQuote() });
        }
      });
    } else {
      headlinersWrapperElement.addEventListener('show.bs.tooltip', function () {
        headlinersPortraitElement.src = controller.getHeadlinerPortraitURL();
        tooltip.setContent({ '.tooltip-inner': controller.getHeadlinerQuote() });
      });

      headlinersPortraitElement.addEventListener('click', () => {
        controller.changeHeadliner();
        headlinersPortraitElement.src = controller.getHeadlinerPortraitURL();
        tooltip.setContent({ '.tooltip-inner': controller.getHeadlinerQuote() });
      });
    }
  }, elementForObserve)
}


