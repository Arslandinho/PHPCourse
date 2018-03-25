<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 23.03.2018
 * Time: 16:40
 */

require "index.html";

$conditions = [
    "first_condition" => "/^\S{10,}$/",
    "second_condition_1" => "/(\S*[A-Z]+\S*){2,}/",
    "second_condition_2" => "/(\S*[a-z]+\S*){2,}/",
    "second_condition_3" => "/(\S*[0-9]+\S*){2,}$/",
    "second_condition_4" => "/(([A-Z]*[a-z]*[0-9]*[%$#_\*]*)*[%$#_\*]([A-Z]*[a-z]*[0-9]*[%$#_\*]*)*){2,}/",
    "third_condition_1" => "/[A-Z]{4,}/",
    "third_condition_2" => "/[a-z]{4,}/",
    "third_condition_3" => "/[0-9]{4,}/",
    "third_condition_4" => "/[%$#_\*]{4,}/",
];

$const1 = "В пароле содержится менее 2 ";
$const2 = "В пароле содержится более 3 ";

function validate($password) : string {

    global $conditions;

    global $const1;
    global $const2;

    echo "Ваш пароль: " . $password . "<br/><br/>";

    $error_messages = [
        "Длина пароля должная быть не менее 10 символов" => preg_match($conditions["first_condition"], $password),
        $const1."заглавных букв" => preg_match($conditions["second_condition_1"], $password),
        $const1."строчных букв" => preg_match($conditions["second_condition_2"], $password),
        $const1."цифр" => preg_match($conditions["second_condition_3"], $password),
        $const1."спецсимволов из списка %, $, #, _, *, либо недопустимый символ" =>
                                                            preg_match($conditions["second_condition_4"], $password),
        $const2."заглавных букв подряд" => !preg_match($conditions["third_condition_1"], $password),
        $const2."строчных букв подряд" => !preg_match($conditions["third_condition_2"], $password),
        $const2."цифр подряд" => !preg_match($conditions["third_condition_3"], $password),
        $const2."специальных символов подряд из списка %, $, #, _, *" =>
                                                            !preg_match($conditions["third_condition_4"], $password),
    ];

    foreach ($error_messages as $not_error) {
        if (!$not_error) {
            return "<h3>Ошибка</h3><br>" . array_search($not_error, $error_messages);
        } else {
            continue;
        }
    }

    return "Вход успешно выполнен. Пароль - что надо!";
}

$input = "";

if (isset($_POST['pass'])) {
    $input = $_POST['pass'];

    echo validate($input);
}

/*

aSd2#23lR$a

aSd2#23#R

aSd2#23l;R$
aSd2#23lr*a
aSd2#R$abc
aS2#23R$G4

1233ads$5SD$
123sads$5SD$
123ads$5DDSD$
123ads$5DD#%$$

 */
