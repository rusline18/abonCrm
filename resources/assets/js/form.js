$(document).ready(function () {
    let i = 1;
    $('.js-example-basic-single').select2({
        width: '300px',
        placeholder: "Выберите преподавателя"
    });
    $('.js-select-client').select({
        width: '300px',
        placeholder: 'Выберите клиента'
    });
    $('body').on('click', '.add-room', function () {
       i++
        $(this).closest('.room').append(`<div class="form-group col-lg-8" style="height: 37px">
                                <input type="text" class="form-control create-room" name="room[${i}]" placeholder="Название комнаты">
                                <div class="pull-right button-success add-room">+</div>
                                <div class="pull-right button-error remove-room">-</div>
                            </div>`);
        $(this).parents('.modal-body').height(300);
   });

    $('body').on('click', '.remove-room', function () {
        $(this).parents('.form-group').remove();
    })
    $('.datetimepicker').datetimepicker({
        format: 'DD MMMM YYYY',
        pickTime: false,
        locale: 'ru',
        language: 'ru-RU',
    });
    $('.time').datetimepicker({
        format: 'HH:mm',
        minuteStepping: 30,
        pickDate: false,
        locale: 'ru',
        language: 'ru-RU',
    });
    $('#select-branch').change(function () {
        let value = $(this).val();
        if ($(this).val() !== null){
            $.ajax({
                type: 'get',
                url: `${window.location.origin}/branch/rooms/${value}`,
                beforeSend: function () {
                    $('.select-room').css('display', 'block').html(`<option value="" disabled selected>Загрузка</option>`)
                }
            })
                .done(res => {
                    let room = res.map(room => {
                        return `<option value="${room.id}">${room.name}</option>`
                    });
                    $('.select-room').css('display', 'block').html(`<option value="" disabled selected>Выберите комнату</option>${room}`);
                })
                .fail(err => console.error(err.responseJSON.message));
        }
    })
    $('body').on('click', '.remove-shedule', function () {
        let id = $(this).attr('id');
        $.ajax({
            type: `delete`,
            url: `${window.location.origin}/shedule/${id}`,
            data: {_token: $(`meta[name="csrf-token"]`).attr(`content`)},
        })
            .done(() => location=`${window.location.origin}/shedule`)
            .fail(err => err.responseJSON.message)
    });
    $('body').on('click', '.period_radio', function(){
        $('.period_radio.active').removeClass('active');
        $(this).addClass('active');
        if($(this).children().val() != 1){
            $('.season_unlimit-hidden').addClass('season_unlimit-disabled').removeClass('season_unlimit-hidden');
            $('.season_number')
                .addClass('season_number-hidden')
                .removeClass('season_number')
                .children('input')
                .attr('required', true);
        }
        if($(this).children().val() == 1){
            $('.season_unlimit-disabled')
                .addClass('season_unlimit-hidden')
                .removeClass('season_unlimit-disabled');
            $('.season_number-hidden')
                .addClass('season_number')
                .removeClass('season_number-hidden')
                .children('input')
                .removeAttr('required');
        }
    });
    $('body').on('change', '#unlimit', function () {
        if($('#unlimit').is(':checked')){
            $('.season_number-hidden')
                .addClass('season_number')
                .removeClass('season_number-hidden')
                .children()
                .removeAttr('required');
        } else {
            $('.season_number')
                .addClass('season_number-hidden')
                .removeClass('season_number')
                .children()
                .attr('required', true);
        }
    })
});