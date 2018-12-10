<?php

// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'AuxiliaryFunc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'DatabaseFunc.php';
// require_once 'AuxiliaryFunc.php';
// require_once 'DatabaseFunc.php';

// var_dump($mainTableName);
$mainTableName = isset($_GET['mainTableName']) ? $_GET['mainTableName'] : 'rainfo';
// var_dump($mainTableName);
header('Content-type:text/json');
$data = Select_WholeTable_json($mainTableName, 'updateDate');
// var_dump($abc);
$data = json_decode($data, true);

if (null !== $data) {
    $pattern = '/id$/i';
    $id_array = [];
    foreach ($data as $key => $entry) {
        // var_dump($entry);
        foreach ($entry as $k => $value) {
            // var_dump($k);
            if (preg_match($pattern, $k)) {
                $id_array['id'] = $entry[$k];
                unset($entry[$k]);
                break;
            }
        }
        $entry = $id_array + $entry;
        $data[$key] = $entry;
        $data = mappingBooleanToString($data, $key, $entry, 'isFrequency');
        $data = mappingBooleanToString($data, $key, $entry, 'isNew');
        $data = mappingBooleanToString($data, $key, $entry, 'isJJ');
        $data = mappingDifficulty($data, $key, $entry, 'isDifficult');
        $data = findUserName($data, $key, $entry, 'inputUser');
    }
}

$data = json_encode($data);

echo $data;
