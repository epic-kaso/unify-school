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
        $response = [];
        $results = $excelImport->get();

        foreach ($results as $result) {
            $response[] = new  StudentExcelObjectAdapter($result);
        }

        return \Response::json($response);
    }

}