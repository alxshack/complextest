<?php

/**
 * класс математических операций с комплексными числами
 * @author Aleksey N. Tikhomirov
 */

namespace App\Complex;

use App\Complex\ComplexNumber;

class ComplexMath
{

    /**
     * сложение комплексных чисел
     * @param ComplexNumber $x
     * @param ComplexNumber $y
     * @return ComplexNumber
     */
    public static function add(ComplexNumber $x, ComplexNumber $y): ComplexNumber
    {
        $newReal = $x->getReal() + $y->getReal();
        $newImaginary = $x->getImaginary() + $y->getImaginary();
        return (new ComplexNumber())
            ->setReal($newReal)
            ->setImaginary($newImaginary);
    }

    /**
     * приведение к отрицательному значению
     * @param ComplexNumber $x
     * @return ComplexNumber
     */
    public static function inverse(ComplexNumber $x): ComplexNumber
    {
        return (new ComplexNumber())
            ->setReal(-$x->getReal())
            ->setImaginary(-$x->getImaginary());
    }

    /**
     * вычитание комплексных чисел
     * @param ComplexNumber $x
     * @param ComplexNumber $y
     * @return ComplexNumber
     */
    public static function substract(ComplexNumber $x, ComplexNumber $y): ComplexNumber
    {
        return self::add($x, self::inverse($y));
    }

    public static function multiply(ComplexNumber $x, ComplexNumber $y): ComplexNumber
    {
        $newReal = $x->getReal() * $y->getReal() - $x->getImaginary() * $y->getImaginary();
        $newImaginary = $x->getReal() * $y->getImaginary() + $x->getImaginary() * $y->getReal();
        return (new ComplexNumber())
            ->setReal($newReal)
            ->setImaginary($newImaginary);
    }

    public static function divide(ComplexNumber $x, ComplexNumber $y): ComplexNumber
    {
        $divider = $y->getReal() ** 2 + $y->getImaginary() ** 2;

        if ($divider === 0) {
            return (new ComplexNumber())
                ->setValue(0)
                ->setIsDividedByZero();
        }

        $newReal = ($x->getReal() * $y->getReal() + $x->getImaginary() * $y->getImaginary()) / $divider;
        $newImaginary = ($x->getImaginary() * $y->getReal() - $x->getReal() * $y->getImaginary()) / $divider;
        return (new ComplexNumber())
            ->setReal($newReal)
            ->setImaginary($newImaginary);
    }

}