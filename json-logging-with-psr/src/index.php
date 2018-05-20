<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 07.05.2018
 * Time: 22:29
 */

use logger\JsonLogger;

$loader = require '../vendor/autoload.php';
$loader->add('psr\\', __DIR__ . '/src/');

spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});

$logger = new JsonLogger();

$logger->log("blabla", "blablabla");
$logger->info("Read this");
$logger->warning("Don't read this");
$logger->error("Don't read this");
$logger->error("Error code: {err_code}", array("err_code" => "202"));
$logger->critical("You're gonna die in {one}, {two}, {three}...", array("one" => 1, "two" => 2, "three" => 3));
$logger->alert("If you read this, you won {one} free ticket!", array("one" => 1));