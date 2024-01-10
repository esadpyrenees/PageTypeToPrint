// Script that 
// - gather markdown generated footnotes calls 
// - for each call, gather the target footnote (at the end of the <main>) :
//   - deletes the back reference to note call
//   - create an inline <span class="footnote"> 
//   - insert the content of the note within the <span>
//   - inject the <span> after the call
//   - then, deletes the call
// Author: ? 

function getBlocks(element){
    return element.querySelectorAll('div,p,blockquote,section,article,h1,h2,h3,h4,h5,h6,figure');
}

// get only inline-level tags
function unwrapBlockChildren(element) {
    const blocks = getBlocks(element);
    blocks.forEach(block => {
        block.insertAdjacentHTML("beforebegin", block.innerHTML);
        block.remove();
    });
    const remainingblocks = getBlocks(element);
    if(remainingblocks.length) unwrapBlockChildren(element)
    return element;
}


  

class MyHandler extends Paged.Handler {
    constructor(chunker, polisher, caller) {
        super(chunker, polisher, caller);
    }

    beforeParsed(content) {
        
        // inline footnotes
        const footnotes_calls = content.querySelectorAll(".footnote-ref");
        footnotes_calls.forEach( (call) => {
            // query note content
            const note = content.querySelector(call.querySelector("a").getAttribute('href'));
            // delete backref
            const backref = note.querySelector('.footnote-backref');            
            backref.parentElement.removeChild(backref);
            // create inline note
            const inline_note = document.createElement('span');
            inline_note.className = "footnote";

            inline_note.innerHTML = unwrapBlockChildren(note).innerHTML;
            call.after(inline_note);
            call.parentElement.removeChild(call);            
        })
    }
}
Paged.registerHandlers(MyHandler);