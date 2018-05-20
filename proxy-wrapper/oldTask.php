<?php

require 'index.html';

function retranslate($example) : string
{
    $modifiedExample = "";

    function str_generator($example) {
        static $changes = 0;

        for ($i = 0; $i < strlen($example); $i++) {
            switch ($example[$i]) {
                case "h":
                    $changes++;
                    yield "4";
                    break;
                case "l":
                    $changes++;
                    yield "1";
                    break;
                case "e":
                    $changes++;
                    yield "3";
                    break;
                case "o":
                    $changes++;
                    yield "0";
                    break;
                default:
                    yield $example[$i];
                    break;
            }
        }

        return $changes;
    }

    $generator = str_generator($example);

    foreach ($generator as $i) {
        $modifiedExample .= $i;
    }

    echo "Число изменений: " .$generator->getReturn() ."<br>";

    return $modifiedExample;
}
