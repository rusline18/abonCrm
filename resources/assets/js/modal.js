$(document).ready(function () {
    $("body").on('click', '.editExecuteModal', function (e) {
        e.preventDefault();
        editModal($(this).attr('href'));
    });
    $("body").on('click', '.editClientModal', function (e) {
        e.preventDefault();
        editModal($(this).attr('href'));
    });
    $("body").on('click', '.editDirectiontModal', function (e) {
        e.preventDefault();
        editModal($(this).parent().attr('href'));
    });
    function editModal(url){
            $('#edit').modal('show').find('.modal-content').load(url);
    }
});