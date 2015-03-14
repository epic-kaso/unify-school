<?php
use Illuminate\Database\Seeder;
use UnifySchool\Country;
use UnifySchool\SchoolCategory;
use UnifySchool\SchoolCategoryArm;
use UnifySchool\SchoolCategoryArmSubdivision;
use UnifySchool\SchoolType;
use UnifySchool\SessionType;
use UnifySchool\State;

/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 2/21/2015
 * Time: 11:21 PM
 */
class SchoolSystemTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('session_types')->truncate();
        DB::table('school_types')->truncate();
        DB::table('school_categories')->truncate();
        DB::table('school_category_arms')->truncate();
        DB::table('school_category_arm_subdivisions')->truncate();

        DB::transaction(function () {
            $this->createCountries();
            $this->createSessionTypes();
        });

    }

    private function createCountries()
    {
        $countries = [
            "ng" => [
                "name" => "Nigeria",
                "short_code" => "ng",
                "states" => [
                    "ab" => [
                        "name" => "Abia",
                        "short_code" => "ab"
                    ],
                    "an" => [
                        "name" => "Anambra",
                        "short_code" => "an"
                    ]
                ]
            ]
        ];

        foreach ($countries as $country) {
            $this->createCountry($country['name'], $country['short_code'], $country['states']);
        }
    }

    private function createCountry($name, $shortCode, array $states)
    {
        $item = new Country();
        $item->name = $name;
        $item->short_code = $shortCode;
        $item->save();

        foreach ($states as $state) {
            $this->createState($item, $state['name'], $state['short_code']);
        }

        return $item;
    }

    private function createState(Country $country, $name, $shortCode)
    {
        $item = new State();
        $item->name = $name;
        $item->short_code = $shortCode;
        $item->country()->associate($country);
        $item->save();
    }

    private function createSessionTypes()
    {
        /*
        * CREATE SESSIONS FIRST
        */

        $session_types = [];

        $data = [
            'one' => [
                "session_type" => "two",
                "session_name" => "session",
                "session_display_name" => "Session",
                "session_divisions_name" => "sub_session",
                "session_divisions_display_name" => "Semester"
            ],
            'two' => [
                "session_type" => "three",
                "session_name" => "session",
                "session_display_name" => "Session",
                "session_divisions_name" => "sub_session",
                "session_divisions_display_name" => "Term"
            ],
            'three' => [
                "session_type" => "one",
                "session_name" => "session",
                "session_display_name" => "Session",
                "session_divisions_name" => "sub_session",
                "session_divisions_display_name" => "Academic Year"
            ],
        ];

        foreach ($data as $key => $value) {
            $item = $this->createSessionType($value);
            $session_types[$item->session_type] = $item;
        }

        $this->createSchoolTypes($session_types['two'], $session_types['three'], $session_types['one']);

        return $session_types;
    }

    private function createSessionType(array $value)
    {
        $item = new SessionType();
        $item->session_type = $value['session_type'];
        $item->session_name = $value['session_name'];
        $item->session_display_name = $value['session_display_name'];
        $item->session_divisions_name = $value['session_divisions_name'];
        $item->session_divisions_display_name = $value['session_divisions_display_name'];
        $item->save();

        return $item;
    }

    private function createSchoolTypes(
        SessionType $tertiarySession,
        SessionType $nonTertiarySession,
        SessionType $customSession)
    {
        //CREATE SCHOOL TYPES

        $schoolTypes = [];

        $data = [
            [
                "name" => "tertiary",
                "display_name" => "Tertiary (Universities, Poly etc)",
                "session_type" => $tertiarySession
            ],
            [
                "name" => "non_tertiary",
                "display_name" => "Non Tertiary (Nursery, Primary etc )",
                "session_type" => $nonTertiarySession
            ],
            [
                "name" => "custom",
                "display_name" => "Other Schools (Business School, etc)",
                "session_type" => $customSession
            ]
        ];

        foreach ($data as $value) {
            $item = $this->createSchoolType($value);
            $schoolTypes[$item->name] = $item;

        }

        $this->createSchoolCategories(
            $schoolTypes[$data[0]['name']],
            $schoolTypes[$data[1]['name']],
            $schoolTypes[$data[2]['name']]
        );

        return $schoolTypes;
    }

    private function createSchoolType(array $value)
    {
        $item = new SchoolType();
        $item->name = $value['name'];
        $item->display_name = $value['display_name'];
        $item->session_type()->associate($value['session_type']);
        $item->save();
        return $item;
    }

    private function createSchoolCategories(
        SchoolType $tertiarySchoolType,
        SchoolType $nonTertiarySchoolType,
        SchoolType $customSchoolType)
    {
        //CREATE SCHOOL CATEGORIES

        $response = [];

        $tertiary = [
            [
                "name" => "arts",
                "display_name" => "Arts",
                "school_type" => $tertiarySchoolType,
                'arms' => [
                    [
                        "name" => "history",
                        "display_name" => "History",
                        "sub_divisions" => [[
                            "name" => "history",
                            "display_name" => "History"
                        ]]
                    ],
                    [
                        "name" => "theatre_arts",
                        "display_name" => "Theatre Arts",
                        "sub_divisions" => [[
                            "name" => "theatre_arts",
                            "display_name" => "Theatre Arts"
                        ]]
                    ]
                ]
            ],
            [
                "name" => "physical_sciences",
                "display_name" => "Physical Sciences",
                "school_type" => $tertiarySchoolType,
                'arms' => [
                    [
                        "name" => "computer_science",
                        "display_name" => "Computer Science",
                        "sub_divisions" => [[
                            "name" => "computer_science",
                            "display_name" => "Computer Science"
                        ]]
                    ],
                    [
                        "name" => "bio_chemistry",
                        "display_name" => "Bio Chemistry",
                        "sub_divisions" => [[
                            "name" => "bio_chemistry",
                            "display_name" => "Bio Chemistry"
                        ]]
                    ]
                ]
            ],
            [
                "name" => "engineering",
                "display_name" => "Engineering",
                "school_type" => $tertiarySchoolType,
                'arms' => [
                    [
                        "name" => "electrical",
                        "display_name" => "Electrical",
                        "sub_divisions" => [[
                            "name" => "electrical",
                            "display_name" => "Electrical"
                        ]]
                    ],
                    [
                        "name" => "chemical",
                        "display_name" => "Chemical",
                        "sub_divisions" => [[
                            "name" => "chemical",
                            "display_name" => "Chemical"
                        ]]
                    ]
                ]
            ]
        ];


        $non_tertiary = [
            [
                "name" => "nursery",
                "display_name" => "Nursery",
                "school_type" => $nonTertiarySchoolType,
                'arms' => [
                    [
                        "name" => "pre_nursery",
                        "display_name" => "Pre Nursery",
                        "sub_divisions" => [[
                            "name" => "pre_nursery",
                            "display_name" => "Pre Nursery"]
                        ]
                    ],
                    [
                        "name" => "nursery_1",
                        "display_name" => "Nursery 1",
                        "sub_divisions" => [[
                            "name" => "nursery_1",
                            "display_name" => "nursery_1"]
                        ]
                    ],
                    [
                        "name" => "nursery_2",
                        "display_name" => "Nursery 2",
                        "sub_divisions" => [[
                            "name" => "nursery_2",
                            "display_name" => "Nursery 2"]
                        ]
                    ],
                    [
                        "name" => "nursery_3",
                        "display_name" => "Nursery 3",
                        "sub_divisions" => [[
                            "name" => "nursery_3",
                            "display_name" => "Nursery 3"]
                        ]
                    ]
                ]
            ],
            [
                "name" => "primary",
                "display_name" => "Primary",
                "school_type" => $nonTertiarySchoolType,
                'arms' => [
                    [
                        "name" => "primary_1",
                        "display_name" => "Primary 1",
                        "sub_divisions" => [[
                            "name" => "primary_1",
                            "display_name" => "Primary 1"]
                        ]
                    ],
                    [
                        "name" => "primary_2",
                        "display_name" => "Primary 2",
                        "sub_divisions" => [[
                            "name" => "primary_2",
                            "display_name" => "Primary 2"]
                        ]
                    ],
                    [
                        "name" => "primary_3",
                        "display_name" => "Primary 3",
                        "sub_divisions" => [[
                            "name" => "primary_3",
                            "display_name" => "Primary 3"]
                        ]
                    ],
                    [
                        "name" => "primary_4",
                        "display_name" => "Primary 4",
                        "sub_divisions" => [[
                            "name" => "primary_4",
                            "display_name" => "Primary 4"]
                        ]
                    ],
                    [
                        "name" => "primary_5",
                        "display_name" => "Primary 5",
                        "sub_divisions" => [[
                            "name" => "primary_5",
                            "display_name" => "Primary 5"]
                        ]
                    ],
                    [
                        "name" => "primary_6",
                        "display_name" => "Primary 6",
                        "sub_divisions" => [[
                            "name" => "primary_6",
                            "display_name" => "Primary 6"]
                        ]
                    ]
                ]
            ],
            [
                "name" => "junior_secondary",
                "display_name" => "Junior Secondary",
                "school_type" => $nonTertiarySchoolType,
                'arms' => [
                    [
                        "name" => "jss_1",
                        "display_name" => "JSS 1",
                        "sub_divisions" => [[
                            "name" => "jss_1",
                            "display_name" => "JSS 1"]
                        ]
                    ],
                    [
                        "name" => "jss_2",
                        "display_name" => "JSS 2",
                        "sub_divisions" => [[
                            "name" => "jss_2",
                            "display_name" => "JSS 2"]
                        ]
                    ],
                    [
                        "name" => "jss_3",
                        "display_name" => "JSS 3",
                        "sub_divisions" => [[
                            "name" => "jss_3",
                            "display_name" => "JSS 3"]
                        ]
                    ]
                ]
            ],
            [
                "name" => "senior_secondary",
                "display_name" => "Senior Secondary",
                "school_type" => $nonTertiarySchoolType,
                'arms' => [
                    [
                        "name" => "ss_1",
                        "display_name" => "SS 1",
                        "sub_divisions" => [[
                            "name" => "ss_1",
                            "display_name" => "SS 1"]
                        ]
                    ],
                    [
                        "name" => "jss_2",
                        "display_name" => "SS 2",
                        "sub_divisions" => [
                            [
                                "name" => "ss_2",
                                "display_name" => "SS 2"
                            ]
                        ]
                    ],
                    [
                        "name" => "ss_3",
                        "display_name" => "SS 3",
                        "sub_divisions" => [
                            [
                                "name" => "ss_3",
                                "display_name" => "SS 3"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $custom = [
            [
                "name" => "default",
                "display_name" => "Default",
                "school_type" => $customSchoolType,
                'arms' => [
                    [
                        "name" => "default",
                        "display_name" => "default",
                        "sub_divisions" => [
                            [
                                "name" => "default",
                                "display_name" => "default"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($tertiary as $value) {
            $item = $this->createSchoolCategory($value);
            $response[$tertiarySchoolType->name][] = $item;
        }

        foreach ($non_tertiary as $value) {
            $item = $this->createSchoolCategory($value);
            $response[$nonTertiarySchoolType->name][] = $item;
        }

        foreach ($custom as $value) {
            $item = $this->createSchoolCategory($value);
            $response[$customSchoolType->name][] = $item;
        }

        return $response;
    }

    private function createSchoolCategory(array $value)
    {
        $item = new SchoolCategory();
        $item->name = $value['name'];
        $item->display_name = $value['display_name'];
        $item->school_type()->associate($value['school_type']);
        $item->save();

        $this->createSchoolCategoryArms($item, $value['arms']);

        return $item;
    }

    private function createSchoolCategoryArms(
        SchoolCategory $schoolCategory,
        array $arms
    )
    {
        //CREATE SCHOOL CATEGORY ARMS
        $response = [];
        foreach ($arms as $value) {
            $item = $this->createSchoolCategoryArm($value, $schoolCategory);
            $response[] = $item;
        }


        return $response;
    }

    private function createSchoolCategoryArm(
        array $value,
        SchoolCategory $schoolCategory)
    {
        $item = new SchoolCategoryArm();
        $item->name = $value['name'];
        $item->display_name = $value['display_name'];
        $item->school_category()->associate($schoolCategory);
        $item->save();

        if (isset($value['sub_divisions']))
            $this->createSchoolCategoryArmSubdivisions($item, $value['sub_divisions']);

        return $item;
    }

    private function createSchoolCategoryArmSubdivisions(
        SchoolCategoryArm $schoolCategoryArm,
        array $subdivisions)
    {
        //CREATE SCHOOL CATEGORY ARM SUBDIVISIONS

        $response = [];

        foreach ($subdivisions as $value) {
            $item = new SchoolCategoryArmSubdivision();
            $item->name = $value['name'];
            $item->display_name = $value['display_name'];
            $item->school_category_arm()->associate($schoolCategoryArm);
            $item->save();

            $response[] = $item;
        }

        return $response;
    }

}