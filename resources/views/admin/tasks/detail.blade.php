@extends('app')

@section('content')
    <h3>Task: {{$task->name}} - by : <i>{{$task->user->name}}</i></h3>

    <h5>Description:
        {!! $task->description !!}
    </h5>

    <h5>Comment:</h5>
    @foreach($task->comments as $comments)
        <ul>
            <li>{{$comments->user->name}}: {{($comments->body)}} @if($comments->user->id == Auth::user()->id) <a href="{{URL::to('/admin/comments/delete/'.$comments->id)}}">Delete</a>@endif</li>
        </ul>
    @endforeach

    <form action="{{URL::to('/admin/comments/create')}}" method="post">
        @include('partials.error')
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="task_id" value="{{$task->id}}"/>
        Comment: <textarea name="body" id="" cols="60" rows="5"></textarea>
        <button type="submit" class="btn btn-default">Send</button>
    </form>
@stop