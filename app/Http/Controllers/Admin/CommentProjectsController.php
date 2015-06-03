<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Impl\CommentProject\CommentProjectInterface;
use App\Impl\Project\ProjectInterface;
use Illuminate\Http\Request;

class CommentProjectsController extends Controller {

    /**
     * @var CommentProjectInterface
     */
    private $commentproject;
    /**
     * @var ProjectInterface
     */
    private $project;

    public function __construct(CommentProjectInterface $commentproject, ProjectInterface $project){

        $this->commentproject = $commentproject;
        $this->project = $project;
    }

    public function create(Requests\FormCommentProjectsRequest $request){

       $project = $this->project->getByID($request->get('project_id'));

        foreach($project->users as $user) {
            if($user->id == \Auth::user()->id) {
                $this->commentproject->save($request, $user->id);

                return redirect('/admin/projects/detail/'.$request->get('project_id'));
            }
        }

        return redirect()->back();

	}

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){
        $commentproject = $this->commentproject->getByID($id);
        if($commentproject->user->id == \Auth::user()->id) {
            if($this->commentproject->delete($id)) {
                return redirect('/admin/projects/detail/'.\Session::get('project_id'));
            }

            return redirect('/admin/projects/detail/'.\Session::get('project_id'));
        }

        return redirect('/admin/projects/detail/'.\Session::get('project_id'));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id){
        $commentproject = $this->commentproject->getByID($id);
        return \Response::json(view('admin.commentprojects.edit', compact('commentproject'))->render());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(Request $request){
        $this->commentproject->save($request, \Auth::user()->id);
        return redirect('/admin/projects/detail/'.$request->get('project_id'));
    }

}
