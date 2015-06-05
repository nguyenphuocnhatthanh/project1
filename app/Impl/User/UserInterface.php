<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 11:19 AM
 */

namespace App\Impl\User;


use App\Impl\Repository;

interface UserInterface extends Repository {
    /**
     * @param $request
     * @return mixed
     */
    public function save($request);


    /**
     * @param $search : search column name
     * @param $adj : record perpage paginate
     * @return mixed
     */
    public function search($search, $adj);
}