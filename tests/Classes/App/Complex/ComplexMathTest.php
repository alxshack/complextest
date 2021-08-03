<?php

namespace App\Complex;

use PHPUnit\Framework\TestCase;

class ComplexMathTest extends TestCase
{

    private ComplexNumber $numberA;
    private ComplexNumber $numberB;

    protected function setUp(): void
    {
        $this->numberA = new ComplexNumber('1+1i');
        $this->numberB = new ComplexNumber('-2-2i');
    }

    public function testAdd()
    {
        // используем значения, выставленные в setUp
        $this->assertEquals('-1-1i', ComplexMath::add($this->numberA, $this->numberB));

        // применяем другие значения
        $this->numberA->setValue(['r'=>-5, 'i'=>5]);
        $this->numberB->setValue(['r' => 10, 'i' => -10]);
        $this->assertEquals('5-5i', ComplexMath::add($this->numberA, $this->numberB));

        // применяем другие значения
        $this->numberA->setValue([0, 5]);
        $this->numberB->setValue([5, 0]);
        $this->assertEquals('5+5i', ComplexMath::add($this->numberA, $this->numberB));
    }

    public function testSubstract()
    {
        // используем значения, выставленные в setUp
        $this->assertEquals('3+3i', ComplexMath::substract($this->numberA, $this->numberB));

        // применяем другие значения
        $this->numberA->setValue(['r'=>-5, 'i'=>5]);
        $this->numberB->setValue(['r' => 10, 'i' => -10]);
        $this->assertEquals('-15+15i', ComplexMath::substract($this->numberA, $this->numberB));

        // применяем другие значения
        $this->numberA->setValue([0, 5]);
        $this->numberB->setValue([5, 0]);
        $this->assertEquals('-5+5i', ComplexMath::substract($this->numberA, $this->numberB));
    }

    public function testMultiply()
    {
        // используем значения, выставленные в setUp
        $this->assertEquals('0-4i', ComplexMath::multiply($this->numberA, $this->numberB));

        // применяем другие значения
        $this->numberA->setValue(['r'=>-5, 'i'=>5]);
        $this->numberB->setValue(['r' => 10, 'i' => -10]);
        $this->assertEquals('0+100i', ComplexMath::multiply($this->numberA, $this->numberB));

        // применяем другие значения
        $this->numberA->setValue([0, 5]);
        $this->numberB->setValue([5, 0]);
        $this->assertEquals('0+25i', ComplexMath::multiply($this->numberA, $this->numberB));
    }

    public function testInverse()
    {
        // используем значения, выставленные в setUp
        $this->assertEquals('-1-1i', ComplexMath::inverse($this->numberA));
    }

    public function testDivide()
    {
        $this->assertEquals(-0.5, ComplexMath::divide($this->numberA, $this->numberB)->getReal());
        $this->assertEquals(0, ComplexMath::divide($this->numberA, $this->numberB)->getImaginary());

        $this->numberA->setValue(['r'=>-5, 'i'=>5]);
        $this->numberB->setValue(['r' => 10, 'i' => -10]);
        $this->assertEquals('-0.5+0i', ComplexMath::divide($this->numberA, $this->numberB));
    }

}
