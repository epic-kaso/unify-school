<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/19/2015
 * Time: 4:21 PM
 */

namespace UnifySchool\Entities\Resources\Excel;


use Illuminate\Foundation\Bus\DispatchesCommands;
use Maatwebsite\Excel\Files\ExcelFile;
use UnifySchool\Commands\UploadStudentsExcelImportDocument;

class StudentExcelImport extends ExcelFile
{

    use DispatchesCommands;

    protected $formName = 'excel_file';

    /**
     * Get file
     * @return string
     */
    public function getFile()
    {
        $file = $this->dispatch(new UploadStudentsExcelImportDocument(\Input::file($this->formName)));
        return $file->getPathname();
    }
}