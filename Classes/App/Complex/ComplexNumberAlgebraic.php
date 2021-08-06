<?php

/**
 * класс комплексного числа
 * @author Aleksey N. Tikhomirov
 */

namespace App\Complex;


class ComplexNumberAlgebraic implements ComplexNumberInterface
{

    const TYPE = 'algebraic';

    private float $real;
    private float $imaginary;
    private bool $isDividedByZero = false;

    public function __construct($params = '')
    {
        $this->setValue($params);
    }

    /**
     * установка значения комплексного числа
     * задаётся массивом ['r' => R, 'i' => I], например ['r' => 3.14, 'i' => 5.2]
     * либо строкой формата "R±Ii", например "3.14+5.2i"
     * @param mixed $params
     * @return $this
     */
    public function setValue($params): ComplexNumberInterface
    {
        try {
            switch (gettype($params)) {
                case 'integer':
                case 'float':
                case 'double':
                    $this->real = $params;
                    $this->imaginary = 0;
                    break;

                case 'array':
                    $params = $params ?: ['r' => 0, 'i' => 0];
                    if (!array_key_exists('r', $params)) {
                        $params['r'] = $params[0] ?: 0;
                    }
                    if (!array_key_exists('i', $params)) {
                        $params['i'] = $params[1] ?: 0;
                    }
                    $this->real = $params['r'];
                    $this->imaginary = $params['i'];
                    break;

                case 'string':
                    if ($params === '') {
                        $this->real = 0;
                        $this->imaginary = 0;
                    } else {
                        $this->parseComplex($params);
                    }
                    break;

                default:
                    $this->real = 0;
                    $this->imaginary = 0;

            }
        } catch (\Throwable $exception) {
            echo $exception;
        }

        return $this;

    }

    public function __toString(): string
    {
        return $this->toPrinted();
    }

    /**
     * @param float $real
     * @return $this
     */
    public function setReal(float $real): ComplexNumberInterface
    {
        $this->real = $real;
        return $this;
    }

    /**
     * @param float $imaginary
     * @return $this
     */
    public function setImaginary(float $imaginary): ComplexNumberInterface
    {
        $this->imaginary = $imaginary;
        return $this;
    }

    public function getReal(): float
    {
        return $this->real;
    }

    public function getImaginary(): float
    {
        return $this->imaginary;
    }

    public function getAngle(): float
    {
        return atan2($this->imaginary, $this->real);
    }

    public function getMagnitude(): float
    {
        return sqrt(($this->real ** 2) + ($this->imaginary ** 2));
    }

    /**
     * Устанавливается статус деления на ноль
     */
    public function setIsDividedByZero(): ComplexNumberInterface
    {
        $this->isDividedByZero = true;
        return $this;
    }

    /**
     * вывод в человеко-читаемом формате
     * @param bool $isTrigonometric вывод в тригонометрическом представлении
     * @return string
     */
    public function toPrinted(): string
    {
        if ($this->isDividedByZero) {
            return '[divide_by_zero]';
        }

        $separator = ($this->imaginary >= 0) ? '+' : '';
        return $this->real . $separator . $this->imaginary . 'i';
    }

    private function parseComplex($param)
    {
        if (preg_match('/^([-+]?\d+\.?\d*?)([-+]\d+\.?\d*?)i$/i', $param, $parsed)) {
            $this->real = $parsed[1];
            $this->imaginary = $parsed[2];
        } else {
            throw new \Exception('Неверный строковый формат описания комплексного числа');
        }
    }

    public function toAlgebraic(): ComplexNumberInterface
    {
        return $this;
    }

    public function toTrigonometric(): ComplexNumberInterface
    {
        return new ComplexNumberTrigonometric(
            [
                'm' => $this->getMagnitude(),
                'a' => $this->getAngle()
            ]
        );
    }

    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * сложение комплексных чисел
     * @param ComplexNumberInterface $b
     * @return ComplexNumberInterface
     */
    public function add(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberAlgebraic $valB */
        $valB = $b->toAlgebraic();
        return new ComplexNumberAlgebraic(
            [
                'r' => $this->real + $valB->getReal(),
                'i' => $this->imaginary + $valB->getImaginary()
            ]
        );
    }

    /**
     * приведение к отрицательному значению
     * @param ComplexNumberInterface $x
     * @return ComplexNumberInterface
     */
    public function inverse(): ComplexNumberAlgebraic
    {
        return new ComplexNumberAlgebraic(
            [
                'r' => -$this->real,
                'i' => -$this->imaginary
            ]
        );
    }

    /**
     * вычитание комплексных чисел
     * @param ComplexNumberInterface $b
     * @return ComplexNumberInterface
     */
    public function subtract(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberAlgebraic $valB */
        $valB = $b->toAlgebraic();
        return $this->add($valB->inverse());
    }

    public function multiply(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberAlgebraic $valB */
        $valB = $b->toAlgebraic();
        return new ComplexNumberAlgebraic(
            [
                'r' => ($this->real * $valB->real) - ($this->imaginary * $valB->getImaginary()),
                'i' => ($this->real * $valB->getImaginary()) + ($valB->getReal() * $this->imaginary)
            ]
        );
    }

    public function divide(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberAlgebraic $valB */
        $valB = $b->toAlgebraic();

        $divider = $valB->getReal() ** 2 + $valB->getImaginary() ** 2;

        if ($divider == 0) {
            $this->setIsDividedByZero();
            $newReal = 0;
            $newImaginary = 0;
        } else {
            $newReal = ($this->real * $valB->getReal() + $this->imaginary * $valB->getImaginary()) / $divider;
            $newImaginary = ($this->imaginary * $valB->getReal() - $this->real * $valB->getImaginary()) / $divider;;
        }

        return new ComplexNumberAlgebraic(
            [
                'r' => $newReal,
                'i' => $newImaginary
            ]
        );
    }

}