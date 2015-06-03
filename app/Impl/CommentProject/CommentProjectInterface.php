<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/3/2015
 * Time: 4:34 PM
 */

namespace App\Impl\CommentProject;


use App\Impl\Repository;

interface CommentProjectInterface extends Repository{
    /**
     * @param $request
     * @return mixed
     */
    public function save($request, $userID);
}