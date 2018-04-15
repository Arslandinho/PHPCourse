<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 20:04
 */

//mb_http_output('UTF-8');
//
//mb_internal_encoding('UTF-8');
//mb_http_output('UTF-8');
//mb_http_input('UTF-8');
//mb_language('uni');
//mb_regex_encoding('UTF-8');
//ob_start('mb_output_handler');

require_once "AbstractLogger.php";
require_once "FileLogger.php";
require_once "BrowserLogger.php";

require "index.html";

//$consonant_ru =
//    ["й", "ц", "к", "н", "г", "ш", "щ", "з", "х", "ф", "в", "п", "р", "л", "д", "ж", "ч", "с", "м", "т", "б",];
$consonant_en =
    ["q", "w", "r", "t", "p", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v", "b", "n", "m",];

function contains_consonant($input) : bool {

    global $consonant_en;
    //global $consonant_ru;

    $input_as_array = str_split($input);

    foreach ($input_as_array as $item) {
        if (in_array($item, $consonant_en)
            //|| in_array($item, $consonant_ru)
        ) {
            return true;
        };
    }

    return false;
}

function print_contains($input) : string {

    $contains = contains_consonant($input);

    $out_1 = "Строка $input ";
    $out_2 = "содержит заглавные буквы";

    if ($contains) return $out_1 . $out_2;
    else return $out_1 . "не " . $out_2;
}

function getLogger($input, $type, $filename=null, $feature=null) : AbstractLogger {
    if ($type == "file") return new FileLogger($input, $filename);
    elseif ($type == "browser") return new BrowserLogger($input, $feature);
}



if (isset($_POST["text"]) && isset($_POST["logger-type"])) {
    $input = trim($_POST["text"]);
    $logger_type = $_POST["logger-type"];
    $filename = null;
    $feature = null;

    if (isset($_POST["param"])) {
        $feature = $_POST["param"];
    }

    if (isset($_POST["filename"])) {
        $filename = $_POST["filename"];
    }

    $input = print_contains($input);

    $logger = getLogger($input, $logger_type, $filename, $feature);

    if ($logger != null) {
        $logger->print_output();
    } else {
        throw new Error("Ошибка. Неизвестный тип логгера");
    }
}