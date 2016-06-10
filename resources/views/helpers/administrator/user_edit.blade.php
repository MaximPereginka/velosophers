<!-- User edit form -->
<div class="form-group">
    <h2>Личная информация</h2>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label class="control-label" for="username">Имя пользователя</label>
    <input value="{{ (isset($data['user']->name)) ? $data['user']->name : old('username') }}" type="text" class="form-control" id="username" name="username" placeholder="Введите имя пользователя">
</div>

<div class="form-group">
    <label class="control-label" for="email">Email</label>
    <input value="{{ (isset($data['user']->email)) ? $data['user']->email : old('email') }}" type="email" class="form-control" id="email" name="email" placeholder="Введите email пользователя">
</div>

<div class="form-group">
    <label class="control-label" for="user_type">Тип пользователя</label>
    <select id="user_type" name="user_type" class="form-control">
        @foreach($data['user_type'] as $type)
            <option value="{{ $type->id }}"
                    @if((isset($data['user']->user_type)) and ($data['user']->user_type == $type->id))
                    selected
                    @endif
            >{{ $type->name }}</option>
        @endforeach
    </select>
</div>