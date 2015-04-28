<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 11:46 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;

use Carbon\Carbon;
use Illuminate\Support\Str;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Events\SessionAndTerm\CurrentSessionSet;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\SessionTermSettingsRequest;
use UnifySchool\Repositories\School\ScopedSessionRepository;
use UnifySchool\Repositories\School\ScopedSubSessionTypeRepository;

class SessionTermSettingsController extends Controller
{

    public static $action_save_sub_session_dates = "sub_session_start_and_end_dates";
    public static $action_add_sub_session = "add_sub_session";

    public function index(
        ScopedSessionRepository $sessionRepository,
        ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {
        $bundle = [
            'current_session' => is_null($sessionRepository->getCurrentSession()) ? null : $sessionRepository->getCurrentSession()->name,
            'current_sub_session' => is_null($subSessionTypeRepository->getCurrentSubSession()) ? null : $subSessionTypeRepository->getCurrentSubSession()->id,
        ];

        return \Response::json($bundle);
    }

    public function show($id)
    {

    }

    public function store(
        SessionTermSettingsRequest $request,
        ScopedSessionRepository $sessionRepository,
        ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {
        $action = $request->get('action', 'default');

        switch ($action) {
            case 'default':
                return $this->setOrCreateCurrentSession($request, $sessionRepository, $subSessionTypeRepository);
            case static::$action_save_sub_session_dates:
                return $this->saveSubSessionTimes($request, $subSessionTypeRepository);
            case static::$action_add_sub_session:
                return $this->addSubSession($request, $subSessionTypeRepository);
        }

    }

    public function update($id)
    {

    }

    public function destroy($id,
                            SessionTermSettingsRequest $request,
                            ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {
        $action = $request->get('action', 'default');

        switch ($action) {
            case 'default':
                break;
            case static::$action_save_sub_session_dates:
                break;
            case static::$action_add_sub_session:
                $subSessionTypeRepository->delete($id);
                return \Response::json(['all' => ScopedSessionType::with('sub_sessions')->where('school_id', $this->getSchool()->id)->first()->sub_sessions]);
        }
    }

    private function saveSubSessionTimes(
        SessionTermSettingsRequest $request,
        ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {
        $subSessions = $request->get('sub_sessions');

        if (is_null($subSessions))
            return \Response::json(['success' => false], 404);

        foreach ($subSessions as $sub) {
            $subSession = $subSessionTypeRepository->find($sub['id']);
            $subSession->start_date = Carbon::parse($sub['start_date']);
            $subSession->end_date = Carbon::parse($sub['end_date']);
            $subSession->save();
        }

        return \Response::json(['success' => true]);
    }

    private function addSubSession(SessionTermSettingsRequest $request,
                                   ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {

        $school = $this->getSchool();

        $response = $subSessionTypeRepository->create([
            'scoped_session_type_id' => ScopedSessionType::first()->id,
            'school_id' => $school->id,
            'display_name' => $request->get('name'),
            'name' => Str::slug($request->get('name'))
        ]);

        return \Response::json(['all' => ScopedSessionType::with('sub_sessions')->where('school_id', $this->getSchool()->id)->first()->sub_sessions]);
    }

    /**
     * @param SessionTermSettingsRequest $request
     * @param ScopedSessionRepository $sessionRepository
     * @param ScopedSubSessionTypeRepository $subSessionTypeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function setOrCreateCurrentSession(SessionTermSettingsRequest $request, ScopedSessionRepository $sessionRepository, ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {
        $sessionRepository->setCurrentSession($request->get('current_session'));
        $value = $request->get('current_sub_session');

        if(!empty($value)) {
            $subSessionTypeRepository->setCurrentSubSession($value);
        }

        event(new CurrentSessionSet());

        return \Response::json(['success' => true]);
    }
}