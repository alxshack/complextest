<?php

namespace App\Complex;

interface ComplexNumberInterface
{
    public function setValue($params): ComplexNumberInterface;

    public function __toString(): string;

    public function setReal(float $real): ComplexNumberInterface;

    public function setImaginary(float $imaginary): ComplexNumberInterface;

    public function getReal(): float;

    public function getImaginary(): float;

    public function setAngle(float $real): ComplexNumberInterface;

    public function setMagnitude(): ComplexNumberInterface;

    public function getAngle(): float;

    public function getMagnitude(): float;

    public function toPrinted(): string;

}