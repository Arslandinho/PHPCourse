<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 08.04.2018
 * Time: 16:38
 */

function display_ip($address) : string {
    return "<b>" . $address . "</b><br><br>";
}

function esc_shell_args_for_address($address) : string {

    if (strlen($address) > 0) {
        $url = parse_url($address);

        if (isset($url["path"])) {
            if ($url["path"] == $address) {
                return escapeshellarg($address);
            }
        }
    }

    return null;
}

function check_connection($address, $type) : string {

    switch ($type) {
        case "ping":
            return ping($address);
        case "tracert":
            return tracert($address);
        default:
            return "Неизвествий тип соединения";
    }
}

function ping($address) : string {

    $ip_regex = "#\d{1,3}(\.\d{1,3}){3}#";
    $percent_regex = "#\d{1,3}%#";

    $result = "ping ";
    $command = "ping ";

    $address = esc_shell_args_for_address($address);

    if ($address != null) {
        $command .= $address;
    } else {
        return "Неверный формат адреса";
    }

    $output = [];
    $ping_out = exec($command, $output);

    foreach ($output as $item) {
        $ping_out .= $item . "\n";
    }

    $ip_matches = [];
    $percent_matches = [];

    if (preg_match($ip_regex, $ping_out, $ip_matches) && preg_match($percent_regex, $ping_out,
                                                                            $percent_matches)) {
        $percent = 100 - (int)$percent_matches[0];

        $result .= display_ip($ip_matches[0]) . "Процент успешных запросов: " . $percent . "%";
    } else {
        return "Сбой при выполнении команды ping";
    }

    return $result;

}

function tracert($address) : string {

    $ip_regex = "#\d{1,3}(\.\d{1,3}){3}#";

    $result = "tracert ";
    $command = "tracert ";

    $address = esc_shell_args_for_address($address);

    if ($address != null) {
        $command .= $address;
    } else {
        return "Неверный формат адреса";
    }

    $output = [];
    $tracert_out = exec($command, $output);

    foreach ($output as $item) {
        $tracert_out .= $item . "\n";
    }

    $ip_matches = [];
    if (preg_match($ip_regex, $tracert_out, $ip_matches)) {

        $result = display_ip($ip_matches[0]) . "<br>IP-Адреса:<br>";

        for ($i = 1; $i < count($ip_matches); $i++) {
            $result .= $ip_matches[$i];
        }
    } else {
        return "Сбой при выполнении команды tracert";
    }

    return $result;
}
