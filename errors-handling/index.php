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
} catch (\Exceptions\UltraMegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\MegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperDuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SimpleException $e) {
    print $e->getMessage();
} finally {
    print " on first_function().\n";
}

try {
    $generator->second_function();
} catch (\Exceptions\UltraMegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\MegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperDuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SimpleException $e) {
    print $e->getMessage();
} finally {
    print " on second_function().\n";
}

try {
    $generator->third_function();
} catch (\Exceptions\UltraMegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\MegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperDuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SimpleException $e) {
    print $e->getMessage();
} finally {
    print " on third_function().\n";
}

try {
    $generator->fourth_function();
} catch (\Exceptions\UltraMegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\MegaException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperDuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SuperException $e) {
    print $e->getMessage();
} catch (\Exceptions\SimpleException $e) {
    print $e->getMessage();
} finally {
    print " on fourth_function().\n";
}