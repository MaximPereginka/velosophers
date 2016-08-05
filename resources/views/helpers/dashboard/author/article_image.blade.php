<!-- Article image -->
<div class="panel panel-default">
    <div class="panel-heading">Изображение статьи</div>
    <div class="panel-body">
        @if(isset($data['article']))
            <img src="{{ ($data['article']->img) ? $data['article']->img : "/img/dashboard/no-image.png" }}" alt="{{ $data['article']->title }}" style="width: 100%" class="thumbnail" />
        @endif
        <div class="form-group">
            <label class="control-label" for="imgUrl">URL Изображения</label>
            <input type="text" id="imgUrl" name="imgUrl" class="form-control" value="{{ (isset($data['article'])) ? ((old('imgUrl')) ? old('imgUrl') : $data['article']->img) : old('imgUrl') }}" placeholder="Введите URL изображения">
        </div>
    </div>
</div>