<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 11:46 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;

use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Repositories\School\ScopedSessionRepository;
use UnifySchool\Repositories\School\ScopedSubSessionTypeRepository;

class SessionTermSettingsController extends Controller {

    public function index(
        ScopedSessionRepository $sessionRepository,
        ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {
        $bundle = [
            'current_session' => $sessionRepository->getCurrentSession(),
            'current_sub_session' => $subSessionTypeRepository->getCurrentSubSession(),
        ];

        return \Response::json($bundle);
    }

    public function show($id)
    {

    }

    public function store(ScopedSessionRepository $sessionRepository,
                          ScopedSubSessionTypeRepository $subSessionTypeRepository)
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }
}