$(document).ready(function () {
    let urlSite = window.location.origin;
    $('#form-create_branch').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            data: $(this).serialize(),
            url: `${urlSite}/branch`
        })
            .done(res => {
                $('#form-create_branch')[0].reset();
                $('#modal-create_branch').modal('hide');
                let room = res.rooms.map(item => `<div class="col-lg-5 chips">
                        <span data-id="${ item.id }" class="close-chips destroy-room">X</span>
                        <div>${ item.name }</div>
                    </div>`);
                $('.branch-table').append(`<div class="col-lg-5 panel panel-default branch-info">
            <div class="panel-body">
            <div class="action">
                <a href="http://localhost:8000/branch/${res.id}/edit" class="editBranchModal"">
                    <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Редактировать" data-id="${res.id}"></span>
                </a>
                <div class="remove" data-toggle="tooltip" title="Удалить">
                    <span id="${res.id}" class="remove-branch glyphicon glyphicon-remove"></span>
                </div>
           </div>
                
                <p>${res.name}</p>
                <div class="branch-info_address">${ res.city } ул. ${ res.street } д.${ res.build } оф.${ res.appartament }</div>
                ${ room }
            </div>
        </div>`)
            })
            .fail(err => console.error(err.responseJSON.message))
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
                $('.direction-table').append(`<div class="panel panel-default col-lg-5 direction-info">
                    <div class="panel-body">
                        <div class="action">
                            <a href="${urlSite}/direction/${res.id}/edit" class="editDirectiontModal"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Редактировать"></span></a>
                            <div class="remove-direction" data-toggle="tooltip" title="Удалить" data-id="${res.id}">
                                <span class="glyphicon glyphicon-remove"></span>
                            </div>
                        </div>
                        <p>${res.name}</p>
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
        let id = $(this).data('id');
        $.ajax({
            type: 'put',
            data: $(this).serialize(),
            url: `${urlSite}/direction/${id}`
        })
            .done(res => {
                $('#edit').modal('hide');
                $(`#${id}>.panel-body`).html(`
                <div class="action">
                        <a href="${urlSite}/direction/${id}/edit" class="edit-direction">
                            <span class="glyphicon glyphicon-pencil editDirectiontModal" id="${id}" data-toggle="tooltip" title="Редактировать" data-placement="left"></span>
                        </a>
                        <span class="glyphicon glyphicon-remove remove-direction" id="${id}" data-toggle="tooltip" title="Удалить" data-placement="left"></span>
                    </div>
                    <p>${res.name}</p>
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
    $('body').on('submit', '.form-create_seaaon', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            data: $(this).serialize(),
            url: `${urlSite}/season`
        })
            .then(res => console.log(res))
            .fail(err => console.error(err.responseJSON.message));
    });
    $('body').on('submit', '.form-update_seaaon', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            type: 'put',
            data: $(this).serialize(),
            url: `${urlSite}/season/${id}`
        })
            .done(res => {
                let period, unlimited, number;
                $('#edit').modal('hide');
                $('.form-update_seaaon')[0].reset();
                console.log(res);
                if (res.period == 1){
                    period = '1 день';
                } else if(res.period == 2){
                    period = '1 месяц';
                } else if(res.period == 3){
                    period = '2 месяца';
                } else {
                    period = '3 месяца';
                }
                number = res.number ? `<div>${ res.number } занятий</div>` : '';
                unlimited = res.unlimited == 1 ? '<div>Безлимит</div>' : '';
                $(`#${id} .season-info`).html(`
                        <div>Срок:
                            ${period}
                        </div>
                        <div>${ number }</div>
                        <div>${ res.sum }<span class="glyphicon glyphicon-ruble"></span></div>
                            ${unlimited}
                    `)
            })
            .fail(err => console.error(err.responseJSON.message))
    })
});