@extends('app')

@section('content')
    @include('partials.error')
    @include('partials.message')

    <form class="form-horizontal" method="post" action="">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{$task->id}}"/>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Task name</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{$task->name}}" class="form-control" id="inputName" placeholder="Task name">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" value="{{$task->description}}" class="form-control" id="inputDescription" placeholder="Description">
            </div>
        </div>

        <div class="form-group">
            <label for="project" class="col-sm-2 control-label">Project</label>
            <div class="col-sm-10">
                {!! Form::select('project_id', $projects, $task->project->id, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </form>

@stop