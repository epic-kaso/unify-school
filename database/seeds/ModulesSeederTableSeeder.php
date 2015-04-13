<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use UnifySchool\Module;

class ModulesSeederTableSeeder extends Seeder {

    public function run()
    {
        DB::table('modules')->truncate();

        $modules = array(
            [
                'school_type_id' => '2',
                'name' => 'students',
                'path' => 'school/modules/admin',
                'menu' => [["name"=>"Enroll A Student","route"=>"enroll_student"],["name"=>"Enroll Many Students","route"=>"enroll_students"],["name"=>"Import Students","route"=>"import"],["name"=>"Export Students","route"=>"export"],["name"=>"Manage Students","route"=>"manage"]],
                'actions' => '',
                'data' => [],
                'active' => '1'
            ],
            [
                'school_type_id' => '2',
                'name' => 'academics',
                'path' => 'school/modules/admin',
                'menu' => [["name"=>"Upload Grades","route"=>"upload_grades"],["name"=>"View Grades","route"=>"view_grades"],["name"=>"Performance Analysis","route"=>"performance_analysis"]],
                'actions' => '',
                'data' => [],
                'active' => '1'
            ],
            [
                'school_type_id' => '2',
                'name' => 'staff',
                'path' => 'school/modules/admin',
                'menu' => [["name"=>"Add Staff","route"=>"add-staff"],["name"=>"View Staff","route"=>"view-staff"],["name"=>"Manage Staff","route"=>"manage-staff"]],
                'actions' => '',
                'data' => [],
                'active' => '1'
            ],
            [
                'school_type_id' => '2',
                'name' => 'reports',
                'path' => 'school/modules/admin',
                'menu' => [["name"=>"Generate Reports","route"=>"generate-reports"],["name"=>"Manage Reports","route"=>"manage-reports"]],
                'actions' => '',
                'data' => [],
                'active' => '1'
            ]
        );

        DB::transaction(function () use($modules) {
            foreach($modules as $module){
                $m = new Module();
                foreach($module as $key => $value){
                    $m->{$key} = $value;
                }
                $m->save();
            }
        });
    }

}