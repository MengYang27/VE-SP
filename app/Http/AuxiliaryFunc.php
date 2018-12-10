<?php
// examine whether users text input is legal or not
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// setting categories  array -> string.
function flatten_array($array1) {
    if (gettype($array1) == 'array') { 
    $flattened_array = implode(',', $array1);
    } else {
    $flattened_array = null;
    }
    return $flattened_array;
}

// string -> array
function string_to_array($separator ,$string) {
    return explode($separator, $string);
}

// generate a unique audio path for questions.
function generate_audio_path ($question_type, $currentID, $file_type) {
    $current_datetime = date("Y-m-d-h-i-s");
    $standarized_file_name = $question_type.'_'. $currentID. '_' .$current_datetime.'_'.rand(10, 100). guid() . '.'.explode('/', $file_type)[1];
    $folderPath = storage_path().'/upload/'.$question_type;
    $audioPath = $folderPath.'/'.$standarized_file_name;

    if (! is_dir(storage_path().'/upload')) {
        mkdir(storage_path().'/upload');
    }
    
    if (! is_dir($folderPath)) {
        mkdir($folderPath);
    }
    return $audioPath;
}


// generate a random string
function guid(){
    mt_srand((double)microtime()*10000);// optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45);// “-”
    $uuid =
    substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4);
    return $uuid;
}

// check if the file is loaded and return the path whenever if was uploaded or not.
function updateFiles($id, $uploadedFileName, $path, $question_type) {
    if ('' !== $_FILES[$uploadedFileName]['tmp_name']) { // we don't got the update for the file.
        $file_type = $_FILES[$uploadedFileName]['type'];
        if (file_exists($path)) {
            unlink($path); // delete the old one
        }


        // generate a new path
        $path = generate_audio_path($question_type, $id, $file_type);

        // transfer data to the standard location (new path)
        move_uploaded_file($_FILES[$uploadedFileName]['tmp_name'], $path);
        return $path;
      } else {
        // placeholder not catch a new file but has a old file path
        if (file_exists($path)) {
            return $path;
        } 
        // placeholder not catch a new file and has no old file path
        // which means delete by the trash button
        // we need to delete old files.
        return "";
      }
}

function allPathsGenerator ($path1, $path2, $path3) {
    $res = str_replace(",,", ",", $path1 . ',' . $path2 . ',' . $path3);
    $res = (substr($res, -1) == ',') ? mb_substr($res, 0, -1) : $res; // remove the last ',';
    $res = (substr($res, 0, 1) == ',') ? mb_substr($res, 1) : $res; // remove the first ',';
    return $res;
}

// redirect a php page to another php page.
// function Redirect($url, $permanent = false)
// {
//     header('Location: ' . $url, true, $permanent ? 301 : 302);

//     exit();
// }

// extract date from file name
function extractDateFromFN($fileName) {
    if (preg_match("/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/",$fileName, $matches)) {
     return $matches[0];
    } else {
        return null;
    }
 }

// mapping 0,1 to Yes/No
function mappingBooleanToString($data, $key, $entry, $colName) {
    if ($entry[$colName] == '0') {
        $data[$key][$colName] = 'No';
    } else {
        $data[$key][$colName] = 'Yes';
    }
    return $data;
}

// mapping 0,1,2,3,4,5 to ... see below
function mappingDifficulty($data, $key, $entry, $colName) {
    switch ($entry[$colName]) {
        case '0':
            $data[$key][$colName] = 'No Input';
            break;
        case '1':
            $data[$key][$colName] = 'Very Easy'; 
            break;
        case '2':
            $data[$key][$colName] = 'Easy';
            break;
        case '3':
            $data[$key][$colName] = 'Medium';
            break;
        case '4':
            $data[$key][$colName] = 'Hard';
            break;
        case '5':
            $data[$key][$colName] = 'Very Hard'; 
            break;
    }
    return $data;
}

// mapping an input user from int id to the name.
function findUserName($data, $key, $entry, $colName) {
    $user_id = $entry[$colName];
    $user_name = SelectSingleElement('adminmaster', 'name', 'id', $user_id)[0][0];
    $data[$key][$colName] = $user_name;
    return $data;
}


?>