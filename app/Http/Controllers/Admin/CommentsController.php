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

    public function __construct(CommentInterface $comment) {

        $this->comment = $comment;
    }

    /**
     * @param Requests\FormCommentsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Requests\FormCommentsRequest $request) {
        $moduleID = \Session::get('module_id');
        $recordID = \Session::get('record_id');

        if ($this->comment->save($request, \Auth::user()->id, $moduleID, $recordID)) {
            if($moduleID == 1) return redirect('/admin/projects/detail/' . $recordID);
            return redirect('/admin/tasks/detail/' . $recordID);
        }
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id) {
        $comment = $this->comment->getByID($id);
        if ($comment->user->id == \Auth::user()->id) {
            $moduleID = \Session::get('module_id');
            $recordID = \Session::get('record_id');

            if ($this->comment->deleteComment($id, $moduleID, $recordID)) {
                if($moduleID == 1) return redirect('/admin/projects/detail/' . $recordID);
                return redirect('/admin/tasks/detail/' . $recordID);
            }

            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id, Request $request) {

        if ($request->ajax()) {
            $comment = $this->comment->getByID($id);
            return \Response::json(view('admin.comments.edit', compact('comment'))
                ->with('module_id', \Session::get('module_id'))
                ->with('record_id', \Session::get('record_id'))
                ->with('task_id', \Session::get('task_id'))
                ->render()
            );
        }

        return \App::abort('403');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(Request $request) {
        $this->comment->save($request, \Auth::user()->id, $request->get('module_id'), $request->get('record_id'));
        $module_id = $request->get('module_id');

        if($module_id == 1) return redirect('/admin/projects/detail/' . $request->get('task_id'));

        return redirect('/admin/tasks/detail/' . $request->get('task_id'));
    }


}
