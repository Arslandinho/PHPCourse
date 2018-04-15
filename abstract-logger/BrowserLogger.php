<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 20:03
 */

class BrowserLogger extends AbstractLogger {

    private $feature;

    public function __construct($input, $feature) {
        parent::__construct($input);
        $this->feature = $feature;
    }

    public function print_output() {
        $this->add_features();

        echo $this->to_print;
    }

    private function add_features() {

        $full_date = new DateTime();
        $full_date->setTimezone(new DateTimeZone("Europe/Moscow"));

        switch ($this->feature) {
            case "NONE":
                break;
            case "DT":
                $this->to_print = date_format($full_date, "d.m.Y H:i:s") . " " . $this->to_print;
                break;
            case "T":
                $this->to_print = date_format($full_date, "H:i:s") . " " . $this->to_print;
                break;
            default:
                throw new Error("Неизвестный параметр");
        }
    }
}