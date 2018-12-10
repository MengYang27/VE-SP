<?php

namespace App\Http\Model;

// use Illuminate\Database\Eloquent\Model;
use function App\Http\AuxiliaryFunc;
use function App\Http\DatabaseFunc;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'AuxiliaryFunc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'DatabaseFunc.php';

class rsClass
{
    public $mainID = 'RSID';
    public $currentID;
    public $mainTableName = 'rsinfo';
    public $questionType = 'rs';
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
    public $sampleAnswerAudioPath;
    public $sampleAnswerAudioPath2;
    public $sampleAnswerAudioPath3;
    public $allPaths;
    public $rsinfoArray = [];
    public $rsquestionArray = [];
    public $rsanswerArray = [];
    public $wordCount;
    public $inputUser = 0;

    public function deleteMe($ids)
    {
        foreach ($ids as $id) {
            $this->allPaths = SelectSigleRow('rsinfo', 'rsid', $id)[0][11];
            // var_dump(SelectSigleRow('rsinfo', 'rsid', $id)[0][14]);
            $allPaths_array = string_to_array(',', $this->allPaths);
            foreach ($allPaths_array as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            DeleteFromTable($this->mainTableName, $this->mainID, $id);
            DeleteFromTable('rsquestion', $this->mainID, $id);
            DeleteFromTable('rsanswer', $this->mainID, $id);
        }
    }

    public function insertMe()
    {
        Insert_RSINFO(addslashes($this->title), $this->isfrequent, $this->difficulty, $this->isnew, $this->isjj, $this->publishdate, $this->updatedate, $this->categories, $this->inputUser, 0);
        $currentID = ReturnMaxID($this->mainTableName, $this->mainID);
        Insert_RSQuestion($currentID, $this->allPaths);
        Insert_RSAnswer($currentID, addslashes($this->content), $this->wordCount, addslashes($this->comment));
    }

    public function updateMe()
    {
        $this->rsinfoArray = array(
      'title' => "'".addslashes($this->title)."'",
      'isFrequency' => $this->isfrequent,
      'isDifficult' => $this->difficulty,
      'isNew' => $this->isnew,
      'isJJ' => $this->isjj,
      'publishDate' => "'".addslashes($this->publishdate)."'",
      'updateDate' => "'".addslashes($this->updatedate)."'",
      'category' => "'".addslashes($this->categories)."'",
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
