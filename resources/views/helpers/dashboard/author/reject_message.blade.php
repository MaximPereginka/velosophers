@if(!is_null($data['article']->reject_message))
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Публикация отклонена</h4>
        <p><b>Причина:</b> {{ $data['article']->reject_message->text }}</p>
    </div>
@endif