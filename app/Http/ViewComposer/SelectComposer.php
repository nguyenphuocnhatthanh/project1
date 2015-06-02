<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 1:34 PM
 */

namespace App\Http\ViewComposer;


use Illuminate\Contracts\View\View;

class SelectComposer {

    private $role = ['manage', 'member'];

    public function __construct(){

    }

    public function compose(View $view){
        $view->with('role', $this->role);
    }
}