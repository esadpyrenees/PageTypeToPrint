
window.addEventListener('DOMContentLoaded', () => {

  // create come chaos…
  const figs = document.querySelectorAll("figure");
  figs.forEach(fig => {
    // random space after 
    fig.style.paddingBottom = Math.floor( Math.random() * 8) * 50 + "px";
    // random width
    fig.style.gridColumn = `span ${ Math.floor( Math.random() * 3) +1 }`;
    // png to gif toggle 
    fig.addEventListener('click', e => toggleGif(fig));
  });

});

// gifs files downloaded from threedscans.org have been bacth-transformed to png with imagemagick
// $ mogrify -format png -path png gif/*.gif[0]

function toggleGif(fig){
  const image = fig.querySelector("img");
  if(image.src.endsWith('.gif')){
    image.src = image.src.replace('.gif', '.png').replace('/gif/', '/png/');
  } else {
    image.src = image.src.replace('.png', '.gif').replace('/png/', '/gif/');     
  }
}


