<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 1:36 PM
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider{

    public function boot(){
        $this->roleUsers();
        $this->listUsers();
        $this->listProjects();
    }

    public function roleUsers(){
        \View::composer(['admin.users.create', 'admin.users.edit'],
            'App\Http\ViewComposer\SelectComposer'
        );
    }

    public function listUsers(){
        \View::composer(['admin.projects.create', 'admin.projects.edit', 'admin.projects.detail'],
            'App\Http\ViewComposer\SelectComposer'
        );
    }

    public function listProjects(){
        \View::composer(['admin.tasks.create', 'admin.tasks.edit', 'admin.tasks.detail'],
            'App\Http\ViewComposer\SelectComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}