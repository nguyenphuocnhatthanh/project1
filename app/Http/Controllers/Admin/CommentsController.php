<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Impl\Comment\CommentInterface;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    /**
     * @var CommentInterface
     */
    private $comment;

    public function __construct(CommentInterface $comment){

        $this->comment = $comment;
    }

    public function create(Requests\FormCommentsRequest $request){
        if($this->comment->save($request, \Auth::user()->id)) {
            return redirect('/admin/tasks/detail/'.$request->get('task_id'));
        }
    }

}
