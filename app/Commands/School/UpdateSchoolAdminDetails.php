<?php namespace UnifySchool\Commands\School;

use Illuminate\Contracts\Bus\SelfHandling;
use UnifySchool\Commands\Command;
use UnifySchool\Entities\School\SchoolAdministrator;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\School;

class UpdateSchoolAdminDetails extends Command implements SelfHandling
{
    /**
     * @var
     */
    private $admin_email;
    /**
     * @var
     */
    private $admin_password;
    /**
     * @var School
     */
    private $school;

    /**
     * Create a new command instance.
     *
     * @param $admin_email
     * @param $admin_password
     * @param School $school
     */
    public function __construct($admin_email, $admin_password, School $school)
    {
        //
        $this->admin_email = $admin_email;
        $this->admin_password = $admin_password;
        $this->school = $school;
    }

    /**
     * Execute the command.
     *
     * @return mixed
     */
    public function handle()
    {
        $admin = new SchoolAdministrator();
        $admin->email = $this->admin_email;
        $admin->password = $this->admin_password;
        $admin->school_id = $this->school->id;

        $admin->save();

        //raise new school event
        \Event::fire(new NewSchoolRegistered($this->school, $admin));

        return $admin;

    }

}
