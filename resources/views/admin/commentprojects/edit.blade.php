<form id="editComment" action="{{URL::to('/admin/commentprojects/edit/'.$commentproject->id)}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="id" value="{{$commentproject->id}}"/>
    <input type="hidden" name="project_id" value="{{$commentproject->project->id}}"/>
    <input type="hidden" name="user_id" value="{{$commentproject->user->id}}"/>
    <input name="content" class="form-control text-comment" cols="50" rows="5" type="text" value="{{$commentproject->content}}">
    <span id="notifica">Enter to save or Esc to Exit</span>
</form>
