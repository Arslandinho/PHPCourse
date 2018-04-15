<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 20:03
 */

class FileLogger extends AbstractLogger {

    private $file;

    public function __construct($input, $path_to_file) {
        parent::__construct($input);
        $this->file = fopen($path_to_file . ".txt", "w");
    }

    public function __destruct() {
        fclose($this->file);
    }

    public function print_output() {

        fwrite($this->file, parent::getPrint());
    }
}