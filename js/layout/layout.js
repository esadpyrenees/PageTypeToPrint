
const turndownService = new TurndownService();


window.addEventListener('DOMContentLoaded', () => {
  layoutHelper(document);
});

Paged.registerHandlers(class extends Paged.Handler {
  constructor(chunker, polisher, caller) {
    super(chunker, polisher, caller);
  }
  afterRendered(pages) {
    // layoutHelper(pages);
    pages.forEach(page => {
      // console.log(page);
      layoutHelper(page.element);
    });
  }
});

function layoutHelper(content) {
  document.body.dataset.mode = 'layout';

  // rendom color for each mark
  const figures = content.querySelectorAll('.figure');
  figures.forEach( (f) => {
    const nav =  document.createElement('nav');
    const size = document.createElement('select');
    const sizes = [ "quarter", "third", "twothird", "half", "full"];
    sizes.forEach(s => {
      const o = document.createElement("option");
      o.value = s;
      o.textContent = s
      size.appendChild(o);
      f.classList.forEach(c => {
        if(s == c) o.selected = "true"
      });
    })
    nav.appendChild(size);
    size.addEventListener("change", function(){
      console.log("tada");
      f.classList.forEach(c => {
        if(sizes.indexOf(c) >= 0) f.classList.remove(c);
        f.classList.add(size.value)
      });      
      log(f);
    });

    const offset = document.createElement('select');
    const offsets = ["offset0", "offset2", "offset4", "offset6", "offset8"];
    offsets.forEach(s => {
      const o = document.createElement("option");
      o.value = s;
      o.textContent = s
      offset.appendChild(o);
      f.classList.forEach(c => {
        if(s == c) o.selected = "true"
      });
    })
    nav.appendChild(offset);
    offset.addEventListener("change", function(){
      f.classList.forEach(c => {
        if(offsets.indexOf(c) >= 0) f.classList.remove(c);
        f.classList.add(offset.value)
      });      
      log(f);
    });

    const button = document.createElement('button');
    button.textContent = "copy code";
    nav.appendChild(button);
    button.addEventListener('click', function(){        
      log(f);
    })

    f.appendChild(nav);

  });
}


function log(f){

  console.log('log')
  const i = f.querySelector("img");
  const url = i.getAttribute('src')

  const fc = f.querySelector("figcaption");
  let caption = "";
  if( fc ){
    caption = `caption: ${ turndownService.turndown(fc.innerHTML) }`
  } 
  
  let code = `(figure: ${url} class: ${f.className.replace('figure', '').trim()} ${caption})` 
  console.log(code);

  let input = document.createElement('input');        
  input.value = code;
  input.select();    
  document.execCommand('copy');    
  if (navigator.clipboard) {
    navigator.clipboard.writeText(input.value);
    f.querySelector("nav").classList.add("copied");
    setTimeout(() => {
      f.querySelector("nav").classList.remove("copied");      
    }, 1000);
  }
}