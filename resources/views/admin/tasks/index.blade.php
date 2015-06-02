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
        <a href="{{URL::to('/admin/tasks/create')}}" class="btn btn-primary">Create</a>
    </div>
     <div class="table-responsive col-md-12">
         <table class="table">
             <thead>
             <th>Id</th>
             <th>Task</th>
             <th>Username</th>
             <th>Description</th>
             {{--@if(Auth::user()->role == 'manage' )--}}
                {{--<th>Status</th>--}}
                <th>Action</th>
             {{--@endif--}}
             </thead>
             <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td><a href="{{URL::to('/admin/tasks/detail/'.$task->id)}}">{{$task->name}}</a></td>
                    <td>{{$task->user->name}}</td>
                    <td>{{$task->description}}</td>
                    @if(Auth::user()->role == 'manage' || Auth::user()->id == $task->user->id)
                       {{-- <td>{{$task->status}}</td>--}}
                        <td>{!! link_to_asset('/admin/tasks/edit/'.$task->id, 'Edit') !!} || {!! link_to_asset('/admin/tasks/delete/'.$task->id, 'Delete') !!}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($tasks->lastPage() > 1)
            {!! $tasks->appends(Request::query())->render() !!}
        @endif

    </div>
@stop