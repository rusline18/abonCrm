$(document).ready(function () {
   $(function () {
       $('[data-toggle="tooltip"]').tooltip()
   });
   $('.executer-panel').hover(function(){
       let id = $(this).attr('id');
       $(this).prepend(`<div class="action">
            <a href="http://localhost:8000/execute/${id}/edit" class="editModal"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Редактировать"></span></a>
            <div class="remove" data-toggle="tooltip" title="Удалить">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
       </div>`);
   },
   function () {
       $('.action').remove();
   });
   $('body').on('click', '.remove',function () {
       let id = $(this).parent('div').attr('id');
       $.ajax({
           type: 'delete',
           data: {_token: $('meta[name="csrf-token"]').attr('content')},
           url: `http://localhost:8000/execute/${id}`
       }).done(() => {
           $(`#${id}`).parent().remove();
       })
           .fail(err => console.log(err));
   });
    $("body").on('click', '.editModal', function (e) {
        e.preventDefault();
        $('#edit').modal('show').find('.modal-content').load($(this).attr('href'));
    })
});