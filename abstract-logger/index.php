<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 20:04
 */

require_once "AbstractLogger.php";
require_once "FileLogger.php";
require_once "BrowserLogger.php";

require "index.html";

$consonant_en =
    ["q", "w", "r", "t", "p", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v", "b", "n", "m",];

function contains_consonant($input) : bool {

    global $consonant_en;

    $input_as_array = str_split($input);

    foreach ($input_as_array as $item) {
        if (in_array($item, $consonant_en)) return true;
    }

    return false;
}

function print_contains($input) {

    $result = [];

    for ($i = 0; $i < count($input); $i++) {
        $contains = contains_consonant($input[$i]);

        $item = trim($input[$i]);

        $out_1 = "Строка $item ";
        $out_2 = "содержит заглавные буквы";

        $out_string = "$out_1";

        if ($contains) $out_string .= $out_2;
        else $out_string .= "не " . $out_2;
        array_push($result, $out_string);
    }

    return $result;
}

function getLogger($type, $filename=null, $feature=null) : AbstractLogger {
    if ($type == "file") return new FileLogger($filename);
    elseif ($type == "browser") return new BrowserLogger($feature);
}


if (isset($_POST["text"]) && isset($_POST["logger-type"])) {
    $input = trim($_POST["text"]);
    $input = explode("\n", $input);
    $logger_type = $_POST["logger-type"];
    $filename = null;
    $feature = null;

    if (isset($_POST["param"])) {
        $feature = $_POST["param"];
    }

    if (isset($_POST["filename"])) {
        $filename = $_POST["filename"];
    }

    $logger = getLogger($logger_type, $filename, $feature);

    if ($logger != null) {
        $logger->addToLog(print_contains($input));
    } else {
        throw new Error("Ошибка. Неизвестный тип логгера");
    }
}