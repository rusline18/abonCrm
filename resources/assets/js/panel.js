$(document).ready(function () {
    let urlSite = window.location.origin;

   $('body').on('click', '.remove-branch',function () {
       let id = $(this).attr('id');
       $.ajax({
           type: 'delete',
           url: `${urlSite}/branch/${id}`,
           data: {_token: $('meta[name="csrf-token"]').attr('content')}
       })
           .done(() => {
               $(this).parents('.branch-info').remove();
           })
           .fail(err => console.error(err.responseJSON));
       $(this).parents('.branch-panel')
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
        $.ajax({
            type: 'delete',
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            url: `http://localhost:8000/client/${id}`
        }).done(() => {
            $(`#${id}`).parent().remove();
        })
            .fail(err => console.log(err));
    });
    $('body').on('click', '.remove-direction', function () {
        let id = $(this).attr('id');
        $.ajax({
            type: 'delete',
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            url: `${urlSite}/direction/${id}`
        }).done(() => {
            $(this).parents('div>.direction-info').remove();
        }).fail(err => console.error(err.responseJSON.message))
    })
    $('body').on('click', '.destroy-room', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'delete',
            url: `${urlSite}/room/${id}`,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        })
            .done(() => {
                $(this).parent().remove();
            })
            .fail(err => console.log(err.responseJSON.message))
    });
    $('body').on('click', '.remove-execute', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'delete',
            url: `${urlSite}/execute/${id}`,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        })
            .done(() => {
                $(this).parents('.panel').remove();
            })
            .fail(err => console.log(err.responseJSON.message))
    });
    $('body').on('click', '.remove-execute_direction', function () {
        let id = $(this).data('id');
        $.post({
            type: 'delete',
            url: `${urlSite}/direction/execute-delete/${id}`,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        })
            .done(res => {
                console.log(res);
                $(this).parent().remove();
            })
            .fail(err => console.log(err.responseJSON.message))
    });
});