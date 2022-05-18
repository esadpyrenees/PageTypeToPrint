if(paged !== true){
  window.addEventListener('DOMContentLoaded', () => {

    var nav = document.querySelector("#nav");
    var main = document.querySelector('#main');
    var index = nav.cloneNode(true);
    index.id = "index";
    main.prepend(index);
    
    var sections = document.querySelectorAll('section');
    var notes_index = 1;
    var ndt_index = ["III", "II", "I"];
    sections.forEach( (section) => {
      var fns = section.querySelectorAll('.fn, .ndt');
      if(fns.length){
        var fns_container = document.createElement('div');
        fns_container.className = "fns_container";
        section.appendChild(fns_container);
        fns.forEach( (fn) => {
          var fn_call = document.createElement('a');
          fn_call.className = "fn_call";
          if(fn.classList.contains('ndt')){
            var ndtindex = ndt_index.pop();
            fn_call.textContent = "NdT " + ndtindex;
            var id = "ndt-" + ndtindex;
          } else {
            fn_call.textContent =  notes_index;
            var id = "fn-" + notes_index;
            notes_index ++;
          }
          fn_call.href = "#" + id;
          fn.parentElement.insertBefore(fn_call, fn);
          var fn_ref = document.createElement('div');
          fn_ref.className = "fn_ref";
          fn_ref.id = id;
          fn_ref.innerHTML = `<span class='fn_ref_number'>${fn_call.textContent}</span>` + fn.innerHTML;
          fns_container.appendChild(fn_ref)
        })
      }
      
    })


  

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        const id = entry.target.getAttribute('id');      
        if (entry.intersectionRatio > 0) {
          document.querySelector(`#index li a[href="#${id}"]`).parentElement.classList.add('active');
        } else {
          document.querySelector(`#index li a[href="#${id}"]`).parentElement.classList.remove('active');
        }
      });
    });

    // Track all sections that have an `id` applied
    sections.forEach((section) => {
      observer.observe(section);
    });

    
   

  });


}