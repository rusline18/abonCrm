@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <button class="button-success createSeasonModal" data-href="{{ route('season.create') }}"><span class="glyphicon glyphicon-plus"></span> Создать</button>
        <button class="button-success buySeasonModal" data-href="{{ route('buy.create') }}"><span class="glyphicon glyphicon-credit-card"></span> Покупка</button>
    </div>
    <div class="row season-index">
        @foreach($seasons as $season)
        <div id="{{ $season->id }}" class="col-lg-3">
            <div class="panel panel-default season-panel">
                <div class="panel-body">
                    <div class="action">
                        <a href="{{ route('season.edit', ['id' => $season->id]) }}" class="edit-season">
                            <span class="glyphicon glyphicon-pencil editSeasonModal" id="{{ $season->id }}" data-toggle="tooltip" title="Редактировать" data-placement="left"></span>
                        </a>
                        <span class="glyphicon glyphicon-remove remove-season" id="{{ $season->id }}"data-toggle="tooltip" title="Удалить" data-placement="left"></span>
                    </div>
                    <div class="season-info">
                        <div>Срок:
                            @if($season->period == 1)
                                1 день
                            @elseif($season->period == 2)
                                1 месяц
                            @elseif($season->period == 3)
                                2 месяца
                            @else
                                3 месяца
                            @endif
                        </div>
                        @if($season->number)
                            <div>{{ $season->number }} занятий</div>
                        @endif
                        <div>{{ $season->sum }}<span class="glyphicon glyphicon-ruble"></span></div>
                        @if($season->unlimited)
                            <div>Безлимит</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!--Modal-->
@component('component.modal', ['id' => 'create', 'ariaLabel' => 'create']) @endcomponent
@component('component.modal', ['id' => 'edit', 'ariaLabel' => 'editSeason']) @endcomponent

@endsection