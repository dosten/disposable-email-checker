<?php

namespace DisposableEmailChecker\Tests;

use DisposableEmailChecker\Checker;

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    private $checker;

    protected function setUp()
    {
        $this->checker = new Checker();
    }

    /**
     * @dataProvider validResults
     */
    public function testCheck($email, $expected)
    {
        $this->assertEquals($expected, $this->checker->check($email));
    }

    public function validResults()
    {
        return array(
            array('johndoe@mailinator.com', true),
            array('john+doe@gmail.com', false),
            array('johndoe@courriel.fr.nf', true),
            array('johndoe@yahoo.com', false),
            array('johndoe@mycompany.com', false),
        );
    }

    /**
     * @dataProvider validStrictResults
     */
    public function testCheckStrict($email, $expected)
    {
        $this->assertEquals($expected, $this->checker->check($email, true));
    }

    public function validStrictResults()
    {
        return array(
            array('johndoe@mailinator.com', true),
            array('john+doe@gmail.com', true),
            array('johndoe@courriel.fr.nf', true),
            array('johndoe@yahoo.com', false),
            array('johndoe@mycompany.com', false),
        );
    }

    /**
     * @expectedException \DisposableEmailChecker\Exception\InvalidEmailException
     */
    public function testCheckWithInvalidEmail()
    {
        $this->checker->check('invalid email');
    }

    protected function tearDown()
    {
        $this->checker = null;
    }
}
