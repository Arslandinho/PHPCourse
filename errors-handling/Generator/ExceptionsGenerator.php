<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 22.04.2018
 * Time: 17:04
 */

namespace Generator;

use Exceptions\IException;
use Exceptions\MegaException;
use Exceptions\SimpleException;
use Exceptions\SuperDuperException;
use Exceptions\SuperException;
use Exceptions\UltraMegaException;

class ExceptionsGenerator
{

    /**
     * @throws IException
     */
    public function first_function() {
        $ex1 =  getRandomException();
        $ex2 = getAnotherRandomException($ex1);

        if (true) {
            throw $ex1;
        }

        throw $ex2;
    }

    /**
     * @throws IException
     */
    public function second_function() {
        $ex1 =  getRandomException();
        $ex2 = getAnotherRandomException($ex1);

        if (true) {
            throw $ex1;
        }

        throw $ex2;
    }

    /**
     * @throws IException
     */
    public function third_function() {
        $ex1 =  getRandomException();
        $ex2 = getAnotherRandomException($ex1);

        if (true) {
            throw $ex1;
        }

        throw $ex2;
    }

    /**
     * @throws IException
     */
    public function fourth_function() {
        $ex1 =  getRandomException();
        $ex2 = getAnotherRandomException($ex1);

        if (true) {
            throw $ex1;
        }

        throw $ex2;
    }

    function __toString()
    {
        return $this.__CLASS__;
    }
}

function getRandomException() : IException {

    $random = 0;

    try {
        $random = rand(1, 5);
    } catch (\Exception $e) {
    }

    switch ($random) {
        case 1:
            return new SimpleException("SimpleException was thrown");
            break;
        case 2:
            return new SuperException("SuperException was thrown");
            break;
        case 3:
            return new SuperDuperException("SuperDuperException was thrown");
            break;
        case 4:
            return new MegaException("MegaException was thrown");
            break;
        case 5:
            return new UltraMegaException("UltraMegaException was thrown");
            break;
        default:
            return new SimpleException("SimpleException was thrown");
    }
}

function getAnotherRandomException($exception) {
    $truth = false;
    $local_ex = getRandomException();

    while (!$truth) {
        if ($local_ex != $exception) {
            $truth = true;
        }
        else {
            $local_ex = getRandomException();
        }
    }

    return $local_ex;
}