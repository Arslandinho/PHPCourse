<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 29.04.2018
 * Time: 21:44
 */

spl_autoload_register(function ($class_name) {
    include_once $class_name . ".php";
});


//Все варианты работают:

$month = new Month("March", 2018);
//$month = new Month(4, 2018);
//$month = new Month(04, 2018);
//$month = new Month("Mar", 2018);

print $month->getDay(29) . "<br><br>";

$print = "";

foreach ($month->getIterator() as $day) {
    $print .= $day . "|";
}

echo nl2br($print);
