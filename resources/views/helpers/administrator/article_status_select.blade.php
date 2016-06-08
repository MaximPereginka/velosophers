<!-- Article status -->
@if($data['statuses'])
    <div class="form-group">
        <label class="control-label" for="status">Статус</label>
        <select class="form-control" id="status" name="status_id" required>
            @foreach($data['statuses'] as $status)
                <option value="{{ $status->id }}"
                @if((isset($article->status_id)) and ($article->status_id != 0) and ($article->status_id == $status->id))
                    {{ "selected" }}
                @endif
                >{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
@endif