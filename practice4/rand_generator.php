<?php
/**
 * Created by PhpStorm.
 * User: Arslan
 * Date: 16.03.2018
 * Time: 22:39
 */

function getSingleObject($text, $data) {

    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]->text === $text) {
            return $data[$i];
        }
    }

    return null;
}

function randomGenerator($json, $number) {

    for ($i = 0; $i < $number; $i++) {

        $randWeight = 0;

        try {
            $randWeight = random_int(0, $json->sum);
        } catch (Exception $e) {
        }

        $data = $json->data;

        $weightToCount = 0;

        for ($j = 0; $j < count($data); $j++) {
            if ($weightToCount <= $randWeight) {
                $weightToCount += $data[$j]->weight;

                if ($weightToCount > $randWeight) {
                    yield $data[$j]->text;
                }
            }
        }
    }
}

function generatorCheckFunc($json): array {
    $number = 10000;

    $generator = randomGenerator($json, $number);
    $data = [];

    foreach ($generator as $generated) {
        $item = getSingleObject($generated, $data);

        if ($item == null) {
            $newItem = (object)[];
            $newItem->text = $generated;
            $newItem->count = 1;

            array_push($data, $newItem);
        } else {
            ++$item->count;
        }
    }

    for ($i = 0; $i < count($data); $i++) {
        $data[$i]->calculated_probability = $data[$i]->count / $number;
    }

    return $data;
}

