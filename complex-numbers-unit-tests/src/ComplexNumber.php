<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 18.05.2018
 * Time: 19:11
 */

class ComplexNumber
{
    private $real;
    private $imag;

    /**
     * ComplexNumber constructor.
     * @param $real
     * @param $imag
     */
    public function __construct(float $real, float $imag)
    {
        $this->real = $real;
        $this->imag = $imag;
    }

    /**
     * @param ComplexNumber $cn
     */
    public function add(ComplexNumber $cn) : void
    {
        $this->real = $this->real + $cn->real;
        $this->imag = $this->imag + $cn->imag;
    }

    /**
     * @param ComplexNumber $cn
     */
    public function sub(ComplexNumber $cn) : void
    {
        $this->real = $this->real - $cn->real;
        $this->imag = $this->imag - $cn->imag;
    }

    /**
     * @param ComplexNumber $cn
     */
    public function mult(ComplexNumber $cn) : void
    {
        $this->real = $this->real * ($cn->real + $cn->imag);
        $this->imag = $this->imag * ($cn->real - $cn->imag);
    }

    /**
     * @param ComplexNumber $cn
     */
    public function div(ComplexNumber $cn) : void
    {
        $a1 = $this->real;
        $b1 = $this->imag;
        $a2 = $cn->real;
        $b2 = $cn->imag;

        $this->real = ($a1 * $a2 + $b1 * $b2) / ($a2 * $a2 + $b2 * $b2);
        $this->imag = ($a2 * $b1 - $a1 * $b2) / ($a2 * $a2 + $b2 * $b2);
    }

    /**
     * Модуль комплексного числа
     *
     * @return float
     */
    public function abs() : float
    {
        return sqrt($this->real * $this->real + $this->imag * $this->imag);
    }

    /**
     * Вывод комплексного числа: a + bi, a - bi или a (в случае, если мнимая часть равна 0)
     *
     * @return string
     */
    public function __toString()
    {
        $asString = $this->real . "";

        if ($this->imag > 0) {
            $asString .= "+" . $this->imag . "i";
        } elseif ($this->imag < 0) {
            $asString .= "-" . abs($this->imag) . "i";
        }

        return $asString;
    }

}
