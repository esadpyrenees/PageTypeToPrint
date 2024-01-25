
const turndownService = new TurndownService();

const properties = ["width","col", "printwidth", "printcol"];
const labels = {
  "col": "Col. ↦", 
  "width": "Width ↔", 
  "printcol": "Col. ↦ (print)",  
  "printwidth": "Width ↔ (print)"
};

// screen mode
window.addEventListener('DOMContentLoaded', () => {
  layoutHelper(document);
});


// print mode
if(typeof Paged !== "undefined"){
  Paged.registerHandlers(class extends Paged.Handler {
    constructor(chunker, polisher, caller) {
      super(chunker, polisher, caller);
    }
    afterRendered(pages) {
      pages.forEach(page => {
        layoutHelper(page.element);
      });
    }
  });
}

function layoutHelper(content) {

  document.body.dataset.mode = 'layout';

  const figures = content.querySelectorAll('.figure');
  figures.forEach( (f) => {
    const nav =  document.createElement('nav');
    const close = document.createElement("button");
    close.className = "close";
    nav.appendChild(close);
    close.textContent = "× Close layout mode";
    close.addEventListener('click', (e) => {
      e.stopImmediatePropagation();
      f.classList.remove('layouting');
    })
    f.addEventListener('click', (e) => {
      e.stopImmediatePropagation();
      f.classList.add('layouting');
    })
    properties.forEach(prop => {
      const is_print = prop.includes("print");
      const is_width = prop.includes("width");
      const val = f.style.getPropertyValue("--"+prop);
      const select = document.createElement('select');
      select.className = is_print ? "printoptions" : "screenoptions";
      // from 3 to 9 for widths, 0 to 9 for offsets
      for (let i = (is_width ? 3 : 0 ); i <= (is_width ? 12 : 9 ); i++) {
        const o = document.createElement("option");        
        o.value = o.textContent = i;
        if(val == i) {
          o.setAttribute('selected', true);
          f.setAttribute('data-' + prop, val);
        }; 
        if(i == 0) {
          o.value = o.textContent = "auto";
        }
        select.appendChild(o);
      }
      let p = document.createElement("p");
      p.className = is_print ? "printoptions" : "screenoptions";
      p.innerHTML = `<span>${labels[prop]}</span> `;
      p.appendChild(select);
      nav.appendChild(p);
      select.addEventListener("change", function(){
        const v = f.getAttribute('data-'+prop);
        if (checkSum(f, this)) {
          f.style.setProperty(`--${prop}`, this.value);
          f.setAttribute(`data-${prop}`, this.value);
          layoutHelperLog(f);
        } else {
          f.style.setProperty(`--${prop}`, v);
          this.value=v;
          alert("Start-column and width are incompatible (their sum shoul be ≤ 13).");
          return false;
        }
      });
  
    });
    
    const copybtn = document.createElement("button");
    copybtn.textContent = "Copy markdown";
    copybtn.onclick = () => {
      layoutHelperLog(f);
    }
    nav.appendChild(copybtn);
    f.appendChild(nav);

  });
}

function checkSum(f, select){
  let selects = null, sum = 0;
  if(select.classList.contains("printoptions")) {
    selects = f.querySelectorAll(".printoptions");
  } else {
    selects = f.querySelectorAll(".screenoptions");
  }
  selects.forEach(s => {
    sum += Number(s.value);
  });
  if(sum > 13) {
    return false;
  }
  return true;
}


function layoutHelperLog(f){

  const i = f.querySelector("img");
  const url = i.getAttribute('src');

  const is_image = f.classList.contains('image');

  const fc = f.querySelector("figcaption");
  let caption = "";
  if( fc.textContent.trim() ){
    const clone = fc.cloneNode(true);
    // remove backlink from icono figures
    if(!is_image) {
      const toremove = clone.querySelectorAll('.figure_call_back, .figure_reference');
      toremove.forEach(e => {
        e.remove();
      });
    }
    caption = `caption: ${ turndownService.turndown(clone.innerHTML) }`
  } 

  const usefull_classes = f.className.replace(/figure/g, "").replace("icono", "").trim();
  const classes = usefull_classes ? `class: ${usefull_classes}` : "";

  var inlinestyles = "";
  var properties = ["col", "width", "printcol", "printwidth"];
  properties.forEach(prop => {
    const val = f.style.getPropertyValue("--"+prop);
    if(val){
      inlinestyles += `${prop}:${val} `;
    }
  });
  
  let code = `(figure: ${url} ${inlinestyles} ${classes} ${caption})` ;
  if(is_image) code = `(image: ${url} ${inlinestyles} ${classes} ${caption})` ;

  console.log(code);

  let input = document.createElement('input');        
  input.value = code;
  if (navigator.clipboard) {
    copyCode(f, code);    
  } else {
    input.select();    
    document.execCommand('copy');    
  }
}

async function copyCode(f, code) {
  try {
    await navigator.clipboard.writeText(code);
    f.querySelector("nav").classList.add("copied");
    setTimeout(() => {
      f.querySelector("nav").classList.remove("copied");      
    }, 1000); 
  } catch (err) {
    console.error('Failed to copy: ', err);
  }
}