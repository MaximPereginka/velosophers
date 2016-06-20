<!-- Categories selection -->
<div class="panel panel-default">
    <div class="panel-heading">Категории</div>
    <div class="panel-body">
        @if($data['categories']->isEmpty())
            Не создано ни одной категории
        @else
            <div class="form-group">
                @foreach($data['categories'] as $category)
                    <div class="checkbox">
                        <label>
                            <input name="category_[]" type="checkbox" value="{{ $category->id }}"
                                   @if(old('category_'))
                                       @foreach(old('category_') as $old)
                                           @if($old == $category->id)
                                           checked
                                            @endif
                                        @endforeach
                                    @elseif(isset($data['article']))
                                        @foreach($data['article']->categories as $cat)
                                            @if($cat->id == $category->id)
                                                checked
                                            @endif
                                        @endforeach
                                    @endif
                            > {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>