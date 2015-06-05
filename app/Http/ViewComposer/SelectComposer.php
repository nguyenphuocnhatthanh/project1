<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 1:34 PM
 */

namespace App\Http\ViewComposer;


use App\Project;
use App\User;
use Illuminate\Contracts\View\View;

class SelectComposer {

    private $role = ['manage', 'member'];

    protected $user;
    /**
     * @var Project
     */
    private $project;

    public function __construct(User $user, Project $project) {
        $this->user = $user;
        $this->project = $project;
    }

    public function compose(View $view) {
        $view->with('role', $this->role);
        $view->with('users', $this->user->all()->lists('name', 'id'));
        $view->with('projects', $this->project->all()->lists('name', 'id'));
    }
}