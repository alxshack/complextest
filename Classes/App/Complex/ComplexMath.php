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
     * @deprecated используй нестатический метод у слагаемого: $x->add($y), сохранено для совместимости
     * @param ComplexNumberInterface $x
     * @param ComplexNumberInterface $y
     * @return ComplexNumberInterface
     */
    public static function add(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        return $x->add($y);
    }

    /**
     * приведение к отрицательному значению
     * @deprecated используй нестатический метод $x->inverse(), сохранено для совместимости
     * @param ComplexNumberInterface $x
     * @return ComplexNumberInterface
     */
    public static function inverse(ComplexNumberInterface $x): ComplexNumberInterface
    {
        return $x->inverse();
    }

    /**
     * вычитание комплексных чисел
     * @deprecated используй нестатический метод $x->subtract(), сохранено для совместимости
     * @param ComplexNumberInterface $x
     * @param ComplexNumberInterface $y
     * @return ComplexNumberInterface
     */
    public static function subtract(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        return $x->subtract($y);
    }

    /**
     * умножение комплексных чисел
     * @deprecated используй нестатический метод $x->multiply(), сохранено для совместимости
     * @param \App\Complex\ComplexNumberInterface $x
     * @param \App\Complex\ComplexNumberInterface $y
     * @return \App\Complex\ComplexNumberInterface
     */
    public static function multiply(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        return $x->multiply($y);
    }

    /**
     * деление комплексных чисел
     * @deprecated используй нестатический метод $x->divide(), сохранено для совместимости
     * @param \App\Complex\ComplexNumberInterface $x
     * @param \App\Complex\ComplexNumberInterface $y
     * @return \App\Complex\ComplexNumberInterface
     */
    public static function divide(ComplexNumberInterface $x, ComplexNumberInterface $y): ComplexNumberInterface
    {
        return $x->divide($y);
    }

}