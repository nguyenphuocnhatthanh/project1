<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 11:19 AM
 */

namespace App\Impl\User;


use App\Impl\AbstractRepository;
use App\User;

class UserEloquent extends AbstractRepository implements UserInterface {

    /**
     * @var User
     */
    protected $model;

    function __construct(User $model) {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function save($request) {
        if ($request->has('id')) {
            $user = $this->getByID($request->get('id'));
        } else {
            $user = new $this->model;
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = \Hash::make('abcde');
        $user->role = $request->get('role') == 0 ? 'manage' : 'member';

        return $user->save();
    }


    /**
     * @param $search
     * @param int $adj
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($search, $adj) {
        return $this->model->query()->where('name', 'LIKE', '%' . $search . '%')->paginate($adj);
    }
}