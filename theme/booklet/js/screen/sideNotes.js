// Generate sidenotes using footnotes from Multimarkdown generated content
// Author: 0gust1 
// https://gist.github.com/0gust1/260638bd34a434e7f3dd


var processFootNotesToSideNotes = function processFootNotesToSideNotes(opts) {
  'use strict';
  // var selector = opts.rootSel + ' [id^=' + opts.footNoteAnchorIdStart + ']';
  var selector = opts.rootSel + ' .footnote-ref';
  
  var footNotesAnchors = document.querySelectorAll(selector),
    sidenotes = [],
    i = 1; //Note numbering
  //Each footnote
  Array.prototype.forEach.call(footNotesAnchors, function (ref) {


    var anchor = ref.querySelector("a");
    var id = anchor.getAttribute('href').replace('#', '');
    var target = document.getElementById(id);
    var back = target.querySelector('a[href^="#fnref"]');
    back.parentElement.removeChild(back);

    // build note node
    var node = document.createElement('aside');
    node.classList.add('sn-note');
    node.setAttribute('data-ref', i);
    node.innerHTML = target.innerHTML;

    // build label + input
    var label = document.createElement('label');
    label.className = "sn-toggle-label";
    label.setAttribute("for", "sn-note-" + id);
    label.textContent = anchor.textContent;
    var input = document.createElement('input');
    input.type = "checkbox";
    input.id = "sn-note-" + id;
    input.className = "sn-toggle";

    // if image
    var image = node.querySelector('img');
    if(image){
      var alt = image.getAttribute('alt');
      if(alt) {
        var caption = document.createElement('span');
        caption.className = "caption";
        caption.textContent = alt;
        image.after(caption);
      }
    }

    // build object
    var sidenote = {};
    sidenote.id = id;
    sidenote.ref = ref;
    sidenote.label = label;
    sidenote.input = input;
    sidenote.node = node;
    sidenote.num = i;
    sidenotes.push(sidenote);
    i++;

  });

  //remove the footNotes container
  var footNotesConts = document.querySelectorAll(opts.rootSel + ' ' + opts.footNotesContainerSel);

  Array.prototype.forEach.call(footNotesConts, function (footNoteCont) {
    footNoteCont.parentNode.removeChild(footNoteCont);
  });

  return sidenotes;
};


var initializeFootnotes = function initializeFootnotes(options) {
  'use strict';
  var opts = options || {
    rootSel: '#main',
    footNotesContainerSel: '.footnotes-list',
    footNoteIdPattern: 'fn',
    footNoteAnchorIdStart: 'fn',
    sideNoteClass: 'sn-note'
  };

  var renderSideNotes = function renderSideNotes(sidenotes) {
    //place sidenotes into the DOM, just before their anchor ref.
    //remove any previously rendered infocards and/or hide original footnotes
    sidenotes.forEach(function (note) {
      //get the global container
      var container = note.ref.parentElement;
      //in the container, insert the label, input and note before the anchor parent
      container.insertBefore(note.label, note.ref);
      container.insertBefore(note.input, note.ref);
      container.insertBefore(note.node, note.ref);
      // then delete the anchor
      container.removeChild(note.ref);
    });
  };

  var notes = processFootNotesToSideNotes(opts);
  //console.dir(notes);
  renderSideNotes(notes);

};

window.addEventListener('DOMContentLoaded', () => {
  // footnotes
  initializeFootnotes();
});


