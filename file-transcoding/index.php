<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 30.03.2018
 * Time: 13:43
 */

function get_arg($string, $arg_length): string {
    return substr($string, 0, $arg_length);
}

function get_ini_params($ini): array {

    $params = [];

    foreach ($ini as $section) {

        foreach ($section as $element) {
            $key_main = array_search($element, $section);

            if ($key_main == "filename") {
                $params[$key_main] = reset($section);
            } else {
                $key = reset($section);
                $params[$key] = $element;
            }
        }
    }

    return $params;
}

function choose_operation($params, $key, $line) {

    $line = substr($line, strlen($key));

    switch ($params[$key]) {
        case "true":
            return strtoupper($line);
        case "false":
            return strtolower($line);
        case "+":
            $line_symbols = str_split($line);

            for ($i = 0; $i < count($line_symbols); $i++) {
                if (preg_match("/[0-9]/", $line_symbols[$i])) {
                    if ($line_symbols[$i] == "9") $line_symbols[$i] = "0";
                    else {
                        $symbol_as_digit = intval($line_symbols[$i]);
                        $symbol_as_digit++;
                        $line_symbols[$i] = $symbol_as_digit . "";
                    }
                }
            }

            return implode($line_symbols);
        case "-":
            $line_symbols = str_split($line);

            for ($i = 0; $i < count($line_symbols); $i++) {
                if (preg_match("/[0-9]/", $line_symbols[$i])) {
                    if ($line_symbols[$i] == "0") $line_symbols[$i] = "9";
                    else {
                        $symbol_as_digit = intval($line_symbols[$i]);
                        $symbol_as_digit--;
                        $line_symbols[$i] = $symbol_as_digit . "";
                    }
                }
            }

            return implode($line_symbols);
        default:
            return str_replace($params[$key], "", $line);
    }
}

function transcode_operation($line, $params) : string {

    foreach ($params as $key => $param) {
        if (get_arg($line, strlen($key)) == $key) {
            return choose_operation($params, $key, $line);
        }
    }

    return $line;
}

function transcode_file() : string {

    $result = "";

    $ini = parse_ini_file(realpath("index.ini"), true);
    $params = get_ini_params($ini);

    $filename = $params["filename"];
    $lines = file($filename, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        $result .= transcode_operation($line, $params) . "<br>";
    }

    return $result;
}

echo transcode_file();