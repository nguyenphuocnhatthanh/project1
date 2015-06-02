@if(Session::has('statusAction'))
    <div class="alert alert-{{Session::get('statusAction')}}">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button>
        {{Session::get('messageAction')}}
    </div>
@endif