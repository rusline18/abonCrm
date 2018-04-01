@extends('layouts.app')

@section('content')
<div class="container direction-index">
    <div class="panel panel-default col-lg-7 panel-create">
        <div class="panel-body">
            <form class="form-inline" id="form-create_direction">
                <div class="form-group">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="id_user">
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
            <div class="panel panel-default col-lg-5 direction-info">
                <div class="panel-body">
                    <p>{{ $direction['name'] }}</p>
                    <div class="action">
                        <span class="glyphicon glyphicon-remove remove-direction" id="{{ $key }}"></span>
                    </div>
                    <div>
                        @foreach($direction['execute'] as $index => $item)
                            <div class="chips col-lg-5">{{ $item['last_name'].' '.$item['name'] }} <span class="close-chips remove-execute" data-id="{{ $index }}">X</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection