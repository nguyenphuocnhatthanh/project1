<?php namespace App\Impl\Task;
use App\Impl\Repository;

/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 2:19 PM
 */

interface TaskInterface extends Repository{
    /**
     * @param $request
     * @return mixed
     */
    public function save($request);

    /**
     * @param $search
     * @param $adj
     * @return mixed
     */
    public function search($search, $adj = 10);
}