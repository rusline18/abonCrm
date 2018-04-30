$(document).ready(function () {
    /** Вывод модальных окон */
    $('body').on('click', '.editExecuteModal', function (e) {
        e.preventDefault();
        editModal($(this).attr('href'));
    });
    $('body').on('click', '.editClientModal', function (e) {
        e.preventDefault();
        editModal($(this).attr('href'));
    });
    $('body').on('click', '.editDirectiontModal', function (e) {
        e.preventDefault();
        editModal($(this).parent().attr('href'));
    });
    $('body').on('click', '.editBranchModal', function (e) {
        e.preventDefault();
        editModal($(this).attr('href'), '#edit-branch');
    });
    function editModal(url, modal = '#edit'){
            $(modal).modal('show').find('.modal-content').load(url);
    }
});