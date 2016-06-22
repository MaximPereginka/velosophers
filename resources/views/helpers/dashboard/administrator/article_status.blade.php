<!-- Article status selection -->
<div class="form-group">
    <label class="control-label" for="status">Статус статьи</label>
    <select name="status" id="status" class="form-control">
        @foreach($data['article_status'] as $status)
            <option value="{{ $status->id }}"
                    @if(isset($data['article']))
                    @if(old('status'))
                    @if(old('status') == $status->id)
                    selected
                    @endif
                    @else
                    @if($data['article']->status_id == $status->id)
                    selected
                    @endif
                    @endif
                    @endif
            >{{ $status->name }}</option>
        @endforeach
    </select>
</div>