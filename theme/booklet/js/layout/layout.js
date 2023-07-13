
const turndownService = new TurndownService();

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


  // const sizes = [ "quarter", "third", "half", "twothird", "threequarter", "full"];
  const offsets = ["offset0", "offset2", "offset4", "offset6", "offset8"];
  const sizes = { 
    "quarter": {
      "name": "quarter",
      "title": "1/4",
      "offsets": offsets
    },
    "third": {
      "name": "third",
      "title": "1/3",
      "offsets": offsets
    },
    "half": {
      "name": "half",
      "title": "1/2",
      "offsets": offsets.slice(0, -1)
    }, 
    "twothird": {
      "name": "twothird",
      "title": "2/3",
      "offsets": offsets.slice(0, -2)
    }, 
    "threequarter": {
      "name": "threequarter",
      "title": "3/4",
      "offsets": offsets.slice(0, -3)
    }, 
    "full": {
      "name": "full",
      "title": "1/1",
      "offsets": offsets.slice(0, 1)
    }
  };

  const printoffsets = ["print-offset0", "print-offset2", "print-offset4", "print-offset6", "print-offset8"];
  const printsizes = { 
    "none": {
      "name": "",
      "title": "-",
      "offsets": printoffsets
    },
    "print-quarter": {
      "name": "print-quarter",
      "title": "1/4",
      "offsets": printoffsets
    },
    "print-third": {
      "name": "print-third",
      "title": "1/3",
      "offsets": printoffsets
    },
    "print-half": {
      "name": "print-half",
      "title": "1/2",
      "offsets": printoffsets.slice(0, -1)
    }, 
    "print-twothird": {
      "name": "print-twothird",
      "title": "2/3",
      "offsets": printoffsets.slice(0, -2)
    }, 
    "print-threequarter": {
      "name": "print-threequarter",
      "title": "3/4",
      "offsets": printoffsets.slice(0, -3)
    }, 
    "print-full": {
      "name": "print-full",
      "title": "1/1",
      "offsets": printoffsets.slice(0, 1)
    }
  };  


  document.body.dataset.mode = 'layout';

  // rendom color for each mark
  const figures = content.querySelectorAll('.figure');
  figures.forEach( (f) => {
    const nav =  document.createElement('nav');
    
    // offsets helper
    const offset = document.createElement('select');
    offsets.forEach(s => {
      const o = document.createElement("option");
      o.value = s
      o.textContent = s.replace("offset", "↦ ")
      offset.appendChild(o);
      f.classList.forEach(c => {
        if(s == c) o.selected = "true"
      });
    })
    offset.addEventListener("change", function(){
      // update offset classname        
      f.classList.forEach(c => {
        // remove old offset classname
        if(offsets.indexOf(c) >= 0) f.classList.remove(c);
        // add new offset classname
        f.classList.add(offset.value)
      });      
      layoutHelperLog(f);
    });

    // sizes helper
    const size = document.createElement('select');
    for(let s in sizes){
      const o = document.createElement("option");
      o.value = sizes[s]["name"];
      o.textContent = "↔ " + sizes[s]["title"]
      size.appendChild(o);
      f.classList.forEach(c => {
        if(sizes[s]["name"] == c) o.selected = "true"
      });
    }
    size.addEventListener("change", function(){
      // console.log("tada");
      const offset_options = offset.querySelectorAll("option");
      // update authorized offsets
      offset_options.forEach(offset_option => {
        if(sizes[size.value]['offsets'].indexOf(offset_option.value) < 0){
          offset_option.disabled = true;
        } else {
          offset_option.disabled = false;
        }
      });
      // update size classname
      f.classList.forEach(c => {
        // remove old size classname
        if(Object.keys(sizes).indexOf(c) >= 0) f.classList.remove(c);
        // add new size classname
        f.classList.add(size.value)
      });      
      layoutHelperLog(f);
    });



    // print offsets helper
    const printoffset = document.createElement('select');
    printoffsets.forEach(s => {
      const o = document.createElement("option");
      o.value = s
      o.textContent = s.replace("print-offset", "↦ ")
      printoffset.appendChild(o);
      f.classList.forEach(c => {
        if(s == c) o.selected = "true"
      });
    })
    printoffset.addEventListener("change", function(){
      // update offset classname        
      f.classList.forEach(c => {
        // remove old offset classname
        if(printoffsets.indexOf(c) >= 0) f.classList.remove(c);
        // add new offset classname
        f.classList.add(printoffset.value)
      });      
      layoutHelperLog(f);
    });

    // print sizes helper
    const printsize = document.createElement('select');
    for(let s in printsizes){
      const o = document.createElement("option");
      o.value = printsizes[s]["name"];
      o.textContent = "↔ " + printsizes[s]["title"]
      printsize.appendChild(o);
      f.classList.forEach(c => {
        if(printsizes[s]["name"] == c) o.selected = "true"
      });
    }
    printsize.addEventListener("change", function(){
      const offset_options = printoffset.querySelectorAll("option");
      // update authorized offsets
      offset_options.forEach(offset_option => {
        if(printsizes[printsize.value]['offsets'].indexOf(offset_option.value) < 0){
          offset_option.disabled = true;
        } else {
          offset_option.disabled = false;
        }
      });
      f.classList.forEach(c => {
        if(Object.keys(printsizes).indexOf(c) >= 0) f.classList.remove(c);
        f.classList.add(printsize.value)
      });      
      layoutHelperLog(f);
    });


    // // clearline helper
    // const clearline = document.createElement('input');
    // clearline.type = "checkbox";
    // const clearlinelabel = document.createElement('label');
    // clearlinelabel.textContent = "↳ "
    // clearlinelabel.appendChild(clearline);
    // f.classList.forEach(c => {
    //   if(c == "clearline") clearline.checked = "true"
    // });
    // clearline.addEventListener("change", function(){
    //   f.classList.toggle("clearline");
    // })
    

    let p = document.createElement("p");
    p.innerHTML = "<span>screen</span> ";
    p.appendChild(size);
    p.appendChild(offset);
    nav.appendChild(p)
    
    p = document.createElement("p");
    p.className = "printhelper";
    p.innerHTML = "<span>print</span> ";
    p.appendChild(printsize);
    p.appendChild(printoffset);
    nav.appendChild(p)

    const button = document.createElement('button');
    button.textContent = "copy code";
    nav.appendChild(button);
    button.addEventListener('click', function(){        
      layoutHelperLog(f);
    })

    f.appendChild(nav);

  });
}


function layoutHelperLog(f){

  const i = f.querySelector("img");
  const url = i.getAttribute('src')

  const fc = f.querySelector("figcaption");
  let caption = "";
  if( fc ){
    caption = `caption: ${ turndownService.turndown(fc.innerHTML) }`
  } 

  var classnames = "",
    classes_array = [...f.classList ] ;
  var classes = classes_array.filter(function(c, index, arr){ 
    return c != "figure" && !c.startsWith('print');
  });
  if(classes.length) classnames += "class: " + classes.join(" ");
  var printclasses = classes_array.filter(function(c, index, arr){ 
    return c.startsWith('print');
  });
  if(printclasses.length) classnames += " print: " + printclasses.join(" ").replace('print-', '');

  
  
  let code = `(figure: ${url} ${classnames} ${caption})` 
  console.log(code);

  let input = document.createElement('input');        
  input.value = code;
  if (navigator.clipboard) {
    // navigator.clipboard.writeText(input.value);
    copyCode(f, code)
    
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