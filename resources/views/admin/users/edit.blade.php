@extends('app')

@section('content')
    @include('partials.error')
    @include('partials.message')

    <form class="form-horizontal" method="post" action="">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{$user->id}}"/>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{$user->name}}" id="inputName" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" value="{{$user->email}}" id="inputEmail3" placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <label for="role" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
                {!! Form::select('role', $role, $user->role == 'manage' ? 0 : 1, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </div>
    </form>

@stop