@extends('app')

@section('content')

    @include('partials.message')
    <form action="" method="get">
        <div class="col-md-3 pull-left">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </form>
    <div class="pull-right">
        <a href="{{URL::to('/admin/users/create')}}" class="btn btn-primary">Create</a>
    </div>
    <div class="table-responsive col-md-12">
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>{!! link_to_asset('/admin/users/edit/'.$user->id, 'Edit') !!} || {!! link_to_asset('/admin/users/delete/'.$user->id, 'Delete') !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($users->lastPage() > 1)
            {!! $users->appends(Request::query())->render() !!}
        @endif

    </div>
@stop