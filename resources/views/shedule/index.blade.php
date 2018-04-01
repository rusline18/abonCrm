@extends('layouts.app')

@section('content')
    <div class="shedule-index">
        <h2>Филиал: {{ $arr[0]['name'] }}</h2>
        <button class="button-success" data-toggle="modal" data-target="#modal-create_shedule">Создать</button>
        <h3> {{ date('d M Y') }} </h3>
        <div>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Время</th>
                    @foreach($arr[0]['room'] as $key => $value)
                        <th>{{ $value }}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($date['hour'] as $value)
                        @foreach($date['minute'] as $item)
                            <tr>
                                <td>{{ $value.':'.$item }}</td>
                                @foreach($arr[0]['room'] as $room)
                                    <td></td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-create_shedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-create_shedule">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Создание занятие</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="datetime" id="datetimepicker" placeholder="Время занятие" required>
                        </div>
                        <div class="form-group">
                            <select name="direction_id" class="form-control" required>
                                <option value="" disabled selected>Выберите напраление</option>
                                @foreach($directions as $direction)
                                    <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default active">
                                <input type="radio" name="type" autocomplete="off" value="1" checked>Групповое занятие
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="type" autocomplete="off" value="2">Индивидуальное занятие
                            </label>
                        </div>
                        <div class="form-group">
                            <select name="execute_id" class="form-control" required>
                                <option value="" disabled selected>Выберите исполнителя</option>
                                @foreach($executes as $execute)
                                    <option value="{{ $execute->id }}">{{ $execute->last_name.' '.$execute->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="branch_id" class="form-control" id="select-branch" required>
                                <option value="" disabled selected>Выберите Филиал</option>
                                @foreach($arr as $key => $branch)
                                    <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="room_id" class="form-control select-room" required>
                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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