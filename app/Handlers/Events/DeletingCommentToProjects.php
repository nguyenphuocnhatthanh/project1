<?php namespace App\Handlers\Events;

use App\Events\DeleteComentsToDeleteProject;
use App\Events\DeleteComentToDeleteProject;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class DeletingCommentToProjects {

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
	 * @param  DeleteComentToDeleteProject  $event
	 * @return void
	 */
	public function handle(DeleteComentsToDeleteProject $event)
	{
		$event->deletingComment();
	}

}
