<!-- Article categories -->
<div class="panel panel-default">
    <div class="panel-heading">Категории</div>
    <div class="panel-body">
        @if((!$data['categories']->isEmpty()))
            @foreach($data['categories'] as $category)
                <div class="checkbox">
                    <label for="category_id">
                        <input name="category[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="checkbox" type="checkbox"
                        @if(isset($article_cat->id))
                            @foreach($article->categories->all() as $article_cat)
                                @if(($article_cat->id) and ($article_cat->id == $category->id))
                                    {{ "checked" }}
                                    @endif
                            @endforeach
                        @endif
                        >
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        @else
            <p>Не создано ни одной категории</p>
        @endif
    </div>
</div>
