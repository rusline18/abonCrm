<div class="modal-header">
    <h3>Редактировать направление</h3>
</div>
<form class="form-edit-direction" data-id="{{ $direction->id }}">
<div class="modal-body">
        {{ csrf_field() }}
        <input type="hidden" name="{{ Auth::user()->id }}">
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{ $direction->name }}">
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
    <button type="submit" class="button-success">Создать</button>
</div>
</form>