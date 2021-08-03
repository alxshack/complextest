<?php

namespace App\Complex;

use PHPUnit\Framework\TestCase;

class ComplexNumberTest extends TestCase
{

    private ComplexNumber $number;

    protected function setUp(): void
    {
        $this->number = new ComplexNumber();
    }


    public function testSetReal()
    {
        $this->number->setReal(10);
        $this->assertEquals('10+0i', $this->number);

        $this->number->setReal(-10);
        $this->assertEquals('-10+0i', $this->number);

        $this->number->setReal(0);
        $this->assertEquals('0+0i', $this->number);
    }

    public function testSetValue()
    {
        $this->number->setValue(0);
        $this->assertEquals('0+0i', $this->number);

        $this->number->setValue([10, -10]);
        $this->assertEquals('10-10i', $this->number);

        $this->number->setValue([-10, 10]);
        $this->assertEquals('-10+10i', $this->number);

        $this->number->setValue(['r' => -5, 'i' => +5]);
        $this->assertEquals('-5+5i', $this->number);

        $this->number->setValue(['i' => -5, 'r' => +5]);
        $this->assertEquals('5-5i', $this->number);

        $this->number->setValue('99.5-98.25i');
        $this->assertEquals(99.5, $this->number->getReal());
        $this->assertEquals(-98.25, $this->number->getImaginary());

        $this->number->setValue('-3.141592654+2.71828i');
        $this->assertEquals(-3.141592654, $this->number->getReal());
        $this->assertEquals(2.71828, $this->number->getImaginary());

        $this->assertNotEquals(666, $this->number->getReal());
        $this->assertGreaterThan(0.3333, $this->number->getImaginary());

    }

    public function testSetImaginary()
    {
        $this->number->setImaginary(10);
        $this->assertEquals('0+10i', $this->number);

        $this->number->setImaginary(-10);
        $this->assertEquals('0-10i', $this->number);

        $this->number->setImaginary(0);
        $this->assertEquals('0+0i', $this->number);
    }
}
