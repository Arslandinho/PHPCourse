<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 19.05.2018
 * Time: 12:42
 */

require_once "index.html";

define('DAY', 60 * 60 * 24);
$url = "http://localhost:63342";

if (isset($_COOKIE['auth'])) {
    $params = array('auth' => $_COOKIE['auth']);

//    echo $_SERVER['REQUEST_URI'];
    $url .= $_SERVER['REQUEST_URI'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $params
    ));

    curl_exec($curl);
    curl_close($curl);

} else {
    if (isset($_POST['msg'])) {
        $msg = $_POST['msg'];
        setcookie('auth', "$msg", time() + DAY);
        echo $msg;
    }
}