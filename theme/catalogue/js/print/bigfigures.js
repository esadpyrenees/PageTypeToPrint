// Script to make some images bigger…

Paged.registerHandlers(
  class extends Paged.Handler {
    constructor(chunker, polisher, caller) {
      super(chunker, polisher, caller);
    }
    beforeParsed(content) {
      const bigs = ["actaeonpng", "column-071png",  "hornethelmetturntable00006png", "thornepng", "xenopng", "henripng"]
      bigs.forEach(big => {
        let b = content.querySelector('#'+big);
        if(b) b.classList.add('bigfigure')
      });
    }
  }
);
