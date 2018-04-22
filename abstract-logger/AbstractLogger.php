<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 20:02
 */

abstract class AbstractLogger {

    protected $to_print = "";

    public abstract function print_output();

    public function addToLog($input) {
        $this->to_print .= $input;
        $this->print_output();
    }
}