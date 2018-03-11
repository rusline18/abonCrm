<form class="form-inline form-update-client" data-id="{{ $client->id }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="createLabel">Редактировать клиента</h4>
    </div>
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="modal-create">
            <div class="form-group">
                <label for="last_name">Фамилия</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Фамилия" value="{{ $client->last_name }}" required>
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Имя" value="{{ $client->name }}" required>
            </div>
        </div>
        <div class="modal-create">
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Телефон" value="{{ $client->phone }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $client->email }}" required>
            </div>
            <div class="modal-create">
                <div class="form-group">
                    <label>Пол</label>
                    <input type="radio" name="gender" value="1" id="maleEdit" class="radio" required @if($client->gender == 1) checked @endif>
                    <label for="maleEdit">
                        <i class="fa fa-2x fa-male" aria-hidden="true"></i>
                    </label>
                    <input type="radio" name="gender" value="0" id="femaleEdit" class="radio" required @if($client->gender == 0) checked @endif>
                    <label for="femaleEdit">
                        <i class="fa fa-2x fa-female" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="id_user">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
        <button type="submit" class="button-success">Создать</button>
    </div>
</form>