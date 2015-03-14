<?php namespace UnifySchool\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use UnifySchool\School;

class CreateNewSchool extends Command implements SelfHandling
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $country;
    /**
     * @var
     */
    private $state;
    /**
     * @var
     */
    private $city;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($name, $country, $state, $city)
    {
        //
        $this->name = $name;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
    }

    /**
     * Execute the command.
     *
     * @param School $school
     * @return School|static
     * @throws \Exception
     */
    public function handle(School $school)
    {
        $school = $school->create([
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'name' => $this->name
        ]);

        if (is_null($school))
            throw new \Exception('Could not create school');

        //raise new school event

        return $school;
    }

}
