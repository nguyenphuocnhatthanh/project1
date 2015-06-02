<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 11:20 AM
 */

namespace App\Impl;


abstract class AbstractRepository {
    /**
     * @return mixed
     */
    public function all(){
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByID($id){
        return $this->model->findOrFail($id);
    }

    /**
     * @param $adj
     * @param array $params
     * @return mixed
     */
    public function paginate($adj, array $params = []){
        return $this->model->query()->paginate($adj);
    }

    /**
     * @param array $with
     * @return mixed
     */
    public function make(array $with = []){
        return $this->model->with($with);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id){
        $model = $this->getByID($id);
        return $model->delete();
    }
}