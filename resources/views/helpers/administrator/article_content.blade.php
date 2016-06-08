<!-- Article content -->

<div class="form-group">
    <label class="control-label" for="title">Название</label>
    <input value="@if(isset($article->title)){{ $article->title }}@endif" type="text" id="title" name="title" class="form-control" placeholder="Введите название статьи" />
</div>

<div class="form-group">
    <label class="control-label" for="preview">Текст превью</label>
    <textarea id="preview" name="preview" rows="5" class="form-control" placeholder="Введите превью статьи">@if(isset($article->preview)){{ $article->preview }}@endif</textarea>
</div>

<div class="form-group">
    <label class="control-label" for="articleContent">Текст статьи</label>
    <textarea id="articleContent" name="articleContent" class="form-control" placeholder="Введите текст статьи">@if(isset($article->content)){{ $article->content }}@endif</textarea>
</div>