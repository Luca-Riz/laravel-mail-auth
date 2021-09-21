require('./bootstrap');

const deleteForm = document.querySelectorAll('.delete-post-form');

deleteForm.forEach(item => {
  item.addEventListener('submit', function(e) {
    const resp = confirm('Vuoi cancellare questo dato?');

    if(!resp){
      // cambia il comportamente dell'azione precedente, se falso, non farlo
      e.preventDefault();
    }
  })
});
