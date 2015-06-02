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
    }

    public function roleUsers(){
        \View::composer(['admin.users.create', 'admin.users.edit'],
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