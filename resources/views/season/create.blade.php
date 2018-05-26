<form class="form-create_seaaon">
    <div class="modal-header">
        <h3>Создание абонемента</h3>
    </div>
    <div class="modal-body">
        <div>Срок абонимента</div>
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="btn-group" role="radio">
            <label class="btn btn-default period_radio">
                <input type="radio" name="period" value="1" required>1 день
            </label>
            <label class="btn btn-default period_radio">
                <input type="radio" name="period" value="2" required>1 месяц
            </label>
            <label class="btn btn-default period_radio">
                <input type="radio" name="period" value="3" required>2 месяца
            </label>
            <label class="btn btn-default period_radio">
                <input type="radio" name="period" value="4" required>3 месяца
            </label>
        </div>
        <div class="form-group season_unlimit-hidden">
            <input type="checkbox" name="unlimited" id="unlimit" value="1">
            <label for="unlimit">Безлимитный</label>
        </div>
        <div class="form-group season_number">
            <input type="number" class="form-control" name="number" placeholder="Количество занятий">
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="sum" placeholder="Сумма абонимента" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
        <button type="submit" class="button-success">Создать</button>
    </div>
</form>