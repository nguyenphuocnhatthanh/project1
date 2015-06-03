@extends('app')

@section('content')
    @include('partials.error')
    @include('partials.message')

    <form class="form-horizontal" method="post" action="">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" class="form-control" id="inputEmail3" placeholder="Description">
            </div>
        </div>

        <div class="form-group">
            <label for="users" class="col-sm-2 control-label">Users</label>
            <div class="col-sm-10">
                {!! Form::select('users[]', $users, null, ['class' => 'form-control', 'multiple', 'id' => 'select2']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>

@stop
@section('scripts')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $('#select2').select2();
    </script>
@endsection