<?php namespace App\Http\Controllers\Admin;

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

    public function index(Request $request){
        $tasks = $this->task->paginate(10);
        if($request->has('search'))
            $tasks = $this->task->search($request->get('search'));
        $tasks->setPath('/public/admin/tasks');

        return view('admin.tasks.index', compact('tasks'));
    }

}
