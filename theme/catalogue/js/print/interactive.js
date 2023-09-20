// Script to slugify document title in print/paged.js context
// so that PDF documents names can be directly uploaded without any special chars in URL


Paged.registerHandlers(
  class extends Paged.Handler {
    constructor(chunker, polisher, caller) {
      super(chunker, polisher, caller);
    }
    afterPreview(pages) {
      
      console.log(pages);
      pages.forEach(page => {
        const figs = page.element.querySelectorAll("figure");
        figs.forEach(fig => {
          // png to gif toggle 
          fig.addEventListener('click', e => toggleGif(fig));
        });
      });
    }
  }
);

function toggleGif(fig){
  const image = fig.querySelector("img");
  if(image.src.endsWith('.gif')){
    image.src = image.src.replace('.gif', '.png').replace('/gif/', '/png/');
  } else {
    image.src = image.src.replace('.png', '.gif').replace('/png/', '/gif/');     
  }
}