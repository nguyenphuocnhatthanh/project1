<?php namespace App\Handlers\Events;

use App\Events\DeletingDataMapProject;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class DeleteHandlerProject {

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
	 * @param  DeletingDataMapProject  $event
	 * @return void
	 */
	public function handle(DeletingDataMapProject $event)
	{
		$event->deleteDataMapProject();
	}

}
