<?php

namespace App\Http\Model;

// use Illuminate\Database\Eloquent\Model;
use function App\Http\AuxiliaryFunc;
use function App\Http\DatabaseFunc;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'AuxiliaryFunc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'DatabaseFunc.php';

class rlClass
{
    public $mainID = 'RLID';
    public $currentID;
    public $mainTableName = 'rlinfo';
    public $questionType = 'rl';
    public $title;
    public $content;
    public $isfrequent;
    public $isnew;
    public $isjj;
    public $difficulty;
    public $categories_array = [];
    public $categories;
    public $updatedate;
    public $publishdate;
    public $comment;
    public $audioPaths; // string for all paths, directly get from database.
    public $questionAudioPath;
    public $questionAudioPath2;
    public $questionAudioPath3;
    public $questionAllPaths;
    public $rlinfoArray = [];
    public $rlquestionArray = [];
    public $rlanswerArray = [];
    public $keywords;
    public $inputUser = 0;
    public $picPath1;
    public $picAllPaths;
    public $answerAudioPath;
    public $answerAudioPath2;
    public $answerAudioPath3;
    public $answerAllPaths;

    public function deleteMe($ids)
    {
        foreach ($ids as $id) {
            // $this->questionAllPaths = SelectSigleRow('rsinfo', 'rsid', $id)[0][11];
            // // var_dump(SelectSigleRow('rsinfo', 'rsid', $id)[0][14]);
            // $allPaths_array = string_to_array(',', $this->questionAllPaths);
            // foreach ($allPaths_array as $path) {
            //     if (file_exists($path)) {
            //         unlink($path);
            //     }
            // }
            DeleteFromTable($this->mainTableName, $this->mainID, $id);
            DeleteFromTable('rsquestion', $this->mainID, $id);
            DeleteFromTable('rsanswer', $this->mainID, $id);
        }
    }

    public function insertMe()
    {
        Insert_RLINFO(addslashes($this->title), $this->isfrequent, $this->difficulty, $this->isnew, $this->isjj, $this->publishdate, $this->updatedate, $this->categories, $this->inputUser, 0);
        $currentID = ReturnMaxID($this->mainTableName, $this->mainID);
        Insert_RLQuestion($currentID, $this->questionAllPaths, $this->picPath1);
        Insert_RLAnswer($currentID, $this->answerAllPaths, addslashes($this->content), addslashes($this->keywords), addslashes($this->comment));
    }

    public function updateMe()
    {
        $this->rsinfoArray = array(
      'title' => "'".addslashes($this->title)."'",
      'isFrequency' => $this->isfrequent,
      'isDifficult' => $this->difficulty,
      'isNew' => $this->isnew,
      'isJJ' => $this->isjj,
      'createDate' => "'".addslashes($this->publishdate)."'",
      'updateDate' => "'".addslashes($this->updatedate)."'",
      'category' => "'".addslashes($this->categories)."'",
      'inputUser' => $this->inputUser,
      );
        $this->rsquestionArray = array(
      'audioPath' => "'".addslashes($this->audioPaths)."'",
      );
        $this->rsanswerArray = array(
      'transcript' => "'".addslashes($this->content)."'",
      'wordCount' => "'".addslashes($this->wordCount)."'",
      'rsComment' => "'".addslashes($this->comment)."'",
      );
        // UpdateTable($tableName,$alterArray,$conditionColName,$conditionValue)
        UpdateTable('rsinfo', $this->rsinfoArray, 'RSID', $this->currentID);
        UpdateTable('rsquestion', $this->rsquestionArray, 'RSID', $this->currentID);
        UpdateTable('rsanswer', $this->rsanswerArray, 'RSID', $this->currentID);
    }
}