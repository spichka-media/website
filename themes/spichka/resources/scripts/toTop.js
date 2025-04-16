const TOP_DOCUMENT_POSITION = {left: 0, top: 0, behavior: 'smooth'};

export class ScrollButton {
  constructor() {
    this.prevIsHide = this.checkHide();
    this.button = document.createElement('button');
    this.button.id = 'nav-scroll-to-top';
    this.button.classList.add('btn', 'btn-nav', 'hide');

    const arrow = document.createElement('i');
    arrow.classList.add('fa-solid', 'fa-angle-up');
    this.button.appendChild(arrow);

    const footer = document.getElementsByTagName('footer')[0];
    footer.appendChild(this.button);

    this.button.addEventListener('click', this.onClick.bind(this));
    document.addEventListener('scroll', this.onDocumentScroll.bind(this));
  }

  onClick() {
    window.scrollTo(TOP_DOCUMENT_POSITION);
  }

  onDocumentScroll() {
    const isHide = this.checkHide();

    if (this.prevIsHide === isHide) {
      return;
    }

    this.prevIsHide = isHide;

    if (isHide) {
      this.showButton();
      return;
    }

    this.hideButton();
  }

  checkHide() {
    return document.documentElement.scrollTop > 200;
  }

  showButton() {
    this.button.classList.remove('hide');
    this.button.classList.toggle('show');
  }

  hideButton() {
    this.button.classList.remove('show');
    this.button.classList.toggle('hide');
  }
}

import.meta.webpackHot?.accept(ScrollButton);
