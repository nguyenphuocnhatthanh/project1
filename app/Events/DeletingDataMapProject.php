<?php namespace App\Events;

use App\Comment;
use App\Commentproject;
use App\Events\Event;

use App\Impl\Comment\CommentInterface;
use App\Impl\Task\TaskInterface;
use App\Task;
use Illuminate\Queue\SerializesModels;

class DeletingDataMapProject extends Event {

    use SerializesModels;
    /**
     * @var array
     */
    private $commentprojects;
    /**
     * @var
     */
    private $tasks;
    /**
     * @var
     */
    private $recordID;

    /**
     * Create a new event instance.
     *
     * @param $tasks
     * @param $taskComments
     */
    public function __construct($recordID, $tasks) {
        //
        $this->tasks = $tasks;
        $this->recordID = $recordID;
    }

    /**
     *Delete data map project
     */
    public function deleteDataMapProject(CommentInterface $commentInterface, TaskInterface $taskInterface) {
        $commentIDs = [];
        $tasksIds = [];
        $moduleIDs = [1];


        foreach ($this->tasks as $task) {
            $tasksIds[] = $task->id;
            $moduleIDs[2][] = $task->id;
        }

        foreach ($commentInterface->allCommentToMultiModule($moduleIDs) as $comment) {
            $commentIDs[] = $comment->id;
        }

        $commentInterface->deleteMultiComment($commentIDs);
        $taskInterface->deleteMultiRecord($tasksIds);

        /* \Event::listen('illuminate.query', function($query)
         {
             var_dump($query);
         });*/
        //  dd($commentInterface->allCommentToMultiModule($moduleID));


        /*Commentproject::query()->whereIn('id', $CommentProjectids)->delete();
        Comment::query()->whereIn('id', $commentIds)->delete();
        Task::query()->whereIn('id', $tasksIds)->delete();*/

    }

}
