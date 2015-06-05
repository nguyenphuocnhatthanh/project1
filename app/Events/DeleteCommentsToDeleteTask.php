<?php namespace App\Events;

use App\Comment;
use App\Events\Event;

use App\Impl\Comment\CommentInterface;
use Illuminate\Queue\SerializesModels;

class DeleteCommentsToDeleteTask extends Event {

    use SerializesModels;

    /**
     * @var
     */
    private $recordID;


    /**
     * Create a new event instance.
     *
     * @param $comments
     * @param $recordID
     */
    public function __construct($recordID) {
        $this->recordID = $recordID;
    }

    public function deletingComment(CommentInterface $comments) {
        $ids = [];
        foreach ($comments->allCommnentToModule(2, $this->recordID) as $comment) {
            $ids[] = $comment->id;
        }

        return $comments->deleteMultiComment($ids, 2, $this->recordID);
    }

}
