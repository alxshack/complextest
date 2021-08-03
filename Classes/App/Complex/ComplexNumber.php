<?php

/**
 * класс комплексного числа
 * @author Aleksey N. Tikhomirov
 */

namespace App\Complex;


class ComplexNumber
{

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
    public function setValue($params): ComplexNumber
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
    public function setReal(float $real): ComplexNumber
    {
        $this->real = $real;
        return $this;
    }

    /**
     * @param float $imaginary
     * @return $this
     */
    public function setImaginary(float $imaginary): ComplexNumber
    {
        $this->imaginary = $imaginary;
        return $this;
    }

    /**
     * @return float
     */
    public function getReal(): float
    {
        return $this->real;
    }

    /**
     * @return float
     */
    public function getImaginary(): float
    {
        return $this->imaginary;
    }

    /**
     * Устанавливается статус деления на ноль
     */
    public function setIsDividedByZero(): ComplexNumber
    {
        $this->isDividedByZero = true;
        return $this;
    }

    /**
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
}