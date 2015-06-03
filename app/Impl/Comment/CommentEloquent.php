<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 4:28 PM
 */

namespace App\Impl\Comment;


use App\Comment;
use App\Impl\AbstractRepository;

class CommentEloquent extends AbstractRepository implements CommentInterface{

    /**
     * @var Comment
     */
    protected $model;

    public function __construct(Comment $comment){
        $this->model = $comment;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function save($request, $userID)
    {
        if($request->has('user_id') && $request->get('user_id') == $userID && $request->has('id')) {
            $comment = $this->getByID($request->get('id'));
            $comment->body = $request->get('body');

            return $comment->save();
        }else{
            $comment = new $this->model;
            $comment->body = $request->get('body');
            $comment->task_id = $request->get('task_id');
            $comment->user_id = $userID;

            return $comment->save();
        }


    }
}