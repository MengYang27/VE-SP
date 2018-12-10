<?php
use App\Http\Model\raClass;
?>
<?php
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