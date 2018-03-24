$(document).ready(function () {
    $("body").on('click', '.editModal', function (e) {
        e.preventDefault();
        $('#edit').modal('show').find('.modal-content').load($(this).attr('href'));
    });
    $("body").on('click', '.editClientModal', function (e) {
        e.preventDefault();
        $('#edit').modal('show').find('.modal-content').load($(this).attr('href'));
    });
});