<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/3/2015
 * Time: 3:06 PM
 */

namespace App\Impl\Project;


use App\Impl\Repository;

interface ProjectInterface extends Repository{
    /**
     * @param $request
     * @return mixed
     */
    public function save($request);

    /**
     * @param $search
     * @param int $adj
     * @return mixed
     */
    public function search($search, $adj = 10);
}