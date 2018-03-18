<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 16.03.2018
 * Time: 22:39
 */

include "rand_generator.php";

require "index.html";

function getObjectFromInput($input) : object {

    $replaceValue = "#END.";

    $tempStr = str_replace(array("%0D%0A", "\r\n", "\n", "\r", "\n\r"), $replaceValue, urlencode($input));

    $tempStr = urldecode($tempStr);

    $outputArray = explode($replaceValue, $tempStr);

    $weights = getAllStringWeights($outputArray);

    $output = (object)[];
    $data = [];
    $output->sum = $weights->sum;

    for ($i = 0; $i < count($outputArray); $i++) {

        $obj = (object)[];

        $obj->text = substr($outputArray[$i], 0, strrpos($outputArray[$i], " "));
        $obj->weight = $weights->weights[$i];
        $obj->probability = $obj->weight/$weights->sum;

        array_push($data, $obj);
    }

    $output->data = $data;

    return $output;
}

function getAllStringWeights($inputArray) : object {

    $weights = (object)[];

    $weights->weights = [];
    $sum = 0;

    for ($i = 0; $i < count($inputArray); $i++) {

        $weight = intval(substr($inputArray[$i], strrpos($inputArray[$i], " ") + 1));
        array_push($weights->weights, $weight);

        $sum += $weight;
    }

    $weights->sum = $sum;

    return $weights;
}

$input = "";

if (isset($_POST['msg'])) {
    $input = $_POST['msg'];
    $example = getObjectFromInput($input);
    $encoded_example = json_encode($example, JSON_PRETTY_PRINT);
    echo $encoded_example;

    echo "<br/><br/>";

    $example2 = json_encode(generatorCheckFunc(json_decode($encoded_example)),JSON_PRETTY_PRINT);

    echo $example2;
}


/*

Пример для теста:

happy bday man 3
you will always lose 6
and i won't dude. 9
let's go to moscow/spb 5
lol nvm kek 11

 */


