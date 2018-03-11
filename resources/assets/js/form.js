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
            $('.executer-index').append(`<div class="col-lg-4 col-md-4 panel">
            <div class="panel-default">
                <div class="caption panel-body">
                    <p>Фамилия имя: ${res.last_name} ${res.name}</p>
                    <p>Телефон: ${res.phone}</p>
                    <p>email: ${res.email}</p>
                </div>
            </div>
        </div>`).show('fast')
        })
            .fail(error => console.log(error.responseJSON.message))
    })
});