@extends('layouts.app')

@section('content')
    <div class="shedule-index">
        <h2>Филиал: {{ $arr['name'] }}</h2>
        <button class="button-success" data-toggle="modal" data-target="#modal-create_shedule">Создать</button>
        <h3> {{ $checkoutDate }} </h3>
        <div>
            <form action="{{ route('shedule.index') }}">
                <div class="form-group col-lg-3">
                    <select name="filter[branch]" id="" class="form-control">
                        <option value="">Выберите филиал</option>
                        @foreach($branchs as $branch)
                            <option name="branch-filter" value="{{ $branch->id }}"
                            @if($branch->id == $arr['id'])
                            selected
                            @endif>{{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="filter[date]" class="form-control datetimepicker" placeholder="Выберите дату">
                </div>
                <button class="button" type="submit">Фильтровать</button>
            </form>
        </div>
        <div>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th width="2%">Время</th>
                    @foreach($arr['room'] as $key => $value)
                        <th width="15%">{{ $value['name'] }}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($date['hour'] as $value)
                        @foreach($date['minute'] as $item)
                            <tr>
                                <td>{{ $value.':'.$item }}</td>
                                @foreach($arr['room'] as $room)
                                    <td>
                                    @foreach($shedule as $lesson)
                                        @if($checkoutDate == date('d M Y', $lesson->date) && $lesson->time_start == $value.':'.$item.':00' && $lesson->room_id == $room['id'])
                                            <div class="block-lesson" style="width: 43.5%; height: {{ ((strtotime($lesson->time_end) - strtotime($lesson->time_start))/60/30 + 1) * 33}}px;" data-href="{{ route('shedule.edit', $lesson->id) }}">
                                                <strong>{{ $lesson->directions->name }}</strong>
                                                <div>{{ $lesson->type == 1 ? 'Групповое занятие' : 'Индивидуальное занятие' }}</div>
                                                <div>Преподаватель: {{ $lesson->executes->fullName }}</div>
                                                <div>
                                                    <div>Клиенты:</div>
                                                    @foreach($lesson->clients as $client)
                                                        {{ $client->fullName }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </td>
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
                <form id="form-create_shedule" action="{{ route('shedule.store') }}" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Создание занятие</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control datetimepicker" name="date" placeholder="Время занятие" required>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <input type="text" class="form-control time" name="time_start" placeholder="Начало занятии" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control time" name="time_end" placeholder="Конец занятии" required>
                            </div>
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
                                @foreach($branchs as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="room_id" class="form-control select-room" required>
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
                        <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
                        <button type="submit" class="button-success">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editShedule" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection