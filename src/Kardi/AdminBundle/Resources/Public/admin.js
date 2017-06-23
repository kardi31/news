$(function(){
   $('.delete').on('click', function(){
      if(!confirm('Czy na pewno chcesz usunąć ten element?')){
          return false;
      }
   });
});
