<div class="col-md-12">
    <h2><a href="/administrator/blog/edit/{{ $article->id }}">{{ $article->title }}</a></h2>
    <p><b>Автор: </b> {{ $article->user->name }}</p>
    <h4>
        @foreach($article->categories as $category)
            <span class="label label-success">{{ $category->name }}</span>

        @endforeach
    </h4>
    <div class="content">
        {!! $article->content !!}
    </div>
    <p><b>Дата создания: </b><time>{{ $article->created_at->format('d.m.o') }}</time></p>
    <hr/>
</div>
