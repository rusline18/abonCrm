<div class="modal-header">
    <h3>Создать покупку абонимента</h3>
</div>
<div class="modal-body">
    <form class="">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="form-group">
            <select name="season_id" class="form-control" title="Абонимент" data-toggle="tooltip">
                <option value="">Выберите абонимент</option>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->period.' Кол-во занятий: '.$season->number.' Безлимит: '.$season->unlimited.' Суммма: '.$season->sum }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="client_id" class="form-control" title="Абонимент" data-toggle="tooltip">
                <option value="">Выберите клиента</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->fullName }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">

</div>