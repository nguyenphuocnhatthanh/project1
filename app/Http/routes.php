<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::pattern('id', '([\d]+)');


Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function(){

    /**
     * Route User
     */
    Route::group(['middleware' => 'roles', 'roles' => ['manage']], function(){
        get('users', 'UsersController@index');
        get('users/create', 'UsersController@getCreate');
        get('users/edit/{id}', 'UsersController@getEdit');
        get('users/delete/{id}', 'UsersController@delete');

        post('users/create', 'UsersController@postCreate');
        post('users/edit/{id}', 'UsersController@postEdit');
    });


    /**
     * Route Task
     */


    get('tasks/create', 'TasksController@getCreate');
    get('tasks/edit/{id}', 'TasksController@getEdit');
    get('tasks/delete/{id}', 'TasksController@delete');

    post('tasks/create', 'TasksController@postCreate');
    post('tasks/edit/{id}', 'TasksController@postEdit');
});

get('admin/tasks', ['uses' => 'Admin\TasksController@index', 'middleware' => 'roles', 'roles' => ['member', 'manage']]);

get('test', function(){
    $tasks = \App\Task::all();
    $username = [];
    foreach($tasks as $task){
        $username[] = $task->user->name;
    }
    dd($username);
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
