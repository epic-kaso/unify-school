<?php namespace UnifySchool\Handlers\Events;

use UnifySchool\Entities\Resources\NonTertiary\SessionGenerator;
use UnifySchool\Entities\School\ScopedSession;
use UnifySchool\Events\TertiaryOrNonTertiarySchoolTypeDetected;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class GenerateDefaultSessionsForSchool {

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
	 * @param  TertiaryOrNonTertiarySchoolTypeDetected $event
	 * @param SessionGenerator $sessionGenerator
	 */
	public function handle(
		TertiaryOrNonTertiarySchoolTypeDetected $event
		)
	{
		\Log::debug('TertiaryNonTertiary Event Handler called');

	    $sessionGenerator = \App::make(SessionGenerator::class);
		$school = $event->getSchool();
		$sessions = $this->makeSessions($sessionGenerator);

		$school->sessions()->saveMany($sessions);
	}

	private function makeSessions(SessionGenerator $sessionGenerator)
	{
		$response = [];
		$current = $sessionGenerator->generateCurrentSession();
		$response[] = new ScopedSession(['name' => $current,'current_session' => 'true']);

		$lastTenYrs = $sessionGenerator->generatePastSession(10);
		$lastTenSessionModels = $this->generateSessionModels($lastTenYrs);


		$nextTenYrs = $sessionGenerator->generateFutureSession(10);
		$nextTenSessionModels = $this->generateSessionModels($nextTenYrs);

		return array_merge($lastTenSessionModels,$response,$nextTenSessionModels);
	}

	private function generateSessionModels($lastTenYrs)
	{
		$response = [];

		foreach($lastTenYrs as $title){
			$response[] = new ScopedSession(['name' => $title]);
		}

		return $response;
	}

}
