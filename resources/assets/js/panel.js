$(document).ready(function () {
    let urlSite = window.location.origin;
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
    $('.removeClient').on('click',function () {
        let id = $(this).parent('div').parent('div.client-panel').attr('id');
        console.log(id);
        $.ajax({
            type: 'delete',
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            url: `http://localhost:8000/client/${id}`
        }).done(() => {
            $(`#${id}`).parent().remove();
        })
            .fail(err => console.log(err));
    });
    $("body").on('click', '.editModal', function (e) {
        e.preventDefault();
        $('#edit').modal('show').find('.modal-content').load($(this).attr('href'));
    })
    $("body").on('click', '.editClientModal', function (e) {
        e.preventDefault();
        $('#edit').modal('show').find('.modal-content').load($(this).attr('href'));
    })
    $('body').on('click', '.remove-direction', function () {
        let id = $(this).attr('id');
        console.log($(this).parents('div>.direction-info'));
        $.ajax({
            type: 'delete',
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            url: `${urlSite}/direction/${id}`
        }).done(() => {
            $(this).parents('div>.direction-info').remove();
        }).fail(err => console.log(err))
    })
    $('body').on('click', '.close-chips', function () {
        let id = $(this).data('id');
        $.post({
            type: 'delete',
            url: `${urlSite}//direction/execute-delete/${id}`,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        })
            .done(res => {
                console.log(res);
                $(this).parent().remove();
            })
            .fail(err => console.log(err.responseJSON.message))
    });
});