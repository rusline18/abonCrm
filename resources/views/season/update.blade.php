<form class="form-update_seaaon" data-id="{{ $seasons->id }}">
    <div class="modal-header">
        <h3>Редактирование абонемента</h3>
    </div>
    <div class="modal-body">
        {{ csrf_field() }}
        <div>Срок абонимента</div>
        <div class="btn-group" role="radio">
            <label class="btn btn-default period_radio @if($seasons->period == 1) active @endif">
                <input type="radio" name="period" value="1" required @if($seasons->period == 1) checked @endif>1 день
            </label>
            <label class="btn btn-default period_radio @if($seasons->period == 2) active @endif">
                <input type="radio" name="period" value="2" required @if($seasons->period == 2) checked @endif>1 месяц
            </label>
            <label class="btn btn-default period_radio @if($seasons->period == 3) active @endif">
                <input type="radio" name="period" value="3" required @if($seasons->period == 3) checked @endif>2 месяца
            </label>
            <label class="btn btn-default period_radio @if($seasons->period == 4) active @endif">
                <input type="radio" name="period" value="4" required @if($seasons->period == 4) checked @endif>3 месяца
            </label>
        </div>
        <div class="form-group @if(!$seasons->unlimited) season_unlimit-hidden @endif">
            <input type="checkbox" name="unlimited" id="unlimit" value="1" @if($seasons->unlimited == 1) checked @endif>
            <label for="unlimit">Безлимитный</label>
        </div>
        <div class="form-group
                @if($seasons->period == 2 || $seasons->period == 3 || $seasons->period == 4)
                    season_number-hidden
                @else
                    season_number
                @endif
        ">
            <input type="number" class="form-control" name="number" placeholder="Количество занятий" value="{{ $seasons->number }}">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="sum" placeholder="Сумма абонимента" required value="{{ $seasons->sum }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
        <button type="submit" class="button-success">Создать</button>
    </div>
</form>