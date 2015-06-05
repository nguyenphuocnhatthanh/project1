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

class CommentEloquent extends AbstractRepository implements CommentInterface {

    /**
     * @var Comment
     */
    protected $model;

    public function __construct(Comment $comment) {
        $this->model = $comment;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function save($request, $userID, $moduleID, $recordID) {
        if ($request->has('user_id') && $request->get('user_id') == $userID && $request->has('id')) {
            $comment = $this->getByID($request->get('id'));
            $comment->body = $request->get('body');
            $comment->module_id = $moduleID;
            $comment->record_id = $recordID;
            $comment->task_id = $request->has('task_id') ? $request->has('task_id') : 0;

            return $comment->save();
        } else {
            $comment = new $this->model;
            $comment->body = $request->get('body');
            $comment->task_id = $request->get('task_id');
            $comment->user_id = $userID;
            $comment->module_id = $moduleID;
            $comment->record_id = $recordID;
            $comment->task_id = $request->has('task_id') ? $request->has('task_id') : 0;

            return $comment->save();
        }
    }

    /**
     * @param $id
     * @param $moduleID
     * @param $recordID
     * @return mixed
     */
    public function deleteComment($id, $moduleID, $recordID) {
        return $this->model->query()->where('id', '=', $id)
            ->where('module_id', '=', $moduleID)
            ->where('record_id', '=', $recordID)
            ->delete();
    }

    /**
     * @param $moduleID
     * @param $recordID
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function comments($moduleID, $recordID) {
        return $this->model->query()->where('module_id', '=', $moduleID)
            ->where('record_id', '=', $recordID)
            ->get();
    }

    public function allCommnentToModule($moduleID, $recordID) {
        return \DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')
            ->where('module_id', '=', $moduleID)
            ->where('record_id', '=', $recordID)
            ->select('comments.id', 'comments.body', 'comments.user_id', 'users.name')
            ->get();
    }

    public function deleteMultiComment($ids = []) {
        return $this->model->query()->whereIn('id', $ids)->delete();
    }

    public function allCommentToMultiModule($moduleIDs = []) {
        $query = \DB::table('comments');

        foreach ($moduleIDs as $key => $moduleID) {



            if(is_array($moduleID)) {
                $query->orWhere('module_id', '=', $key)->whereIn('record_id', $moduleID);
            }else $query->orWhere('module_id', '=', $moduleID);
        }

        $query->select('comments.id', 'comments.body', 'comments.user_id');

        return $query->get();
    }

    public function allCommentModuleToModule($moduleID, $recordID) {
        //return $this->model->query()->where('module_id', '=', $moduleID)

    }

}