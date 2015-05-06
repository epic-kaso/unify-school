<?php namespace UnifySchool\Commands;

use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UnifySchool\Entities\Context\SchoolContextTrait;

class UploadStudentsExcelImportDocument extends Command implements SelfHandling
{
    use SchoolContextTrait;

    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * Create a new command instance.
     *
     * @param UploadedFile $uploadedFile
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        //
        $this->uploadedFile = $uploadedFile;
        $this->storage = \Storage::disk('local');
    }

    /**
     * Execute the command.
     *
     * @return File A File object representing the new file
     */
    public function handle()
    {
        $school = $this->getSchool();
        $import_path = storage_path($school->slug);

        if (!\File::exists($import_path)) {
            \File::makeDirectory($import_path,true);
        }

        $name = "import_" . Str::slug(Carbon::now()->toDateTimeString()) . "." . $this->uploadedFile->getClientOriginalExtension();
        $file = $this->uploadedFile->move($import_path, $name);

        return $file;
    }

}
