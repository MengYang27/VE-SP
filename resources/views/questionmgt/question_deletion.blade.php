<?php
use App\Http\Model\raClass;
use App\Http\Model\rsClass;

$questionType = $_POST['questionType'];
$actionName = $_POST['actionName'];
$colValue = $_POST['colValue'];
switch ($actionName) {
    case "delete":
        switch ($questionType) {
            case "ra":
                $question = new raClass;
                $question->deleteMe($colValue);
                break;
            case "rs":
                $question = new rsClass;
                $temp = $question->deleteMe($colValue);
                break;

        }

}
?>