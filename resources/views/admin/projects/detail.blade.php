@extends('app')

@section('content')
    <h3>Project name: {{$project->name}}</h3>

    <h5>Description:
        {!! $project->description !!}
    </h5>

    <p>Users: {!! Form::select('users[]', $UsersToProject, null, ['class' => 'form-control']) !!}</p>
    <p>Tasks: {!! Form::select('tasks', $tasks, null, ['class' => 'form-control']) !!}</p>

    </div>
    <h5>Comment:</h5>
    <ul>
    <?php $checkDisplayComment = false; ?>
    @foreach($project->commentprojects as $commentprojects)

            <li>{{$commentprojects->user->name}}: <span>{{($commentprojects->content)}}</span>
                @if($commentprojects->user->id == Auth::user()->id)
                    <?php $checkDisplayComment = true; ?>
                    <a href="{{URL::to('/admin/commentprojects/edit/'.$commentprojects->id)}}" class="editComment">Edit</a> |
                    <a href="{{URL::to('/admin/commentprojects/delete/'.$commentprojects->id)}}">Delete</a>
                @endif
                <div id="text{{$commentprojects->id}}" class="edit-comment"></div>
            </li>

    @endforeach

    </ul>
    @if($checkDisplayComment)
    <form action="{{URL::to('/admin/commentprojects/create')}}" method="post">
        @include('partials.error')
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="project_id" value="{{$project->id}}"/>
        Comment: <textarea class="form-control" name="content" id="" cols="60" rows="5"></textarea>
        <button type="submit" class="btn btn-default">Send</button>
    </form>
    @endif
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
                }).always(function(){
                    checkAjax = false;
                });
                ;
            });
        });
        $(document).on('keyup', 'input.text-comment', function(evt){
            if(evt.keyCode == 27){
                $(this).remove();
                $('#notifica').remove();
            }else if(evt.keyCode == 13){
            }
        });

    </script>
@stop

@section('scripts')
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        $('#select2').select2();
    </script>
@endsection