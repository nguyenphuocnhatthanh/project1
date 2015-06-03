<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Impl\Project\ProjectInterface;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller {

    /**
     * @var ProjectInterface
     */
    private $project;

    public function __construct(ProjectInterface $project){

        $this->project = $project;
    }

    public function index(Request $request){
        $projects = $this->project->paginate(10);

        if($request->has('search')) {
            $projects = $this->project->search($request->get('search'));
        }
        $projects->setPath('/public/admin/projects');
        $projects->appends($request->query());

        return view('admin.projects.index', compact('projects'));
	}

    public function getCreate(){
        return view('admin.projects.create');
    }

    public function postCreate(Requests\FormProjectsRequest $request){
        if($this->project->save($request)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Edit successfully');
            return redirect('/admin/projects');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Edit failed');
        return redirect()->back();
    }

    public function delete($id){
        if($this->project->delete($id)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Delete successfully');
            return redirect('/admin/projects');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Delete failed');
        return redirect()->back();
    }

    public function getEdit($id){
        $project = $this->project->getByID($id);
        $usersIDs = Project::getUserIdToProject($project);
        return view('admin.projects.edit', compact('project', 'usersIDs'));
    }

    public function postEdit(Requests\FormProjectsRequest $request){
        if($this->project->save($request)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Edit successfully');
            return redirect('/admin/projects');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Edit failed');
        return redirect()->back();
    }

    public function detail($id){
        $project = $this->project->getByID($id);
        \Session::flash('project_id', $id);

        return view('admin.projects.detail', compact('project'))
            ->with('usersIDs', Project::getUserIdToProject($project))
            ->with('tasks', $project->tasks->lists('name', 'id'))
            ->with('UsersToProject', $project->users->lists('name', 'id'));
    }
}