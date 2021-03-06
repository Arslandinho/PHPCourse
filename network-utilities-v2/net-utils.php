<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 09.04.2018
 * Time: 13:30
 */

function esc_shell_args_for_address($address) : string {

    if (strlen($address) > 0) {
        $url = parse_url($address);

        if (isset($url["path"])) {
            if ($url["path"] == $address) {
                return escapeshellarg($address);
            }
        }
    }

    return "";
}

function send_request($address, $type) : string {

    $regex_for_ip_address_format = "#[1-9]?[0-9]?\d(\.[1-9]?[0-9]?\d){3}#";
    $regex_for_percent = "#[1]?[1-9]?\d%#";

    $ip = esc_shell_args_for_address($address);
    $command = "";

    if ($ip == "") {
        return "Неправильный формат ip-адреса. Повторите попытку";
    } else {
        $command .= $type . " " . $ip;
    }

    $output = [];
    exec($command, $output);

    $output = implode("\n", $output);

    $end_result = $type . " ";
    $matches_by_ip_arr = [];
    $matches_by_percent_arr = [];

    $matches_by_ip = preg_match($regex_for_ip_address_format, $output, $matches_by_ip_arr);

    if ($matches_by_ip) {
        $end_result .= "<b>" . $matches_by_ip_arr[0] . "</b><br>";
    }

    if ($type == "ping") {

        $matches_by_percent = preg_match($regex_for_percent, $output, $matches_by_percent_arr);

        if ($matches_by_percent) {
            $successful = 100 - intval($matches_by_percent_arr[0]);
            $end_result .= "Процент успешных запросов: " . $successful;
        }
    } elseif ($type == "tracert") {

        $matches = [];
        preg_match_all($regex_for_ip_address_format, $output, $matches, PREG_SET_ORDER);

        $end_result .= "Запросы выполнены на: ";

        for ($i = 0; $i < count($matches); $i++) {
            $end_result .= "<b>" . $matches[$i][0] . "</b> ";
        }


    } else return "Неизвестный тип запроса. Повторите попытку";

    return $end_result;
}