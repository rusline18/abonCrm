$(document).ready(function () {
    let urlSite = window.location.origin;
    $('#form-create_branch').submit(function (e) {
        e.preventDefault();
        $.post({
            data: $(this).serialize(),
            url: `${urlSite}/branch`
        })
            .done(res => console.log(res))
            .fail(err => console.error(err.responseJSON.message))
    })

    $('#form-create_direction').on('submit', function (e) {
        e.preventDefault();
        $.post({
            data: $(this).serialize(),
            url: `${urlSite}/direction`
        })
            .done(res => {
                $('#form-create_direction')[0].reset();
                let executes = res.execute.map(execute => `<div class="chips col-lg-5">${execute.last_name} ${execute.name}<span class="close-chips" data-id="${execute.id}">X</span></div>
`);
                $('.direction-table').append(`<div class="panel panel-default col-lg-5 direction-info">
                    <div class="panel-body">
                        <p>${res.name}</p>
                        <div class="action">
                            <span class="glyphicon glyphicon-remove" id="${res.id}"></span>
                        </div>
                        <div>
                            ${executes}
                        </div>
                    </div>
                </div>`)
            })
            .fail(err => console.log(err.responseJSON.message))
    });
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
    });
});