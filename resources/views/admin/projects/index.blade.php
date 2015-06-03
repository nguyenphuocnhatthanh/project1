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
        <a href="{{URL::to('/admin/projects/create')}}" class="btn btn-primary">Create</a>
    </div>
    <div class="table-responsive col-md-12">
        <table class="table">
            <thead>
            <th>Id</th>
            <th>Project name</th>
            <th>Description</th>
            <th>Total member</th>
            <th>Total Task</th>
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($projects as $project)

                <tr>
                    <td>{{$project->id}}</td>
                    <td><a href="{{URL::to('/admin/projects/detail/'.$project->id)}}">{{$project->name}}</a></td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->users->count()}}</td>
                    <td>@if(count($project->tasks) > 0) {{$project->tasks->count()}} @else 0 @endif</td>
                    <td>{!! link_to_asset('/admin/projects/edit/'.$project->id, 'Edit') !!} || {!! link_to_asset('/admin/projects/delete/'.$project->id, 'Delete') !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($projects->lastPage() > 1)
            {!! $projects->render() !!}
        @endif

    </div>
@stop