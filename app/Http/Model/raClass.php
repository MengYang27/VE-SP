<?php

namespace App\Http\Model;

// use Illuminate\Database\Eloquent\Model;
use function App\Http\AuxiliaryFunc;
use function App\Http\DatabaseFunc;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'AuxiliaryFunc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'DatabaseFunc.php';

class raClass
{
    public $mainID = 'RAID';
    public $currentID;
    public $mainTableName = 'rainfo';
    public $questionType = 'ra';
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
    public $rainfoArray = [];
    public $raquestionArray = [];
    public $raanswerArray = [];
    public $inputUser = 0;

    public function deleteMe($ids)
    {
        foreach ($ids as $id) {
            //   $this->allPaths = SelectSigleRow('rainfo', 'raid', $id)[0][14];
            //   $allPaths_array = string_to_array(",", $this->allPaths);
            //   foreach ($allPaths_array as $path) {
            //     // echo $path;
            //     if (file_exists($path)) {
            //       unlink($path);
            //     }
            //   }
            DeleteFromTable($this->mainTableName, $this->mainID, $id);
            DeleteFromTable('raquestion', $this->mainID, $id);
            DeleteFromTable('raanswer', $this->mainID, $id);
        }
    }

    public function insertMe()
    {
        Insert_RAINFO(addslashes($this->title), $this->isfrequent, $this->difficulty, $this->isnew, $this->isjj, $this->publishdate, $this->updatedate, $this->categories, $this->inputUser, 0);
        $currentID = ReturnMaxID($this->mainTableName, $this->mainID);
        Insert_RAQuestion($currentID, addslashes($this->content));
        Insert_RAAnswer($currentID, $this->allPaths, addslashes($this->comment));
    }

    public function updateMe()
    {
        $this->rainfoArray = array(
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
        $this->raquestionArray = array(
      'content' => "'".addslashes($this->content)."'",
      );
        $this->raanswerArray = array(
      'audioPath' => "'".addslashes($this->audioPaths)."'",
      'raComment' => "'".addslashes($this->comment)."'",
      );
        // UpdateTable($tableName,$alterArray,$conditionColName,$conditionValue)
        UpdateTable('rainfo', $this->rainfoArray, 'RAID', $this->currentID);
        UpdateTable('raquestion', $this->raquestionArray, 'RAID', $this->currentID);
        UpdateTable('raanswer', $this->raanswerArray, 'RAID', $this->currentID);
    }
}
