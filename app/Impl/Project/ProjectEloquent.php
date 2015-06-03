<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/3/2015
 * Time: 3:07 PM
 */

namespace App\Impl\Project;


use App\Commentproject;
use App\Events\DeleteComentsToDeleteProject;
use App\Impl\AbstractRepository;
use App\Project;
use App\User;

class ProjectEloquent extends AbstractRepository implements ProjectInterface {

    /**
     * @var Project
     */
    protected $model;

    function __construct(Project $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function save($request){
        if($request->has('id')) {
            $project = $this->getByID($request->get('id'));
        }else{
            $project = new $this->model;
        }

        $project->name = $request->get('name');
        $project->description = $request->get('description');

        $project->save();
        $project->users()->sync(User::prepareForUsersSave($request->get('users')));

        return $project->id;
    }

    /**
     * @param $search
     * @param int $adj
     * @return mixed
     */
    public function search($search, $adj = 10)
    {
        return $this->model->query()->where('name', 'LIKE', '%'.$search.'%')->paginate($adj);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id )
    {
        $project = $this->getByID($id);
        $commentprojects = $project->commentprojects;
        $bool = $project->users()->detach();
        $this->delete($id);
        if($bool) \Event::fire(new DeleteComentsWithTasksToDeleteProject($commentprojects));
        return $bool;
    }


}