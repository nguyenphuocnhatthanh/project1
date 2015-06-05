<?php namespace App\Handlers\Events;

use App\Events\DeletingDataMapProject;

use App\Impl\Comment\CommentInterface;
use App\Impl\Task\TaskInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class DeleteHandlerProject {
    /**
     * @var CommentInterface
     */
    private $comment;
    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * Create the event handler.
     *
     * @param CommentInterface $comment
     * @param TaskInterface $task
     */
    public function __construct(CommentInterface $comment, TaskInterface $task) {
        //
        $this->comment = $comment;
        $this->task = $task;
    }

    /**
     * Handle the event.
     *
     * @param  DeletingDataMapProject $event
     * @return void
     */
    public function handle(DeletingDataMapProject $event) {
        $event->deleteDataMapProject($this->comment, $this->task);
    }

}
