<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:52 PM
 */


$factory(
    \UnifySchool\School::class,[
        'slug' => '',
        'name' => $faker->name,
        'city' => $faker->city,
        'state_id' => $faker->randomDigit,
        'country_id' => $faker->randomDigit,
        'id' => $faker->randomDigit,
    ]
);



$factory(
    \UnifySchool\Entities\School\ScopedSessionType::class, [
        'id' => $faker->randomDigit
    ]
);

$factory(
    \UnifySchool\Entities\School\ScopedSchoolType::class, [
        'id' => $faker->randomDigit
    ]
);