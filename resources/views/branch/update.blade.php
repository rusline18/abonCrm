<form action="#" id="form-update-branch" data-id="{{ $branchArr['branch']->id }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> Создание филиала</h4>
    </div>
    <div class="modal-body">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Название филиала" value="{{ $branchArr['branch']->name }}" required>
        </div>
        <div class="form-group col-lg-4">
            <input type="text" class="form-control" name="city" placeholder="Город" value="{{ $branchArr['branch']->city }}" required>
        </div>
        <div class="form-group col-lg-4">
            <input type="text" class="form-control" name="street" placeholder="Улица" value="{{ $branchArr['branch']->street }}" required>
        </div>
        <div class="form-group col-lg-2">
            <input type="text" class="form-control" name="build" placeholder="Дом" value="{{ $branchArr['branch']->build }}" required>
        </div>
        <div class="form-group col-lg-2">
            <input type="text" class="form-control" name="appartament" placeholder="Офис" value="{{ $branchArr['branch']->appartament }}" required>
        </div>
        <div class="form-group col-lg-5">
            <input type="text" class="form-control" name="phone" placeholder="Раб телефон" value="{{ $branchArr['branch']->phone }}">
        </div>
        <div class="room">
            @foreach($branchArr['rooms'] as $key => $rooms)
                <div class="form-group col-lg-8" >
                        <input type="text" class="form-control create-room" name="room[{{ $key }}]" value="{{ $rooms->name }}" placeholder="Название комнаты" required>
                        <div class="pull-right button-success add-room">+</div>
                        @if(count($branchArr['rooms']) > 1)
                            <div class="pull-right button-error remove-room">-</div>
                        @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
        <button type="submit" class="button-success">Создать</button>
    </div>
</form>