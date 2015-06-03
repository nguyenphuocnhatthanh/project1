<?php
/**
 * Created by PhpStorm.
 * User: Thanh
 * Date: 6/2/2015
 * Time: 11:18 AM
 */

namespace App\Impl;


use App\Comment;
use App\Commentproject;
use App\Impl\Comment\CommentEloquent;
use App\Impl\CommentProject\CommentProjectEloquent;
use App\Impl\Project\ProjectEloquent;
use App\Impl\Task\TaskEloquent;
use App\Impl\User\UserEloquent;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Impl\User\UserInterface', function(){
            return new UserEloquent(new User());
        });

        $this->app->bind('App\Impl\Task\TaskInterface', function(){
            return new TaskEloquent(new Task());
        });

        $this->app->bind('App\Impl\Comment\CommentInterface', function(){
            return new CommentEloquent(new Comment());
        });

        $this->app->bind('App\Impl\Project\ProjectInterface', function(){
            return new ProjectEloquent(new Project());
        });

        $this->app->bind('App\Impl\CommentProject\CommentProjectInterface', function(){
            return new CommentProjectEloquent(new Commentproject());
        });
    }

}