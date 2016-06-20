<div class="container">
    <div class="alert alert-dismissible alert-{{ Session::get('flash_message_class') }}">
        {{ Session::get('flash_message_text') }}
    </div>
</div>