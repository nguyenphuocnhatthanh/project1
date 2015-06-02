<?php namespace App\Events;

use App\Comment;
use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class DeleteCommentsToDeleteTask extends Event {

	use SerializesModels;
    /**
     * @var Comment
     */
    private $comments;


    /**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($comments)
	{
		//
        $this->comments = $comments;
    }

    public function deletingComment(){
        $ids = [];
        foreach($this->comments as $comment){
            $ids[] = $comment->id;
        }

        Comment::query()->whereIn('id', $ids)->delete();
    }

}
