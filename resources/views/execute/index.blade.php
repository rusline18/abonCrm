@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Преподаватели</h1>
    <p>
        <button class="button-success" data-toggle="modal" data-target="#create">Создать</button>
    </p>
    <div class="row executer-index">
        @foreach($executer as $execute)
        <div class="col-lg-3 col-md-4 panel">
            <div id='{{ $execute->id }}' class="panel-default executer-panel">
                <div class="caption panel-body">
                    <p><strong>Фамилия имя:</strong> {{ $execute->last_name }} {{$execute->name}}</p>
                    <p><strong>Телефон:</strong> {{ $execute->phone }}</p>
                    <p><strong>email:</strong> {{ $execute->email }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createExexute" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="form-inline form-create-execute">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="createLabel">Создание преподавателя</h4>
            </div>
            <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="modal-create">
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Фамилия" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Имя" required>
                        </div>
                    </div>
                    <div class="modal-create">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Телефон" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                <input type="hidden" value="{{ Auth::user()->id }}" name="id_user">
            </div>
            <div class="modal-footer">
                <button type="button" class="button-error" data-dismiss="modal">Отменить</button>
                <button type="submit" class="button-success">Создать</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editExexute" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>


@endsection