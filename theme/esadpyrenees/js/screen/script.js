
window.addEventListener('DOMContentLoaded', () => {

  // menu clone
  var sections = document.querySelectorAll('section[id]');
  var menu = document.querySelector("#nav ul").cloneNode(true);
  var main = document.querySelector('#main');
  var index = document.createElement('nav');
  index.appendChild(menu);
  index.id = "index";
  main.prepend(index);

  // injecte les liens rapides
  var quicklinks = document.querySelector("#quicklinks").cloneNode(true);
  quicklinks.id = "index-quicklinks";
  index.appendChild(quicklinks);
  // mise à jour dupremier lien (vers la première section, et non plus vers le sommaire)
  quicklinks.querySelector('a').textContent = "↑";
  quicklinks.querySelector('a').href = "#" + index.nextElementSibling.id;


  // menu mobile: insère un bouton pour afficher/masquer le menu
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
  
  // surligne le chapître courant au scroll
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const id = entry.target.getAttribute('id');      
      if (entry.intersectionRatio > 0) {
        const l = document.querySelector(`#index li a[href="#${id}"]`);
        if(l) l.parentElement.classList.add('active');
      } else {
        const li = document.querySelector(`#index li a[href="#${id}"]`);
        if(li) li.parentElement.classList.remove('active');
      }
    });
  });

  // observe chaque section
  sections.forEach((section) => {
    observer.observe(section);
  });

  var downloadlink = quicklinks.querySelector('a:last-child');
  downloadlink.onclick = () => {
    if(downloadlink.getAttribute('href') == ""){
      alert("Un fichier PDF doit être généré et téléversé dans le dossier. Le nom du fichier doit être configuré dans config.php. Documentation: https://esadpyrenees.github.io/PageTypeToPrint/print/.")
    }
  }

  // youtube and vimeo light embeds
  document.querySelectorAll(':is(vimeo-embed, youtube-embed) button').forEach(button => button.addEventListener('click', () => {
    const video = button.previousElementSibling;
    video.src = video.dataset.src;
  }))
  

});


