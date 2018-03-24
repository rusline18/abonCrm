$(document).ready(function () {
    let i = 1;
    $('body').on('click', '.add-room', function () {
       i++
        $(this).closest('.room').append(`<div class="form-group col-lg-8" style="height: 37px">
                                <input type="text" class="form-control create-room" name="room[${i}]" placeholder="Название комнаты">
                                <div class="pull-right button-success add-room">+</div>
                                <div class="pull-right button-error remove-room">-</div>
                            </div>`);
        $(this).parents('.modal-body').height(300);
   })
    $('body').on('click', '.remove-room', function () {
        $(this).parents('.form-group').remove();
    })
});