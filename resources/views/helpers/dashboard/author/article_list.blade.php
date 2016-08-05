<!-- Articles list -->
<div class="list-group">
    @if($data['articles']->isEmpty())
        <p>Не создано ни одной статьи</p>
    @else
        @foreach($data['articles'] as $article)
            <a href="/dashboard/author/articles/{{ $article->id }}/preview" class="list-group-item">
                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="thumbnail" style="width: 100%" alt="Изображение статьи" src="{{ ($article->img) ? $article->img : "/img/dashboard/no-image.png" }}" />
                        </div>
                        <div class="col-md-10">
                            @if(!$article->categories->isEmpty())
                                <p>
                                    <b>Категории: </b>
                                    @foreach($article->categories as $category)
                                        <span class="label label-success">{{ $category->name }}</span>
                                    @endforeach
                                </p>
                            @endif
                            <p>{{ $article->preview }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        <div class="text-center">
            {!! $data['articles']->render() !!}
        </div>
    @endif
</div>