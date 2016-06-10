<!-- Article list -->
<div class="col-md-12">
    <div class="list-group">
        @foreach($articles as $article)
            <a href="/administrator/blog/view/{{ $article->id }}" class="list-group-item">
                <h3 class="list-group-item-heading">{{ $article->title }}</h3>
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="thumbnail" style="width: 100%; height: auto" src="{{ (!empty($article->img)) ? $article->img : "/img/administrator/no-image.png" }}" alt="{{ $article->title }}" />
                        </div>
                        <div class="col-md-10">
                            <p><b>Автор: </b>{{ (isset($article->user->name)) ? $article->user->name : "Velosophers"}}</p>
                            <p><b>Статус: </b>{{ $article->status->name }}</p>
                            @if(!$article->categories->isEmpty())
                                <h4>
                                    @foreach($article->categories as $category)
                                        <span class="label label-success">{{ $category->name }}</span>
                                    @endforeach
                                </h4>
                            @endif
                            <p>{{ $article->preview }}</p>
                            <p><b>Дата создания: </b><time>{{ $article->created_at->format('d.m.o') }}</time></p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>