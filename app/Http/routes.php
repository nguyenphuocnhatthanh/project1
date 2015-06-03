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

    get('tasks', ['uses' => 'TasksController@index', 'middleware' => 'roles', 'roles' => ['member', 'manage']]);
    get('tasks/create', 'TasksController@getCreate');
    get('tasks/edit/{id}', 'TasksController@getEdit');
    get('tasks/delete/{id}', 'TasksController@delete');
    get('tasks/detail/{id}', 'TasksController@detail');

    post('tasks/create', 'TasksController@postCreate');
    post('tasks/edit/{id}', 'TasksController@postEdit');

    /**
     * Route Comment
     */

    get('comments/delete/{id}', 'CommentsController@delete');
    get('comments/edit/{id}', 'CommentsController@edit');

    post('comments/create', 'CommentsController@create');
    post('comments/edit/{id}', 'CommentsController@postEdit');

    /**
     * Route Project
     */

    get('projects', 'ProjectsController@index');
    get('projects/create', 'ProjectsController@getCreate');
    get('projects/edit/{id}', 'ProjectsController@getEdit');
    get('projects/delete/{id}', 'ProjectsController@delete');
    get('projects/detail/{id}', 'ProjectsController@detail');

    post('projects/create', 'ProjectsController@postCreate');
    post('projects/edit/{id}', 'ProjectsController@postEdit');

    /**
     * Route CommentProject
     */

    get('commentprojects/delete/{id}', 'CommentProjectsController@delete');
    get('commentprojects/edit/{id}', 'CommentProjectsController@edit');

    post('commentprojects/create', 'CommentProjectsController@create');
    post('commentprojects/edit/{id}', 'CommentProjectsController@postEdit');
});



get('test', function(){
    $array = ['foo', 'aa','test'];
    list($key, $value) = $array;
    dd($key, $value);
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
