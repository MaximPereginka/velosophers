<h2>Комментарии ({{ count($data['article']->comments) }})</h2>
<div class="list-group">
    @if($data['article']->comments->isEmpty())
        <p>Под данной публикацией ещё не создано ни одного комментария</p>
    @else
        @foreach($data['article']->comments as $comment)
            <div href="#" class="list-group-item">
                <a href="/dashboard/moderator/articles/comments/{{ $comment->id }}/delete" class="close">&times;</a>
                <p class="text-muted">Опубликовано: {{ $comment->created_at->format('l') }}, {{ $comment->created_at->format('h:i') }}
                    <br/>
                    Автор: <a target="_blank" href="http://velosophers.local/dashboard/author/users/{{ $comment->user->id }}" title="Редактировать пользователя">{{ $comment->user->name}}</a>
                    <br/>
                    <span class="text-success">{{ $comment->likes }} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
                    |
                    <span class="text-danger">{{ $comment->dislikes }} <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></span>
                </p>
                <p class="col-md-12 list-group-item-text">
                    @if($comment->parent_id !== 0)
                        @foreach($data['article']->comments as $parent)
                            @if($parent->id === $comment->parent_id)
                                <div class="col-md-12 well well-sm text-muted">
                <p><strong>{{ $parent->user->name }} пишет:</strong></p>
                <p><em>{{ $parent->text }}</em></p>
            </div>
            @break
            @endif
        @endforeach
    @endif
    <p>{{ $comment->text }}</p>
</div>
@endforeach
@endif
</div>