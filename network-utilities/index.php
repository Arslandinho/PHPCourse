<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 08.04.2018
 * Time: 13:21
 */

include "net-utils.php";
require "index.html";

if (isset($_POST['resource']) && isset($_POST['type'])) {
    $address = trim($_POST['resource']);
    $type = $_POST['type'];

    echo check_connection($address, $type);
}


