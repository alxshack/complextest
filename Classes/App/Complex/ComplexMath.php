<?php

/**
 * класс математических операций с комплексными числами
 * @author Aleksey N. Tikhomirov
 */

namespace App\Complex;

use App\Complex\ComplexNumberInterface;

class ComplexMath
{

    /**
     * сложение комплексных чисел
     * @param ComplexNumberInterface $x
     * @param ComplexNumberInterface $y
     * @return ComplexNumberInterface
     */
    public static function add(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        $newReal = $x->getReal() + $y->getReal();
        $newImaginary = $x->getImaginary() + $y->getImaginary();
        return new static();

        return (new ComplexNumberInterface())
            ->setReal($newReal)
            ->setImaginary($newImaginary);
    }

    /**
     * приведение к отрицательному значению
     * @param ComplexNumberInterface $x
     * @return ComplexNumberInterface
     */
    public static function inverse(ComplexNumberInterface $x): ComplexNumberInterface
    {
        return (new ComplexNumberInterface())
            ->setReal(-$x->getReal())
            ->setImaginary(-$x->getImaginary());
    }

    /**
     * вычитание комплексных чисел
     * @param ComplexNumberInterface $x
     * @param ComplexNumberInterface $y
     * @return ComplexNumberInterface
     */
    public static function substract(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        return self::add($x, self::inverse($y));
    }

    public static function multiply(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        $newReal = $x->getReal() * $y->getReal() - $x->getImaginary() * $y->getImaginary();
        $newImaginary = $x->getReal() * $y->getImaginary() + $x->getImaginary() * $y->getReal();
        return (new ComplexNumberInterface())
            ->setReal($newReal)
            ->setImaginary($newImaginary);
    }

    public static function divide(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        $divider = $y->getReal() ** 2 + $y->getImaginary() ** 2;

        if ($divider === 0) {
            return (new ComplexNumberInterface())
                ->setValue(0)
                ->setIsDividedByZero();
        }

        $newReal = ($x->getReal() * $y->getReal() + $x->getImaginary() * $y->getImaginary()) / $divider;
        $newImaginary = ($x->getImaginary() * $y->getReal() - $x->getReal() * $y->getImaginary()) / $divider;
        return (new ComplexNumberInterface())
            ->setReal($newReal)
            ->setImaginary($newImaginary);
    }

}