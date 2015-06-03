<?php namespace App\Events;

use App\Commentproject;
use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class DeleteComentsToDeleteProject extends Event {

	use SerializesModels;
    /**
     * @var
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
        foreach($this->comments as $comment) {
            $ids[] = $comment->id;
        }

        Commentproject::query()->whereIn('id', $ids)->delete();
    }

}
