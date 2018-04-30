@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Клиенты</h1>
    <p>
        <button class="button-success" data-toggle="modal" data-target="#create">Создать</button>
    </p>
    <div class="row client-index">
        @foreach($clients as $client)
            <div class="col-lg-3 col-md-4 panel">
                <div id='{{ $client->id }}' class="panel-default client-panel">
                    <div class="action">
                        <a href="{{ route('client.edit', ['id' => $client->id]) }}" class="editClientModal"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" title="Редактировать"></span></a>
                        <div class="removeClient" data-toggle="tooltip" title="Удалить">
                            <span class="glyphicon glyphicon-remove"></span>
                        </div>
                    </div>
                    <div class="caption panel-body">
                        <p><strong>Фамилия имя:</strong> {{ $client->last_name }} {{$client->name}}</p>
                        <p><strong>Телефон:</strong> {{ $client->phone }}</p>
                        <p><strong>email:</strong> {{ $client->email }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createClient" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-inline form-create-client">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="createLabel">Создание клиента</h4>
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
                    <div class="modal-create">
                        <div class="form-group">
                            <label>Пол</label>
                            <input type="radio" name="gender" value="1" id="male" class="radio" required>
                            <label for="male">
                                <i class="fa fa-2x fa-male" aria-hidden="true"></i>
                            </label>
                            <input type="radio" name="gender" value="0" id="female" class="radio" required>
                            <label for="female">
                                <i class="fa fa-2x fa-female" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editClient" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

@endsection