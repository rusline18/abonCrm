<form id="form-create_shedule" action="{{ route('shedule.update', $shedule->id) }}" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Создание занятие</h4>
    </div>
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control datetimepicker" name="date" placeholder="Время занятие" required value="{{ $shedule->date }}">
        </div>
        <div class="form-group">
            <div class="col-lg-6">
                <input type="text" class="form-control time" name="time_start" placeholder="Начало занятии" required value="{{ $shedule->time_start }}">
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control time" name="time_end" placeholder="Конец занятии" required value="{{ $shedule->time_end }}">
            </div>
        </div>
        <div class="form-group">
            <select name="direction_id" class="form-control" required>
                <option value="" disabled selected>Выберите напраление</option>
                @foreach($directions as $direction)
                    <option value="{{ $direction->id }}">{{ $direction->name }}
                        @if($direction->id == $shedule->direction_id)
                            selected
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active">
                <input type="radio" name="type" autocomplete="off" value="1"
                @if($shedule->type == 1)
                    checked
                @endif>Групповое занятие
            </label>
            <label class="btn btn-default">
                <input type="radio" name="type" autocomplete="off" value="2"
                @if($shedule->type == 2)
                    checked
                @endif>Индивидуальное занятие
            </label>
        </div>
        <div class="form-group">
            <select name="execute_id" class="form-control" required>
                <option value="" disabled selected>Выберите исполнителя</option>
                @foreach($executes as $execute)
                    <option value="{{ $execute->id }}"
                    @if($execute->id == $shedule->execute_id)
                        selected
                    @endif
                    >{{ $execute->fullName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="room_id" class="form-control select-room" required>
                @foreach($branchs as $key => $branch)
                    <optgroup label="{{ $key }}">
                        @foreach($branch as $room)
                            <option value="{{ $room->id }}"
                            @if($room->id == $shedule->room_id)
                                selected
                            @endif
                            >{{ $room->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="client[]" class="form-control js-select-client addClient" multiple="multiple" title="Клиенты" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->fullName }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="button-error remove-shedule" id="{{ $shedule->id }}">Удалить</button>
        <button type="submit" class="button">Сохранить</button>
    </div>
</form>
<script>
    $(document).ready(function(){
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
    })
</script>