@extends('layouts.app')

@section('content')
<div class="container direction-index">
    <div class="panel panel-default col-lg-7 panel-create">
        <div class="panel-body">
            <form class="form-inline" id="form-create_direction">
                <div class="form-group">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" class="user">
                    <input type="text" name="name" placeholder="Название направление" class="form-control" required>
                </div>
                <div class="form-group">
                    <select name="execute[]" class="form-control js-example-basic-single addExecute" multiple="multiple" title="Преподаватель" required>
                        @foreach($execute as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->last_name.' '.$teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="button-success">Создать</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row direction-table">
            @foreach($arr as $key => $direction)
            <div id="{{ $key }}" class="panel panel-default col-lg-5 direction-info">
                <div class="panel-body">
                    <div class="action">
                        <a href="{{ route('direction.edit', ['id' => $key]) }}" class="edit-direction">
                            <span class="glyphicon glyphicon-pencil editDirectiontModal" id="{{ $key }}" data-toggle="tooltip" title="Редактировать" data-placement="left"></span>
                        </a>
                        <span class="glyphicon glyphicon-remove remove-direction" id="{{ $key }}"data-toggle="tooltip" title="Удалить" data-placement="left"></span>
                    </div>
                    <p>{{ $direction['name'] }}</p>
                    <div>
                        @foreach($direction['execute'] as $index => $item)
                            <div class="chips col-lg-5">{{ $item['name'] }} <span class="close-chips remove-execute_direction" data-id="{{ $index }}">X</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editDirection" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
@endsection