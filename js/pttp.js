hljs.initHighlightingOnLoad();


const toggle = document.querySelector('#menu-toggle');
const toggleElems = toggle.querySelectorAll('span');
const menu = document.querySelector('.nav-main');
const menuItems = menu.querySelectorAll('a');
const last = menuItems[menuItems.length - 1]

toggle.addEventListener('click', function(e) {
  if (toggle.getAttribute('aria-expanded') === 'false') {
      toggle.setAttribute('aria-expanded', 'true');
      menu.classList.remove('collapsed');
  } else {
      toggle.setAttribute('aria-expanded', 'false');
      menu.classList.add('collapsed');
  }
  return false;
});
toggle.addEventListener('keydown', function(e) {
  if ((e.key) === 'Tab') {
      if (e.shiftKey && toggle.getAttribute('aria-expanded') === 'true') {
        toggle.setAttribute('aria-expanded', 'false');
        menu.classList.add('collapsed');
      }
      return true;
  }
});

menuItems.forEach(menuItem => {
  menuItem.addEventListener('focus', function(e) {
      // Cheat to ensure that menu is expanded on resize if menu item had focus
      toggle.setAttribute('aria-expanded', 'true');
      menu.classList.remove('collapsed');
      return true;
  });
});

last.addEventListener('keydown', function(e) {
  if (!e.shiftKey && e.key === 'Tab') {
      toggle.setAttribute('aria-expanded', 'false');
      menu.classList.add('collapsed');
  }
  return true;
});

document.addEventListener('click', function(e) {
  if (e.target != toggle ) {
      toggle.setAttribute('aria-expanded', 'false');
      menu.classList.add('collapsed');
  }
  return true;
});
