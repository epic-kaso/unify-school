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

        if (!\File::exists(storage_path($school->slug . '/imports'))) {
            \File::makeDirectory(storage_path($school->slug . '/imports', true));
        }

        $name = "import_" . Str::slug(Carbon::now()->toDateTimeString()) . "." . $this->uploadedFile->getClientOriginalExtension();
        $file = $this->uploadedFile->move(storage_path($school->slug . '/imports'), $name);

        return $file;
    }

}
