<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 4:28 PM
 */

namespace App\Impl\Comment;


use App\Impl\Repository;

interface CommentInterface extends Repository{
    /**
     * @param $request
     * @param $userID
     * @param $moduleID
     * @param $recordID
     * @return mixed
     */
    public function save($request, $userID, $moduleID, $recordID);

    /**
     * @param $id
     * @param $moduleID
     * @param $recordID
     * @return mixed
     */
    public function deleteComment($id, $moduleID, $recordID);

    /**
     * @param array $ids
     * @return mixed
     */
    public function deleteMultiComment($ids = []);

    /**
     * @param $moduleID
     * @param $recordID
     * @return mixed
     */
    public function comments($moduleID, $recordID);

    /**
     * @param $moduleID
     * @param $recordID
     * @return mixed
     */
    public function allCommnentToModule($moduleID, $recordID);

    /**
     * @param $moduleID
     * @return mixed
     */
    public function allCommentToMultiModule($moduleID);

    public function allCommentModuleToModule($moduleID, $recordID);
}