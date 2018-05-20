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

        for ($i = 0; $i < count($input); $i++) {
            $item = explode("\n", $input[$i]);

            foreach ($item as $item_print) {
                $this->to_print = trim($item_print);
                $this->print_output();
            }
        }
    }
}