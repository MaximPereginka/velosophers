<!-- Article image -->
<div class="panel panel-default">
    <div class="panel-heading">Изображение статьи</div>
    <div class="panel-body">
        @if((isset($article->img)) and $article->img)
            <img class="img-thumbnail" alt="{{ $article->title }}" src="{{ $article->img }}" style="width: 100%; height: auto;">
        @else
            <p>Изображение не установлено</p>
        @endif
        <div class="form-group margin-top">
            <label class="control-label" for="img_url">URL Изображения</label>
            <input type="text" id="img_url" name="img_url" class="form-control" placeholder="Введите URL" value="{{ !empty($article->img) ? $article->img : old('img_url') }}">
        </div>
    </div>
</div>