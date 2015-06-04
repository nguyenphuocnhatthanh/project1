<?php namespace App\Events;

use App\Comment;
use App\Commentproject;
use App\Events\Event;

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
    private $taskComments;

    /**
     * Create a new event instance.
     *
     * @param array $comments
     * @param $tasks
     * @param $taskComments
     */
	public function __construct($commentprojects = [], $tasks, $taskComments)
	{
		//
        $this->commentprojects = $commentprojects;
        $this->tasks = $tasks;
        $this->taskComments = $taskComments;
    }

    /**
     *Delete data map project
     */
    public function deleteDataMapProject(){
        $CommentProjectids = [];
        $tasksIds =[];
        $commentIds = [];
        foreach($this->commentprojects as $commentproject) {
            $CommentProjectids[] = $commentproject->id;
        }

        foreach($this->tasks as $task){
            $tasksIds[] = $task->id;
        }

        foreach($this->taskComments as $taskComments){
            foreach($taskComments->comments as $comment) {
                $commentIds[] = $comment->id;
            }
        }

        Commentproject::query()->whereIn('id', $CommentProjectids)->delete();
        Comment::query()->whereIn('id', $commentIds)->delete();
        Task::query()->whereIn('id', $tasksIds)->delete();

    }

}
