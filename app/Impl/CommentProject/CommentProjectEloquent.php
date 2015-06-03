<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/3/2015
 * Time: 4:34 PM
 */

namespace App\Impl\CommentProject;


use App\Commentproject;
use App\Impl\AbstractRepository;

class CommentProjectEloquent extends AbstractRepository implements CommentProjectInterface {


    /**
     * @var Commentproject
     */
    protected $model;

    public function __construct(Commentproject $model){

        $this->model = $model;
    }
    /**
     * @param $request
     * @return mixed
     */
    public function save($request, $userID)
    {
        if($request->has('id')) {
            $commentproject = $this->getByID($request->get('id'));
            $commentproject->content = $request->get('content');

            return $commentproject->save();
        }else{
            $commentproject = new $this->model;
            $commentproject->content = $request->get('content');
            $commentproject->project_id = $request->get('project_id');
            $commentproject->user_id = $userID;

            return $commentproject->save();
        }
    }

}