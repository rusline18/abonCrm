$(document).ready(function () {
    $('.form-create-execute').on('submit', function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        $.post({
            data: form,
            url: 'http://localhost:8000/execute',
        }).done((res) => {
            $('#create').modal('hide');
            $('.form-create-execute')[0].reset();
            $('.executer-index').append(`<div class="col-lg-3 col-md-4 panel">
            <div class="panel-default executer-panel">
                <div class="caption panel-body">
                    <p><strong>Фамилия имя:</strong> ${res.last_name} ${res.name}</p>
                    <p><strong>Телефон:</strong> ${res.phone}</p>
                    <p><strong>Email:</strong> ${res.email}</p>
                </div>
            </div>
        </div>`).show('fast')
        })
            .fail(error => console.log(error.responseJSON.message))
    });
    $('.form-create-client').on('submit', function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        $.post({
            data: form,
            url: 'http://localhost:8000/client',
        }).done((res) => {
            $('#create').modal('hide');
            $('.form-create-client')[0].reset();
            $('.client-index').append(`<div class="col-lg-3 col-md-4 panel">
            <div class="panel-default client-panel">
                <div class="action">
                    <a href="http://localhost:8000/client/${res.id}/edit" class="editModal"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Редактировать"></span></a>
                    <div class="remove" data-toggle="tooltip" title="Удалить">
                        <span class="glyphicon glyphicon-remove"></span>
                    </div>
               </div>
                <div class="caption panel-body">
                    <p><strong>Фамилия имя:</strong> ${res.last_name} ${res.name}</p>
                    <p><strong>Телефон:</strong> ${res.phone}</p>
                    <p><strong>Email:</strong> ${res.email}</p>
                </div>
            </div>
        </div>`).show('fast')
        })
            .fail(error => console.log(error.responseJSON.message))
    });
    $('body').on('submit', '.form-update-execute',function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let id = $(this).data('id');
        $.ajax({
            type: 'put',
            data: form,
            url: `http://localhost:8000/execute/${id}`,
        }).done(res => {
            $('#edit').modal('hide');
            $('.form-update-execute')[0].reset();
            $(`#${id}`).html(`<div class="caption panel-body">
                    <p><strong>Фамилия имя:</strong> ${res.last_name} ${res.name}</p>
                    <p><strong>Телефон:</strong> ${res.phone}</p>
                    <p><strong>Email:</strong> ${res.email}</p>
                </div>`)
        })
            .fail(err => console.log(err))
    })
    $('body').on('submit', '.form-update-client',function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let id = $(this).data('id');
        $.ajax({
            type: 'put',
            data: form,
            url: `http://localhost:8000/client/${id}`,
        }).done(res => {
            $('#edit').modal('hide');
            $('.form-update-client')[0].reset();
            $(`#${id}>.panel-body`).html(`<p><strong>Фамилия имя:</strong> ${res.last_name} ${res.name}</p>
                    <p><strong>Телефон:</strong> ${res.phone}</p>
                    <p><strong>Email:</strong> ${res.email}</p>`)
        })
            .fail(err => console.log(err.responseJSON.message))
    })
});