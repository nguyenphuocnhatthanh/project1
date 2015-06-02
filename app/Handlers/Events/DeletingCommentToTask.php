<?php namespace App\Handlers\Events;

use App\Events\DeleteCommentsToDeleteTask;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class DeletingCommentToTask {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  DeleteCommentsToDeleteTask  $event
	 * @return void
	 */
	public function handle(DeleteCommentsToDeleteTask $event)
	{
		$event->deletingComment();
	}

}
