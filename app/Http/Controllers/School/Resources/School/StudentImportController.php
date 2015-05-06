<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/19/2015
 * Time: 4:45 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\School;


use UnifySchool\Commands\UploadStudentsExcelImportDocument;
use UnifySchool\Entities\Legacy\Adapters\StudentExcelObjectAdapter;
use UnifySchool\Entities\Resources\Excel\StudentExcelImport;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\UploadStudentsExcelRequest;
use UnifySchool\Entities\Legacy\Adapters\ImportException;
use UnifySchool\Entities\School\ScopedSession;
use UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision;

class StudentImportController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadStudentsExcelImportDocument $excelImport
     * @param UploadStudentsExcelRequest $request
     *
     * @return array
     */
    public function store(StudentExcelImport $excelImport, UploadStudentsExcelRequest $request)
    {
        // get the results
        $import_class = $request->get('sub_class_id');
        $import_session_id = $request->get('session_id');
        
        $current_session = ScopedSession::currentSessionModel();
        
        $temp_session = ScopedSession::find($import_session_id);
        $import_session = empty($temp_session) ?  : $temp_session;
        
        
        
        $response = [];
        $failedImports = [];
        $successfulImports = [];
        $results = $excelImport->get();

        foreach ($results as $result) {
            $temp = new  StudentExcelObjectAdapter($result);
            try{
                $successfulImports[] = $temp->getStudentModel(
                    $this->getSchool(),
                    $current_session,
                    $import_session,
                    ScopedSchoolCategoryArmSubdivision::find($import_class) 
               );
            }catch(ImportException $e){
                $failedImports[] = $temp; 
            }
        }
        
        $response['successful'] = $successfulImports;
        $response['failure'] = $failedImports;
        

        return \Response::json($response);
    }

}