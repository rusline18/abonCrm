$(document).ready(function () {
    let urlSite = window.location.origin;
    $('#form-create_branch').submit(function (e) {
        e.preventDefault();
        send('post', $(this).serialize(), `${urlSite}/branch`, '#modal-create_branch', '#form-create_branch');
    });

    $('body').on('submit', '#form-update-branch', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'put',
            data: $(this).serialize(),
            url: `${urlSite}/branch/${$(this).data('id')}`
        })
            .fail(err => console.error(err.responseJSON.message));
    });

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
                            <span class="glyphicon glyphicon-remove remove-direction" id="${res.id}"></span>
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
            <div class="action">
                <a href="${urlSite}/execute/${res.id}/edit" class="editExecuteModal"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Редактировать"></span></a>
                <div class="remove-execute" data-toggle="tooltip" title="Удалить" data-id="${res.id}">
                    <span class="glyphicon glyphicon-remove"></span>
                </div>
            </div>
            <div id="${res.id}" class="panel-default executer-panel">
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
    });
    $('body').on('submit', '.form-edit-direction', function (e) {
        e.preventDefault();
        let id = $(this).data('id')
        $.ajax({
            type: 'put',
            data: $(this).serialize(),
            url: `${urlSite}/direction/${id}`
        })
            .done(res => {
                console.log(res['execute']);
                $('#edit').modal('hide');
                let execute = res['execute'].map(item => {
                    return(`<div class="chips col-lg-5">${item.last_name} ${item.name} <span class="close-chips remove-execute_direction" data-id="${item.id}">X</span></div>`)
                });
                $(`#${id}>.panel-body`).html(`
                <div class="action">
                        <a href="${urlSite}/direction/${id}/edit" class="edit-direction">
                            <span class="glyphicon glyphicon-pencil editDirectiontModal" id="${id}" data-toggle="tooltip" title="Редактировать" data-placement="left"></span>
                        </a>
                        <span class="glyphicon glyphicon-remove remove-direction" id="${id}" data-toggle="tooltip" title="Удалить" data-placement="left"></span>
                    </div>
                    <p>${res.name}</p>
                    <div>
                        ${execute}
                    </div>
                    `)
            })
            .fail(err => console.error(err.responseJSON.message))
    });
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

    function send(type, data, url, idModal = null, idForm) {
        $.ajax({
            type: type,
            data: data,
            url: url
        })
            .done(res => {
                $(idForm)[0].reset();
                if (idModal){ $('#modal-create_branch').modal('hide'); }
                let room = res.rooms.map(item => `<div class="col-lg-5 chips">
                            <span data-id="${ item.id }" class="close-chips destroy-room">X</span>
                            <div>${ item.name }</div>
                        </div>`);
                $('.branch-table').append(`<div class="col-lg-5 panel panel-default branch-info">
                <div class="panel-body">
                    <span id="${res.id}" class="action-branch glyphicon glyphicon-remove"></span>
                    <p>${res.name}</p>
                    <div class="branch-info_address">${ res.city } ул. ${ res.street } д.${ res.build } оф.${ res.appartament }</div>
                    ${ room }
                </div>
            </div>`)
            })
            .fail(err => console.error(err.responseJSON.message))
    }
});