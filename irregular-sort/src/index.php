<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 10.03.2018
 * Time: 12:34
 */

require 'index.html';


function findSecondWord($inputStr) : string {

    $trimmedInput = trim($inputStr);

    $symbolAfterFirstBarIndex = strpos($trimmedInput, " ") + 1;

    $cutInput = substr($trimmedInput, $symbolAfterFirstBarIndex);

    $symbolBeforeSecondBarIndex = strpos($cutInput, " ");

    return substr($trimmedInput, $symbolAfterFirstBarIndex, $symbolBeforeSecondBarIndex);
}

function buildMixedArray($inputString) : array {

    $replaceValue = "#END.";

    $tempStr = str_replace(array("%0D%0A", "\r\n", "\n", "\r", "\n\r"), $replaceValue, urlencode($inputString));

    $tempStr = urldecode($tempStr);

    $outputArray = explode($replaceValue, $tempStr);

    $duplicatedArray = [];

    for ($i = 0; $i < count($outputArray); $i++) {
        $tempArr = explode(" ", $outputArray[$i]);
        $duplicatedArray[] = $tempArr;
    }

    $duplicatedArrayOfStrings = [];

    for ($i = 0; $i < count($duplicatedArray); $i++) {
        shuffle($duplicatedArray[$i]);
        $duplicatedArrayOfStrings[] = join(" ", $duplicatedArray[$i]);
    }

    for ($i = 0; $i < count($duplicatedArrayOfStrings); $i++) {
    }

    $joinedArray = array_merge($duplicatedArrayOfStrings, $outputArray);

    return $joinedArray;
}


$input = "";

if (isset($_POST['msg'])) {
    $input = $_POST['msg'];
}

$example = buildMixedArray($input);

usort($example, function ($first, $second) {
   return findSecondWord($first) <=> findSecondWord($second);
});

for ($i = 0; $i < count($example); $i++) {
    echo $example[$i];
    echo "<br/>";
}

/*

Пример для теста:

happy bday man
you will always lose
and i won't dude.
let's go to moscow/spb
lol nvm kek

 */