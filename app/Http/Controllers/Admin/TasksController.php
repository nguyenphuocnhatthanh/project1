<?php namespace App\Http\Controllers\Admin;

use App\Events\DeleteCommentsToDeleteTask;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Impl\Task\TaskInterface;
use App\User;
use Illuminate\Http\Request;

class TasksController extends Controller {


    /**
     * @var TaskInterface
     */
    private $task;

    public function __construct(TaskInterface $task){

        $this->task = $task;
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request){
        $tasks = $this->task->paginate(10);
        if($request->has('search'))
            $tasks = $this->task->search($request->get('search'));
        $tasks->setPath('/public/admin/tasks');

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function detail($id){
        $task = $this->task->getByID($id);
        \Session::flash('task_id', $id);
        return view('admin.tasks.detail', compact('task'));
    }

    /*public function postDetail(Requests\FormCommentsRequest $request){

    }*/

    /**
     * @return \Illuminate\View\View
     */
    public function getCreate(){
        return view('admin.tasks.create');
    }

    /**
     * @param Requests\FormTasksRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCreate(Requests\FormTasksRequest $request){
        if($this->task->save($request)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Create successfully');
            return redirect('/admin/tasks');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Create failed');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getEdit($id){
        $task = $this->task->getByID($id);
        if(\Auth::user()->id == $task->user->id || \Auth::user()->role == 'manage')
            return view('admin.tasks.edit', compact('task'));
        return redirect('/admin/tasks');
    }

    /**
     * @param Requests\FormTasksRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(Requests\FormTasksRequest $request){
        if($this->task->save($request)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Edit successfully');
            return redirect('/admin/tasks');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Edit failed');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){

        $task = $this->task->getByID($id);

        if($task->user->id == \Auth::user()->id){
            if($this->task->delete($id)) {
                \Session::flash('statusAction' , 'success');
                \Session::flash('messageAction', 'Delete successfully');
                return redirect('/admin/tasks');
            }

            return redirect('/admin/tasks');
        }

        return redirect('/admin/tasks');
    }

}
