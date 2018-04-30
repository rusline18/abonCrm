<div class="modal-header">
    <h3>Редактировать направление</h3>
</div>
<form class="form-edit-direction" data-id="{{ $directionExecute['direction']->id }}">
<div class="modal-body">
        {{ csrf_field() }}
        <input type="hidden" name="{{ Auth::user()->id }}">
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{ $directionExecute['direction']->name }}">
        </div>
        <div class="form-group">
            <select name="execute[]" class="form-control js-example-basic-single addExecute" multiple="multiple" title="Преподаватель" required>
                @foreach($directionExecute['teacher'] as $teacher)
                    <option value="{{ $teacher->id }}"
                            @if($teacher['ckecked'] == true)
                                selected="selected"
                            @endif
                            >{{ $teacher->full_name }} {{ $teacher['checked'] }}</option>
                @endforeach
            </select>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
    <button type="submit" class="button-success">Создать</button>
</div>
</form>