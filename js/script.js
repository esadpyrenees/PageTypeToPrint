if(paged !== true){
  window.addEventListener('DOMContentLoaded', () => {

    // footnotes
    initializeFootnotes();

    // nav clone
    var sections = document.querySelectorAll('section[id]');
    var nav = document.querySelector("#nav ul");
    var main = document.querySelector('#main');
    var index = nav.cloneNode(true);
    index.id = "index";
    main.prepend(index);

    var togglemenu = document.createElement('button');
    togglemenu.textContent = "☰";
    togglemenu.addEventListener('click', function(e){
      e.stopPropagation();
      index.classList.toggle('visible');
    })
    index.prepend(togglemenu);

    index.addEventListener('click', function(){
      index.classList.remove('visible');
    })
    
    // highlight nav item on scroll
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        const id = entry.target.getAttribute('id');      
        if (entry.intersectionRatio > 0) {
          document.querySelector(`#index li a[href="#${id}"]`).parentElement.classList.add('active');
        } else {
          document.querySelector(`#index li a[href="#${id}"]`).parentElement.classList.remove('active');
        }
      });
    });

    // Track all sections that have an `id` applied
    sections.forEach((section) => {
      observer.observe(section);
    });

  });


}