<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 2:21 PM
 */

namespace App\Impl\Task;


use App\Impl\AbstractRepository;
use App\Task;

class TaskEloquent extends AbstractRepository implements TaskInterface{
    /**
     * @var Task
     */
    protected $model;

    public function __construct(Task $task){
        $this->model = $task;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function save($request)
    {
        if($request->has('id')){
            $task = $this->getByID($request->get('id'));
        }else{
            $task = new $this->model;
        }

        $task->name = $request->get('name');
        $task->user_id = \Auth::user()->id;
        $task->description = $request->get('description');
        $task->status = 0;

        return $task->save();
    }

    /**
     * @param $search
     * @param $adj
     * @return mixed
     */
    public function search($search, $adj = 10)
    {
        return $this->model->query()->where('name', 'LIKE', '%'.$search.'%')->paginate($adj);
    }
}