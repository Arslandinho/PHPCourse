<?php

require 'form.html';

function interpret($code, $params) {

    $paramsCurrent = 0;
    $result = [];
    $resultCurrent = -1;

    $endResult = "";

    $brackets = [];

    if (empty($params)) {
        array_push($result, 0);
        $resultCurrent++;
    }

    for ($i = 0; $i < strlen($code); ) {
        $current = $code[$i];

        switch ($current):
            case '+':
                if ($result[$resultCurrent] == 255)
                    $result[$resultCurrent] = 0;
                else
                    $result[$resultCurrent]++;
                $i++;
                break;
            case '-':
                if ($result[$resultCurrent] == 0)
                    $result[$resultCurrent] = 255;
                else
                    $result[$resultCurrent]--;
                $i++;
                break;
            case '>':
                if (count($result) == $resultCurrent + 1) {
                    array_push($result, 0);
                }
                $resultCurrent++;
                $i++;
                break;
            case '<':
                if ($resultCurrent == 0)
                    $resultCurrent = key($result);
                else
                    $resultCurrent--;
                $i++;
                break;
            case '.':
                $endResult .= chr($result[$resultCurrent]);
                $i++;
                break;
            case ',':
                if ($resultCurrent == -1) {
                    $resultCurrent++;
                }
                $result[$resultCurrent] = $params[$paramsCurrent++];
                $i++;
                break;
            case '[':
                if ($result[$resultCurrent] != 0) {
                    array_push($brackets, $i);
                    $i++;
                } else {
                    while (count($brackets) > 1) {
                        if ($result[$resultCurrent] == "]") {
                            array_pop($brackets);
                        } elseif ($result[$resultCurrent] == "[") {
                            array_push($brackets, $i);
                        }
                        $i++;
                    }
                }
                break;
            case ']':
                if ($result[$resultCurrent] != 0) {
                    $i = $brackets[count($brackets) - 1] + 1;
                } else {
                    array_pop($brackets);
                    $i++;
                }
                break;
            default:
                $i++;
        endswitch;
    }
    return $endResult;
}

$code = "";
$params = "";

if (isset($_POST['code']) and isset($_POST['params'])) {
    $code = $_POST['code'];
    $params = $_POST['params'];
}

$params_ascii = [];

for ($i = 0; $i < strlen($params); $i++) {
    $params_ascii[$i] = ord($params[$i]);
}

echo interpret($code, $params_ascii);

// ++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+.>.
// ++++++++[>++++[>++>+++>+++>+<<<<-]>+>+>->>+[<]<-]>>.>---.+++++++..+++.>>.<-.<.+++.------.--------.>>+.>++.

?>
