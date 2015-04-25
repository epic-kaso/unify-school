<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 8:11 AM
 */

namespace UnifySchool\Repositories;


use Illuminate\Foundation\Bus\DispatchesCommands;
use UnifySchool\Commands\School\UpdateSchoolAdminDetails;
use UnifySchool\Commands\School\UpdateSchoolCategories;
use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\Http\Requests\CreateSchoolRequest;
use UnifySchool\School;
use UnifySchool\SchoolProfile;
use UnifySchool\Services\SchoolSetupInfo;

class SchoolRepository extends BaseRepository
{

    use DispatchesCommands;
    /**
     * Specify Model class name
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->withData()->get();
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->withData()->find($id);
    }


    public function model()
    {
        return School::class;
    }

    public function create(array $data)
    {
        $school = parent::create($data);
        SchoolProfile::create(['school_id' => $school->id]);
        return $school;
    }


    public function setSchoolType(School $school, ScopedSchoolType $schoolType)
    {
        $school->setSchoolType($schoolType);
    }

    public function update(array $data, $id, $attribute = "id")
    {
        $schoolInfo = \App::make(SchoolSetupInfo::class);
        $school = $this->model->where($attribute, '=', $id)->first();
        $data['setup_complete'] = $schoolInfo->isSetupComplete($school);

        \Cache::flush();

        return $school->update($data);
    }



    public function updateAdminLoginDetails(CreateSchoolRequest $request)
    {
        $admin_email = $request->get('admin_email');
        $admin_password = $request->get('admin_password');

        $updateAdminDetailsCmd = new UpdateSchoolAdminDetails($admin_email, $admin_password, $this->getSchool());
        $this->dispatch($updateAdminDetailsCmd);
    }

    public function updateSchoolCategories(CreateSchoolRequest $request)
    {
        $school_type = $request->get('school_type');

        if (isset($school_type['school_categories'])) {
            $updateSchoolCategoriesCommand =
                new UpdateSchoolCategories($school_type['school_categories'], $this->getSchool());
            $this->dispatch($updateSchoolCategoriesCommand);
        }
    }

}