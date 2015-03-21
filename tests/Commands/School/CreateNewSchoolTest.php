<?php
use Laracasts\TestDummy\Factory;
use UnifySchool\Commands\School\CreateNewSchool;
use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Repositories\School\ScopedSchoolCategoriesRepository;
use UnifySchool\Repositories\School\ScopedSchoolTypeRepository;
use UnifySchool\Repositories\School\ScopedSessionTypeRepository;
use UnifySchool\Repositories\SchoolRepository;
use UnifySchool\School;

/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 11:26 AM
 */

class CreateNewSchoolTest extends AppTestCase {


    /**
     * @var CreateNewSchool
     */
    protected $createNewSchoolCommand;
    protected $school_name;
    protected $country;
    protected $state;
    protected $city;
    protected $school_types;
    protected $school_type;


    protected $schoolRepository;
    protected $scopedSessionTypeRepository;
    protected $scopedSchoolTypeRepository;
    protected $scopedSchoolCategoriesRepository;
    protected $school;
    protected $session;
    protected $scopedSchoolType;

    public function setUp()
    {
        parent::setUp();

        //Artisan::call('migrate:refresh');
        //$this->seed();

        $this->school_name = "HelloSchool";
        $this->country = "1";
        $this->state = "1";
        $this->city = 'Aba';


        $this->school = Factory::build(School::class);
        $this->session = Factory::build(ScopedSessionType::class);
        $this->scopedSchoolType = Factory::build(ScopedSchoolType::class);

        $this->mockSchoolType();
        $this->setupMockSessionTypeRepository();
        $this->setupMockSchoolTypeRepository();
        $this->setupMockSchoolRepository();
        $this->setupMockSchoolCategoriesRepository();


        $this->createNewSchoolCommand = new CreateNewSchool(
            $this->school_name,
            $this->country,
            $this->state,
            $this->city,
            $this->school_type,
            $this->school_types
        );
    }

    public function testHandle(){
        $response = $this->createNewSchoolCommand->handle(
            $this->schoolRepository,
            $this->scopedSessionTypeRepository,
            $this->scopedSchoolTypeRepository,
            $this->scopedSchoolCategoriesRepository
        );

        print_r($response);

        $this->assertEquals($this->school->id,$response->id);
    }

    private function setupMockSchoolRepository()
    {


        $school = [];
        $school['city'] = $this->city;
        $school['state_id'] = $this->state;
        $school['country_id'] = $this->country;
        $school['name'] = $this->school_name;


        $this->schoolRepository =
            Mockery::mock(SchoolRepository::class);
        $this->schoolRepository
                ->shouldReceive('create')
                ->with($school)
                ->once()
                ->andReturn($this->school);

        $this->schoolRepository
            ->shouldReceive('setSchoolType')
            ->once()
            ->withArgs([$this->school,$this->scopedSchoolType]);
    }

    private function mockSchoolType()
    {
        $this->school_types = [
            [
                'id' => 1,
                'name' => 'test',
                'display_name' => 'test',
                'session_type' => [
                    'session_type' => 'one',
                    'session_display_name' => 'Session',
                    'session_divisions_display_name' => 'Term',
                ],
                'school_categories' => [
                    [
                        'name' => 'cat_1',
                        'display_name' => 'cat 1'
                    ]
                ]
            ]
        ];

        $this->school_type = 1;
    }

    private function setupMockSchoolCategoriesRepository()
    {
        $cat['name'] = $this->school_types[0]['school_categories'][0]['name'];
        $cat['display_name'] = $this->school_types[0]['school_categories'][0]['display_name'];
        $cat['scoped_school_type_id'] = $this->scopedSchoolType->id;
        $cat['school_id'] = $this->school->id;


        $this->scopedSchoolCategoriesRepository =
            Mockery::mock(ScopedSchoolCategoriesRepository::class);
        $this->scopedSchoolCategoriesRepository
                ->shouldReceive('create')
                ->with($cat)
                ->once();

    }

    private function setupMockSessionTypeRepository()
    {

        $sessionData = [];

        $sessionData['school_id'] = $this->school->id;
        $sessionData['session_divisions_name'] = 'sub_session';
        $sessionData['session_name'] = 'session';
        $sessionData['session_type'] = $this->school_types[0]['session_type']['session_type'];
        $sessionData['session_display_name'] = $this->school_types[0]['session_type']['session_display_name'];
        $sessionData['session_divisions_display_name'] = $this->school_types[0]['session_type']['session_divisions_display_name'];

        $this->scopedSessionTypeRepository =
            Mockery::mock(ScopedSessionTypeRepository::class);
        $this->scopedSessionTypeRepository
                ->shouldReceive('create')
                ->with($sessionData)
                ->once()
                ->andReturn($this->session);
    }

    private function setupMockSchoolTypeRepository()
    {

        $cat = [];
        $cat['name'] = $this->school_types[0]['name'];
        $cat['display_name'] = $this->school_types[0]['display_name'];
        $cat['scoped_session_type_id'] = $this->session->id;
        $cat['school_id'] = $this->school->id;

        $this->scopedSchoolTypeRepository =
            Mockery::mock(ScopedSchoolTypeRepository::class);
        $this->scopedSchoolTypeRepository
                ->shouldReceive('create')
                ->with($cat)
                ->once()
                ->andReturn($this->scopedSchoolType);
    }

}
