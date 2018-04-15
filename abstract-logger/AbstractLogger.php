<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 20:02
 */

abstract class AbstractLogger {

    protected $to_print;

    public function __construct($input) {
        $this->to_print = $input;
    }

    public abstract function print_output();

    public function getPrint() {
        return $this->to_print;
    }
}