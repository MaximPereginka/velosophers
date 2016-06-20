<!-- Title, preview and article text -->

<div class="col-md-9">
    <div class="form-group">
        <label class="control-label" for="title">Название статьи</label>
        <input class="form-control" type="text" id="title" name="title" value="{{ isset($data['article']) ? ((old('title')) ? old('title') : $data['article']->title) : old('title') }}" placeholder="Введите название статьи">
    </div>

    <div class="form-group">
        <label class="control-label" for="preview">Текст превью</label>
        <textarea rows="3" class="form-control" id="preview" name="preview" placeholder="Введите текст превью">{{ isset($data['article']) ? ((old('preview')) ? old('preview') : $data['article']->preview) : old('preview') }}</textarea>
    </div>

    <div class="form-group">
        <label class="control-label" for="articleContent">Текст превью</label>
        <textarea class="form-control" id="articleContent" name="articleContent" placeholder="Введите текст статьи">{{ isset($data['article']) ? ((old('articleContent')) ? old('articleContent') : $data['article']->content) : old('articleContent') }}</textarea>
    </div>
</div>