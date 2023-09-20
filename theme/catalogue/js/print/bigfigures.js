// Script to slugify document title in print/paged.js context
// so that PDF documents names can be directly uploaded without any special chars in URL


Paged.registerHandlers(
  class extends Paged.Handler {
    constructor(chunker, polisher, caller) {
      super(chunker, polisher, caller);
    }
    beforeParsed(content) {
      const bigs = ["actaeonpng", "column-071png",  "hornethelmetturntable00006png", "thornepng", "xenopng", "henripng"]
      bigs.forEach(big => {
        content.querySelector('#'+big).classList.add('bigfigure')
      });
    }
  }
);
