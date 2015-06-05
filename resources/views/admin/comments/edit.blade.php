<form id="editComment" action="{{URL::to('/admin/comments/edit/'.$comment->id)}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="id" value="{{$comment->id}}"/>
    <input type="hidden" name="task_id" value="{{$comment->record_id}}"/>
    <input type="hidden" name="user_id" value="{{$comment->user_id}}"/>
    <input type="hidden" name="module_id" value="{{$comment->module_id}}"/>
    <input type="hidden" name="record_id" value="{{$comment->record_id}}"/>
    <input name="body" class="form-control text-comment" cols="50" rows="5" type="text" value="{{$comment->body}}">
    <span id="notifica">Enter to save or Esc to Exit</span>
</form>
