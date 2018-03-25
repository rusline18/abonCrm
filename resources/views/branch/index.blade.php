@extends('layouts.app')

@section('content')
    <h1>Филиалы</h1>
    <div class="branch-index container">
        <button class="button-success" data-toggle="modal" data-target="#modal-create_branch">Создать</button>
        <div class="row branch-table">
            @foreach($branchs as $key => $branch)
            <div class="col-lg-5 panel panel-default branch-info">
                <div class="panel-body">
                    <span id="{{ $key }}" class="action-branch glyphicon glyphicon-remove"></span>
                    <p>{{ $branch['name'] }}</p>
                    <div class="branch-info_address">{{ $branch['address'] }}</div>
                    @foreach($branch['room'] as $index => $room)
                    <div class="col-lg-5 chips">
                        <span data-id="{{ $index }}" class="close-chips remove-room">X</span>
                        <div>{{ $room }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="modal-create_branch" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" id="form-create_branch">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Создание филиала</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Название филиала" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <input type="text" class="form-control" name="city" placeholder="Город" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <input type="text" class="form-control" name="street" placeholder="Улица" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <input type="text" class="form-control" name="build" placeholder="Дом" required>
                    </div>
                    <div class="form-group col-lg-2">
                        <input type="text" class="form-control" name="appartament" placeholder="Офис" required>
                    </div>
                    <div class="form-group col-lg-5">
                        <input type="text" class="form-control" name="phone" placeholder="Раб телефон">
                    </div>
                    <div class="room">
                        <div class="form-group col-lg-8">
                            <input type="text" class="form-control create-room" name="room[1]" placeholder="Название комнаты" required>
                            <div class="pull-right button-success add-room">+</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
                    <button type="submit" class="button-success">Создать</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection