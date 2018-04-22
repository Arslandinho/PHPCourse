<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 22.04.2018
 * Time: 20:44
 */

spl_autoload_register(function ($class) {
    include_once "$class.php";
});

$generator = new Generator\ExceptionsGenerator();

try {
    $generator->first_function();
    $generator->second_function();
    $generator->third_function();
    $generator->fourth_function();
} catch (\Exceptions\IException $e) {
}