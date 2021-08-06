<?php

/**
 * класс комплексного числа
 * @author Aleksey N. Tikhomirov
 */

namespace App\Complex;


class ComplexNumberTrigonometric implements ComplexNumberInterface
{

    const TYPE = 'trigonometric';

    private float $angle;
    private float $magnitude;
    private bool $isDividedByZero = false;

    public function __construct($params = '')
    {
        $this->setValue($params);
    }

    /**
     * установка значения комплексного числа в тригонометрическом формате
     * задаётся массивом ['m' => Magnitude, 'a' => Angle], например ['m' => 10, 'a' => 3.1415]
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
                    $this->angle = 0;
                    $this->magnitude = $params;
                    break;

                case 'array':
                    $params = $params ?: ['a' => 0, 'm' => 0];
                    if (!array_key_exists('m', $params)) {
                        $params['m'] = $params[0] ?: 0;
                    }
                    if (!array_key_exists('a', $params)) {
                        $params['a'] = $params[1] ?: 0;
                    }
                    $this->magnitude = $params['m'];
                    $this->angle = $params['a'];
                    break;

                case 'string':
                    if ($params === '') {
                        $this->magnitude = 0;
                        $this->angle = 0;
                    } else {
                        /** @todo раскомментировать, когда будет готов парсер */
                        // $this->parseComplex($params);
                    }
                    break;

                default:
                    $this->magnitude = 0;
                    $this->angle = 0;

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

    public function setAngle(float $angle): ComplexNumberInterface
    {
        $this->angle = $angle;
        return $this;
    }

    public function setMagnitude(float $magnitude): ComplexNumberInterface
    {
        $this->magnitude = $magnitude;
        return $this;
    }

    public function getReal(): float
    {
        return $this->magnitude * cos($this->angle);
    }

    public function getImaginary(): float
    {
        return $this->magnitude * sin($this->angle);
    }

    public function getAngle(): float
    {
        return $this->angle;
    }

    public function getMagnitude(): float
    {
        return $this->magnitude;
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

        $module = '|' . $this->magnitude . '|';

        return $module . '(cos(' . $this->angle . ')+isin(' . $this->angle . '))';

    }

    private function parseComplex($param)
    {
        /** @todo протестить регулярку */
        if (preg_match('/^\|(\d*\.?\d*?)\|\(cos\((\d*\.?\d*?)\)\+isin\((\d*\.?\d*?)\)\)$/i', $param, $parsed)) {
            $this->magnitude = $parsed[1];
            $this->angle = $parsed[2];
        } else {
            throw new \Exception('Неверный строковый формат описания комплексного числа');
        }
    }

    /**
     * перевод комплексного числа в алгебраическую форму
     * @return ComplexNumberInterface
     */
    public function toAlgebraic(): ComplexNumberInterface
    {
        return new ComplexNumberAlgebraic(
            [
                'r' => $this->getReal(),
                'i' => $this->getImaginary()
            ]
        );
    }

    /**
     * перевод комплексного числа в тригонометрическую форму
     * @return ComplexNumberInterface
     */
    public function toTrigonometric(): ComplexNumberInterface
    {
        return $this;
    }

    public function getType(): string
    {
        return self::TYPE;
    }

    public function add(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberTrigonometric $valB */
        $valB = $b->toTrigonometric();

        $dSin = sin($valB->getAngle() - $this->angle);
        $dCos = cos($valB->getAngle() - $this->angle);

        $newMagnitude = sqrt(($this->magnitude * $this->magnitude) +
            ($valB->getMagnitude() * $valB->getMagnitude()) +
            2 * $this->magnitude * $valB->getMagnitude() * $dCos);

        $newAngle = $this->angle +
            atan2($valB->getMagnitude() * $dSin, $this->magnitude + $b->getMagnitude() * $dCos);

        return new ComplexNumberTrigonometric(
            [
                'm' => $newMagnitude,
                'a' => $newAngle
            ]
        );
    }

    public function inverse(): ComplexNumberTrigonometric
    {

        $newAngle = $this->angle > 0 ? ($this->angle - 3.141592653) : ($this->angle + 3.141592653);
        return new ComplexNumberTrigonometric(
            [
                'm' => $this->magnitude,
                'a' => $newAngle
            ]
        );
    }

    public function subtract(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberTrigonometric $valB */
        $valB = $b->toTrigonometric();
        return $this->add($valB->inverse());
    }

    public function multiply(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberTrigonometric $valB */
        $valB = $b->toTrigonometric();
        return new ComplexNumberTrigonometric(
            [
                'm' => $this->magnitude * $valB->getMagnitude(),
                'a' => $this->angle + $valB->getAngle()
            ]
        );
    }

    public function divide(ComplexNumberInterface $b): ComplexNumberInterface
    {
        /** @var ComplexNumberTrigonometric $valB */
        $valB = $b->toTrigonometric();

        if ($valB->getMagnitude() == 0) {
            $this->setIsDividedByZero();
            $newMagnitude = 0;
            $newAngle = 0;
        } else {
            $newMagnitude = $this->magnitude * $valB->getMagnitude();
            $newAngle = $this->angle + $valB->getAngle();
        }

        return new ComplexNumberTrigonometric(
            [
                'm' => $newMagnitude,
                'a' => $newAngle
            ]
        );

    }

}