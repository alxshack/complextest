<?php

namespace App\Complex;

interface ComplexNumberInterface
{
    public function __toString(): string;

    /**
     * возвращает реальную часть комплексного числа в алгебраическом формате
     * @return float
     */
    public function getReal(): float;

    /**
     * возвращает мнимую часть комплексного числа в алгебраическом формате
     * @return float
     */
    public function getImaginary(): float;

    /**
     * возвращает угол комплексного числа в тригонометрическом формате
     * @return float
     */
    public function getAngle(): float;

    /**
     * возвращает величину комплексного числа в тригонометрическом формате
     * @return float
     */
    public function getMagnitude(): float;

    public function toPrinted(): string;

    /**
     * возвращает тип комплексного числа
     * @return string
     */
    public function getType(): string;

    public function add(ComplexNumberInterface $b): ComplexNumberInterface;

    public function inverse(): ComplexNumberInterface;

}