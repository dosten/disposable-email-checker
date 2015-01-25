<?php

namespace DisposableEmailChecker\Tests;

use DisposableEmailChecker\Checker;
use DisposableEmailChecker\Provider\ChainProvider;
use DisposableEmailChecker\Provider\InMemoryProvider;

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validResults
     */
    public function testCheckWithDefaultProvider($email, $expected)
    {
        $checker = new Checker();

        $this->assertEquals($expected, $checker->check($email));
    }

    /**
     * @dataProvider validResults
     */
    public function testCheckWithChainProvider($email, $expected)
    {
        $provider = new ChainProvider(array(
            new InMemoryProvider()
        ));

        $checker = new Checker($provider);

        $this->assertEquals($expected, $checker->check($email));
    }

    public function testCheckWithInMemoryProviderAndCustomDomain()
    {
        $provider = new InMemoryProvider();
        $provider->addDomain('mycompany.com');

        $checker = new Checker($provider);

        $this->assertTrue($checker->check('johndoe@mycompany.com'));
    }

    public function validResults()
    {
        return array(
            array('johndoe@mailinator.com', true),
            array('johndoe@gmail.com', false),
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
        $checker = new Checker();
        $checker->check('invalid email');
    }
}
