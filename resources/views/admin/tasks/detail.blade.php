@extends('app')

@section('content')
    <h3>Task: {{$task->name}} - by : <i>{{$task->user->name}}</i></h3>

    <h5>Description:
        {!! $task->description !!}
    </h5>

    <h5>Comment:</h5>
    <ul>

    @foreach($task->comments as $comments)

            <li>{{$comments->user->name}}: <span>{{($comments->body)}}</span>
                @if($comments->user->id == Auth::user()->id)

                    <a href="{{URL::to('/admin/comments/edit/'.$comments->id)}}" class="editComment">Edit</a> |
                    <a href="{{URL::to('/admin/comments/delete/'.$comments->id)}}">Delete</a>
                @endif
                <div id="text{{$comments->id}}" class="edit-comment"></div>
            </li>

    @endforeach

    </ul>
    <form action="{{URL::to('/admin/comments/create')}}" method="post">
        @include('partials.error')
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="task_id" value="{{$task->id}}"/>
        Comment: <textarea name="body" id="" cols="60" rows="5"></textarea>
        <button type="submit" class="btn btn-default">Send</button>
    </form>
    <script>
        $(document).ready(function(){
            var checkAjax = false;
            $(document).off('click', '.editComment').on('click','.editComment',function(e){
                if(checkAjax) return;
                checkAjax = true;
                $('.text-comment').remove();
                e.preventDefault();
                var url = $(this).attr('href').split('/');
                var id = url[url.length - 1];
                $.ajax({
                    url : $(this).attr('href'),
                    type: 'GET',
                    success: function(result){
                        $('#text'+id).show();
                        $('#text'+id).html(result);
                    }
                });
            }).always(function(){
                checkAjax = false;
            });
            $(document).on('keyup', '.text-comment', function(evt){
                if(evt.keyCode == 27){
                    $(this).remove();
                    $('#notifica').remove();
                }else if(evt.keyCode == 13){
                    //$('#editComment').submit();
                  //  alert($(this).val());
                    //alert($('#editComment').serialize());
                    /*$('#editComment').submit(function(e) {
                        alert($(this).serialize());
                    });*/
                }
            });
        });

    </script>
@stop

@section('scripts')

@endsection