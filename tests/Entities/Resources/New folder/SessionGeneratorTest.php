<?php
use UnifySchool\Entities\Resources\NonTertiary\SessionGenerator;

/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 9:07 AM
 */

class SessionGeneratorTest extends AppTestCase {

    /**
     * @var SessionGenerator
     */
    protected $generator;

    public function setUp()
    {
        parent::setUp();
        $this->generator = new SessionGenerator();
    }


    public function testGenerateCurrentSession(){
        $expected = "2014/2015";
        $actual = $this->generator->generateCurrentSession();

        $this->assertEquals($expected,$actual,"The generated Current Session should be equal");
    }

    public function testGeneratePastSession(){
        $expected = "2013/2014";
        $actual = $this->generator->generatePastSession();

        $expected_2 = ["2013/2014","2012/2013"];
        $actual_2 = $this->generator->generatePastSession(2);

        $this->assertEquals($expected,$actual,"The generated Past Session should be equal");
        $this->assertEquals($expected_2,$actual_2,"The generated Past Session should be equal");
    }

    public function testGenerateFutureSession(){
        $expected = "2015/2016";
        $actual = $this->generator->generateFutureSession();

        $expected_2 = ["2015/2016","2016/2017"];
        $actual_2 = $this->generator->generateFutureSession(2);

        $this->assertEquals($expected,$actual,"The generated Past Session should be equal");
        $this->assertEquals($expected_2,$actual_2,"The generated Past Session should be equal");
    }

}
