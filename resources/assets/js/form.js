$(document).ready(function () {
    $('.form-create-execute').on('submit', function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        console.log(form);
        $.post({
            data: form,
            url: 'http://localhost:8000/execute',
        }).done((res) => {
            $('#create').modal('hide');
            $('.form-create-execute')[0].reset();
            $('.executer-index').append(`<div class="col-lg-3 col-md-4 panel">
            <div class="panel-default">
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
});