<div class="form-group">
    @if(in_array($data['article']->status_id, [1,4,5]))
        <a href="/dashboard/author/articles/{{ $data['article']->id }}/moderation" title="Опубликовать" class="form-control btn btn-success">Опубликовать</a>
    @elseif($data['article']->status_id == 2)
        <a href="/dashboard/author/articles/{{ $data['article']->id }}/unpublish" title="Снять с публикации" class="form-control btn btn-warning">Снять с публикации</a>

    @elseif($data['article']->status_id == 3)
        <a href="/dashboard/author/articles/{{ $data['article']->id }}/cancel_moderation" title="Не публиковать" class="form-control btn btn-warning">Не публиковать</a>
    @endif
</div>