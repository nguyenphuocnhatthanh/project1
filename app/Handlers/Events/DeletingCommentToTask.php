<?php namespace App\Handlers\Events;

use App\Events\DeleteCommentsToDeleteTask;

use App\Impl\Comment\CommentInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class DeletingCommentToTask {
    /**
     * @var CommentInterface
     */
    private $comment;

    /**
     * Create the event handler.
     *
     * @param CommentInterface $comment
     */
    public function __construct(CommentInterface $comment) {

        $this->comment = $comment;
    }

    /**
     * Handle the event.
     *
     * @param  DeleteCommentsToDeleteTask $event
     * @return void
     */
    public function handle(DeleteCommentsToDeleteTask $event) {
        $event->deletingComment($this->comment);
    }

}
