export const toTopButton = async () => {
    var footer = document.getElementsByTagName('footer')[0];
    var toTop = document.createElement('button');
    toTop.style.visibility = 'hidden';
    toTop.setAttribute('id', 'scroll-to-top')
    toTop.classList.add('btn', 'btn-nav', 'hide')
    var arrow = document.createElement('i');
    arrow.classList.add('fa-solid', 'fa-angle-up')
    toTop.appendChild(arrow);
    toTop.addEventListener('click', toTopClick);
    footer.appendChild(toTop);
    document.addEventListener('scroll', toTopVisibility);
    document.addEventListener('DOMContentLoaded', toTopActivate);
  };
  
  function toTopActivate(){
    const toTop = document.getElementById('scroll-to-top');
    if (!toTop) {
      return;
    }
    toTop.style.visibility = 'visible';
  }
  function toTopVisibility(){
    const toTop = document.getElementById('scroll-to-top');
    if (!toTop) {
      return;
    }
    const visible = document.documentElement.scrollTop > 200;
    toTop.classList.toggle('show', visible);
    toTop.classList.toggle('hide', !visible);
  }
  function toTopClick(){
    window.scrollTo({left: 0, top: 0, behavior: 'smooth'});
  }
  
import.meta.webpackHot?.accept(toTopButton);