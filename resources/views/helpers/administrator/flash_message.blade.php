@if(Session::get('flash_message'))
    <div class="container">
        <div class="alert alert-dismissible alert-{{ (Session::get('flash_message_level')) ? Session::get('flash_message_level') : "info" }}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{Session::get('flash_message')}}
        </div>
    </div>
@endif