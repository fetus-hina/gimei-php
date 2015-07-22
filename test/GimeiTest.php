<?php
namespace jp3cki\gimei\test;

use jp3cki\gimei\Gimei;
use jp3cki\gimei\name\Person;

class GimeiTest extends TestCase
{
    public function testGenerateNameReturnsAPerson()
    {
        $this->assertInstanceOf('jp3cki\gimei\name\Person', Gimei::generateName());
    }

    public function testGenerateNameReturnsBothGender()
    {
        $count = 20;
        $male = $female = 0;
        foreach (range(1, $count) as $i) {
            $ret = Gimei::generateName();
            if ($ret->isMale()) {
                ++$male;
            } elseif ($ret->isFemale()) {
                ++$female;
            }
        }
        $this->assertGreaterThan(0, $male);
        $this->assertGreaterThan(0, $female);
        $this->assertEquals($count, $male + $female);
    }

    public function testGenerateMaleReturnsAPerson()
    {
        $this->assertInstanceOf('jp3cki\gimei\name\Person', Gimei::generateMale());
    }

    public function testGenerateMaleReturnsMale()
    {
        $person = Gimei::generateMale();
        $this->assertTrue($person->isMale());
        $this->assertFalse($person->isFemale());
    }

    public function testGenerateFemaleReturnsAPerson()
    {
        $this->assertInstanceOf('jp3cki\gimei\name\Person', Gimei::generateFemale());
    }

    public function testGenerateFemaleReturnsFemale()
    {
        $person = Gimei::generateFemale();
        $this->assertTrue($person->isFemale());
        $this->assertFalse($person->isMale());
    }

    public function testGenderNameWithUnbalancedMaleRate()
    {
        $count = 50;
        $male = $female = 0;
        foreach (range(1, $count) as $i) {
            $ret = Gimei::generateName(0.75);
            if ($ret->isMale()) {
                ++$male;
            } elseif ($ret->isFemale()) {
                ++$female;
            }
        }
        $this->assertGreaterThan(0, $male);
        $this->assertGreaterThan(0, $female);
        $this->assertEquals($count, $male + $female);
        $this->assertGreaterThan($female, $male);
    }

    public function testGenerateAddressReturnsAnAddress()
    {
        $address = Gimei::generateAddress();
        $this->assertInstanceOf('jp3cki\gimei\address\Address', $address);
    }
}
