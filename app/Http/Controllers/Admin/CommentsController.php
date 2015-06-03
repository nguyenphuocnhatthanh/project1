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

    /**
     * @param Requests\FormCommentsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Requests\FormCommentsRequest $request){
        if($this->comment->save($request, \Auth::user()->id)) {
            return redirect('/admin/tasks/detail/'.$request->get('task_id'));
        }
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){
        $comment = $this->comment->getByID($id);
        if($comment->user->id == \Auth::user()->id) {
            if($this->comment->delete($id)) {
                return redirect('/admin/tasks/detail/'.\Session::get('task_id'));
            }

            return redirect('/admin/tasks/detail/'.\Session::get('task_id'));
        }

        return redirect('/admin/tasks/detail/'.\Session::get('task_id'));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id){
        $comment = $this->comment->getByID($id);
        return \Response::json(view('admin.comments.edit', compact('comment'))->render());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(Request $request){
        $this->comment->save($request, \Auth::user()->id);
        return redirect('/admin/tasks/detail/'.$request->get('task_id'));
    }

}
