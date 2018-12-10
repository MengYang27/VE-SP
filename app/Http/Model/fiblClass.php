<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'AuxiliaryFunc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'DatabaseFunc.php';

class fiblClass {
  public $mainID = 'FIBLID';
  public $currentID;
  public $mainTableName = 'fiblinfo';
  public $questionType = 'fibl';
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
  public $fiblinfoArray = [];
  public $fiblquestionArray = [];
  public $fiblanswerArray = [];
  public $wordCount;
  public $answers;


  function deleteMe ($ids) {
    foreach ($ids as $id) {
      $this->allPaths = SelectSigleRow('fiblinfo', 'fiblid', $id)[0][11];
      // var_dump(SelectSigleRow('fiblinfo', 'fiblid', $id)[0][14]);
      $allPaths_array = string_to_array(",", $this->allPaths);
      foreach ($allPaths_array as $path) {
        if (file_exists($path)) {
          unlink($path);
        }
      }
      DeleteFromTable($this->mainTableName,$this->mainID,$id);
      DeleteFromTable('fiblquestion',$this->mainID,$id);
      DeleteFromTable('fiblanswer',$this->mainID,$id);
    }
  }
  
  function insertMe () {
      Insert_FIBLINFO(addslashes($this->title), $this->isfrequent, $this->difficulty, $this->isnew, $this->isjj, $this->publishdate, $this->updatedate, $this->categories);
      $currentID = ReturnMaxID($this->mainTableName, $this->mainID);
      Insert_FIBLQuestion($currentID, addslashes($this->content), $this->allPaths);
      Insert_FIBLAnswer($currentID, $this->answers, addslashes($this->comment));
  }

  function updateMe () {
    $this->fiblinfoArray = array(
      "title" =>  "'".addslashes($this->title)."'",
      "isFrequency" => $this->isfrequent,
      "isDifficult" => $this->difficulty,
      "isNew" => $this->isnew,
      "isJJ" => $this->isjj,
      "publishDate" => "'".addslashes($this->publishdate)."'",
      "updateDate" => "'".addslashes($this->updatedate)."'",
      "category" => "'".addslashes($this->categories)."'"
      );
    $this->fiblquestionArray = array(
      "audioPath" => "'".addslashes($this->audioPaths)."'",
      );
    $this->fiblanswerArray = array(
      "transcript" => "'".addslashes($this->content)."'",
      "wordCount" => "'".addslashes($this->wordCount)."'",
      "fiblComment" => "'".addslashes($this->comment)."'"
      );
      // UpdateTable($tableName,$alterArray,$conditionColName,$conditionValue)
      UpdateTable('fiblinfo', $this->fiblinfoArray, 'FIBLID', $this->currentID);
      UpdateTable('fiblquestion', $this->fiblquestionArray, 'FIBLID', $this->currentID);
      UpdateTable('fiblanswer', $this->fiblanswerArray, 'FIBLID', $this->currentID);
    }

}

?>