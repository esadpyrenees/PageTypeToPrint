
window.addEventListener('DOMContentLoaded', () => {

  // create some chaos…
  const figs = document.querySelectorAll("figure");
  figs.forEach(fig => {
    // random space after 
    fig.style.paddingBottom = Math.floor( Math.random() * 8) * 50 + "px";
    // random width
    fig.style.gridColumn = `span ${ Math.floor( Math.random() * 3) +1 }`;
  });

});
