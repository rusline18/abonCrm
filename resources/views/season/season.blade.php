@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <button class="button-success createSeasonModal">Создать</button>
    </div>
    <div>

    </div>
</div>
<!--Modal-->
@component('component.modal', ['id' => 'create', 'ariaLabel' => 'createSeason']) @endcomponent
@component('component.modal', ['id' => 'edit', 'ariaLabel' => 'editSeason']) @endcomponent

@endsection