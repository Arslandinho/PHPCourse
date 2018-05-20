<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 19.05.2018
 * Time: 2:41
 */

require_once 'ComplexNumber.php';

$cn = new ComplexNumber(5, 4);
$cn1 = new ComplexNumber(3, 3);
$cn2 = new ComplexNumber(-1, 9);
$cn3 = new ComplexNumber(2.2, 11);
$cn4 = new ComplexNumber(2.1, -11.1);
$cn5 = new ComplexNumber('1', '9');

print $cn->abs() . "\n";
print $cn1->abs() . "\n";
print $cn2->abs() . "\n";
print $cn3->abs() . "\n";
print $cn4->abs() . "\n";
print $cn5->abs() . "\n";