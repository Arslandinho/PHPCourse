<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 13.05.2018
 * Time: 15:29
 */

require "oldTask.php";

$input = "";

if (isset($_POST['msg'])) {
    $input = $_POST['msg'];
}

echo "Рузультат: " .retranslate($input);