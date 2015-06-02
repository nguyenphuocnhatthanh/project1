<?php namespace App\Impl;
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 11:14 AM
 */

interface Repository{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @return mixed
     */
    public function getByID($id);

    /**
     * @param array $with
     * @return mixed
     */
    public function make(array $with);

    /**
     * @param $adj
     * @param array $params
     * @return mixed
     */
    public function paginate($adj, array $params = []);

}