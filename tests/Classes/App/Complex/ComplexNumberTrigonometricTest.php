<?php

namespace App\Complex;

use PHPUnit\Framework\TestCase;

class ComplexNumberTrigonometricTest extends TestCase
{

    private $number;

    protected function setUp(): void
    {
        $this->number = new ComplexNumberTrigonometric(
            [
                'm' => 10,
                'a' => 30
            ]
        );
    }

    public function testGetAngle()
    {
        $this->assertEquals(30, $this->number->getAngle());

        $this->number->setAngle(45);
        $this->assertEquals(45, $this->number->getAngle());
    }

    public function testToPrinted()
    {
        $this->assertEquals('|10|(cos(30)+isin(30))', $this->number->toPrinted());

        $this->number->setAngle(45);
        $this->number->setMagnitude(-5);
        $this->assertEquals('|-5|(cos(45)+isin(45))', $this->number->toPrinted());
    }

    public function testGetReal()
    {
        $this->assertLessThan(2, $this->number->getReal());
        $this->assertGreaterThan(1, $this->number->getReal());
    }

    public function testSetMagnitude()
    {
        $this->number->setMagnitude(56);
        $this->assertEquals(56, $this->number->getMagnitude());
    }

    public function testSetAngle()
    {
        $this->number->setAngle(3.14);
        $this->assertEquals(3.14, $this->number->getAngle());
    }

    public function testGetType()
    {
        $this->assertEquals('trigonometric', $this->number->getType());
        $this->assertEquals('algebraic', $this->number->toAlgebraic()->getType());

    }
}
