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
     * @return mixed
     */
    public function save($request, $userID);
}