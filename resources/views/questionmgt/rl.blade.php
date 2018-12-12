<?php
  use App\Http\Model\rlClass;
  // use functiion App\Http\AuxiliaryFunc\ReturnMaxID;
  // include
  // use App\AuxiliaryFunc;

?>

@extends('layouts.questionmgtLayout')

@section('additional_css')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style type="text/css">
    .error {
        border-color: #FF4500;
        color: #FF4500;
    }

    .valid {
        color: green;
    }
</style>
@endsection

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


    </section>

    <?php 
    // notification for after updating a record.
    // if(isset($_GET["updates"]) && $_GET["updates"] == '1') {
    //   echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("The record has been updated, cheers!");});</script>';
    //   echo '<script type="text/javascript">alert("One new record has been added, cheers!");</script>';
    // } elseif (isset($_GET["updates"]) && $_GET["updates"] == '0') {
    //   echo '<script type="text/javascript">alert("Same Record has found.");</script>';
    // }
    ?>

    <section class="content container-fluid grid">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">Velocity English - Retell Lecture</a></li>
            <!-- <li role="presentation"><a href="#"></a></li> -->
        </ul>
        <!-- The content of the document...... -->
        <form id="form" method="post" action="{{ url('/questionmgt/speaking/rl') }}" enctype="multipart/form-data"
            onkeydown="if(event.target.nodeName !== 'TEXTAREA' &&
            event.keyCode==13){return
            false;}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- <div class="alert alert-info" id="alertboard" role="alert">Velocity English - Read Aloud</div> -->
            </div>
            <div style="min-height: 135px;">
                <div class="form-group col-md-6" style="padding-right: 10px; margin:0;">
                    <label for="title">Title</label>
                    <input style="max-width: 400px;" type="text" name="title" class="form-control" id="title"
                        placeholder="Question Title ...">
                </div>

                <div class="form-group col-md-2">
                    <label class="form-check-label" for="isfrequent">
                        Frequent
                    </label>
                    <input name="isfrequent" class="form-check-input" type="checkbox" value="1" id="isfrequent">
                </div>

                <div class="form-group col-md-2">
                    <label class="form-check-label" for="isnew">
                        New
                    </label>
                    <input name="isnew" class="form-check-input" type="checkbox" value="1" id="isnew">
                </div>

                <div class="form-group col-md-2">
                    <label class="form-check-label" for="isjj">
                        Is JiJing(机经)
                    </label>
                    <input name="isjj" class="form-check-input" type="checkbox" value="1" id="isjj">
                </div>


                <div class="form-group col-md-2">
                    <label for="difficulty">Difficulty</label>
                    <select name="difficulty" class="form-control" id="difficulty">
                        <option value="0">No Input</option>
                        <option value="1">Very Easy</option>
                        <option value="2">Easy</option>
                        <option value="3">Medium</option>
                        <option value="4">Hard</option>
                        <option value="5">Very Hard</option>
                    </select>
                </div>

                <!-- .row -->
            </div>
            {{-- Question Audio --}}
            <div>
                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect1">Upload Question Audio 1</label>
                    <label class="btn btn-default" style="display:block" for="my-file-selector">
                        Upload File Here
                    </label>
                    <input name="uploadedfile" id="my-file-selector" type="file" style="display:none" />
                </div>

                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect2">Upload Question Audio 2</label>
                    <label class="btn btn-default" style="display:block" for="my-file-selector2">
                        Upload File Here
                    </label>
                    <input name="uploadedfile2" id="my-file-selector2" type="file" style="display:none" />
                </div>

                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect3">Upload Question Audio 3</label>
                    <label class="btn btn-default" style="display:block" for="my-file-selector3">
                        Upload File Here
                    </label>
                    <input name="uploadedfile3" id="my-file-selector3" type="file" style="display:none" />
                </div>


                <div class="form-group col-md-2">
                    <label for="upload-file-info">Question Audio File 1:</label>
                    <span class='label label-info' id="upload-file-info"></span><i id="delete1" class="glyphicon glyphicon-trash"
                        aria-hidden="true"></i>
                </div>

                <div class="form-group col-md-2">
                    <label for="upload-file-info2">Question Audio File 2:</label>
                    <span class='label label-info' id="upload-file-info2"></span><i id="delete2" class="glyphicon glyphicon-trash"
                        aria-hidden="true"></i>
                </div>

                <div class="form-group col-md-2">
                    <label for="upload-file-info3">Question Audio File 3:</label>
                    <span class='label label-info' id="upload-file-info3"></span><i id="delete3" class="glyphicon glyphicon-trash"
                        aria-hidden="true"></i>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="form-group col-md-4">
                    <label for="upload-file-info3">Question Picture File</label>
                    <input name="pic-input1" id="pic-input1" type='file' />
                </div>
                <div class="form-group col-md-4">
                    <img id="pic-input1-preview" style="text-align:center; vertical-align:middle; max-width:100px;  max-height:100px;"
                        src="#" alt="Picture 1" />
                </div>
                <div class="form-group col-md-4">
                    {{-- <input name="pic-input2" id="pic-input2" type='file' />
                    <img id="pic-input2-preview" style="text-align:center; vertical-align:middle; max-width:100px;  max-height:100px;"
                        src="#" alt="Picture 2" /> --}}
                </div>
                <div class="form-group col-md-4">
                    {{-- <input name="pic-input3" id="pic-input3" type='file' />
                    <img id="pic-input3-preview" style="text-align:center; vertical-align:middle; max-width:100px;  max-height:100px;"
                        src="#" alt="Picture 3" /> --}}
                </div>
            </div>

            {{-- Answer Audio --}}
            <div>
                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect1">Upload Answer Audio 1</label>
                    <label class="btn btn-default" style="display:block" for="answer-audio-file">
                        Upload File Here
                    </label>
                    <input name="answer-audio-file" id="answer-audio-file" type="file" style="display:none" />
                </div>

                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect2">Upload Answer Audio 2</label>
                    <label class="btn btn-default" style="display:block" for="answer-audio-file2">
                        Upload File Here
                    </label>
                    <input name="answer-audio-file2" id="answer-audio-file2" type="file" style="display:none" />
                </div>

                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect3">Upload Answer Audio 3</label>
                    <label class="btn btn-default" style="display:block" for="answer-audio-file3">
                        Upload File Here
                    </label>
                    <input name="answer-audio-file3" id="answer-audio-file3" type="file" style="display:none" />
                </div>


                <div class="form-group col-md-2">
                    <label for="answer-audio-file-info">Answer Audio File 1:</label>
                    <span class='label label-info' id="answer-audio-file-info"></span><i id="delete-answer1" class="glyphicon glyphicon-trash"
                        aria-hidden="true"></i>
                </div>

                <div class="form-group col-md-2">
                    <label for="answer-audio-file-info2">Answer Audio File 2:</label>
                    <span class='label label-info' id="answer-audio-file-info2"></span><i id="delete-answer2" class="glyphicon glyphicon-trash"
                        aria-hidden="true"></i>
                </div>

                <div class="form-group col-md-2">
                    <label for="answer-audio-file-info3">Answer Audio File 3:</label>
                    <span class='label label-info' id="answer-audio-file-info3"></span><i id="delete-answer3" class="glyphicon glyphicon-trash"
                        aria-hidden="true"></i>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-sm-3 col-md-3" style="padding: 0px">
                    <label for="select-group" style="color: lightgrey;">Categories</label>
                    <div class="select-group">
                        <select id="categories_primary" class="custom-select" size="12" onchange="showCategories(this.value)"
                            multiple>
                            <?php
                        include(app_path().'/includes/categories.php');
                  
                          // Sample:
                          // <option value="3">Three</option>
                          foreach ($categories_flip as $category_id) {
                            echo '<option value="' . $category_id . '">' . $categories[$category_id] . '</option>';
                          }
                          ?>
                        </select>
                    </div>
                </div>


                <div class="col-sm-4 col-md-4">
                    <label for="sortable1" style="color: lightgrey;">Secondary Categories</label>
                    <ul id="sortable1" class="connectedSortable">
                        <!-- <li class="ui-state-default">Item 5</li> -->
                    </ul>
                </div>

                <div class="col-sm-4 col-md-4">
                    <label for="sortable2">Your tag outputs</label>
                    <ul id="sortable2" class="connectedSortable">
                    </ul>
                </div>

                <div id="hidden_categories">
                </div>
            </div>





            <div class="form-group col-md-12" style="padding-right: 10px; margin:0;">
                <label for="keywords">Key Words</label>
                <input style="max-width: 800px;" type="text" name="keywords" class="form-control" id="keywords"
                    placeholder="Question Key Words ...">
            </div>


            <div>
                <div class="form-group col-md-8">
                    <label for="content">Answer Script</label>
                    <textarea name="content" class="form-control" id="content" rows="10"></textarea>
                    <div id="word-count"></div>
                </div>

                <div class="form-group col-md-4">
                    <label for="content">Comment</label>
                    <textarea name="comment" class="form-control" id="comment" rows="10"></textarea>
                </div>
            </div>

            <div class="row">
                <button id="back-button" class="btn btn-primary pull-left" type="button">Back</button>
                <button id="submit-button" class="btn btn-primary pull-right" type="submit">Submit</button>
            </div>

            <input type="hidden" id="wordCount" name="wordCount" value="0">

        </form>

        <div>
            <?php
        // var_dump($_POST);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // *****************************
          // ***** ADDING NEW RECORD *****
          // *****************************
        //   include_once('./model/rsClass.php');
        //   include_once('./AuxiliaryFunc.php');
    
          $currentQuestion = new rlClass ();
          $currentQuestion->currentID = null !== ReturnMaxID('rsinfo', 'RSID') ? ReturnMaxID('rsinfo', 'RSID')+1 : 1;
          $question_type = $currentQuestion->questionType;
          $currentQuestion->title = test_input($_POST["title"]);
          $currentQuestion->content = test_input($_POST["content"]); //answerscript
          $currentQuestion->isfrequent = isset($_POST["isfrequent"]) ? 1 : 0;
          $currentQuestion->isnew = isset($_POST["isnew"]) ? 1 : 0;
          $currentQuestion->isjj = isset($_POST["isjj"]) ? 1 : 0;
          $currentQuestion->difficulty = (int) $_POST["difficulty"];
          $currentQuestion->categories_array = isset($_POST["categories"]) ? $_POST["categories"] : null;
          $currentQuestion->categories = flatten_array($currentQuestion->categories_array);
          $currentQuestion->updatedate = $currentQuestion->publishdate =  date("Y-m-d H:i:s");
          $currentQuestion->comment = test_input($_POST["comment"]);
          $currentQuestion->keywords = $_POST["keywords"];
          $currentQuestion->inputUser = $session->get('userId');
        //   var_dump($session);
          $file_type = $_FILES['uploadedfile']['type'];
          $file_type2 = $_FILES['uploadedfile2']['type'];
          $file_type3 = $_FILES['uploadedfile3']['type'];

          $answer_audio_type = $_FILES['answer-audio-file']['type'];
          $answer_audio_type2 = $_FILES['answer-audio-file2']['type'];
          $answer_audio_type3 = $_FILES['answer-audio-file3']['type'];

          $pic1_type = $_FILES["pic-input1"]['type'];


          // generate file paths for Question Audio
          if (!empty($file_type)) {
            var_dump('1');
            $currentQuestion->questionAudioPath = generate_audio_path($question_type, $currentQuestion->currentID, $file_type);
          }
          if (!empty($file_type2)) {
            var_dump('2');
            $currentQuestion->questionAudioPath2 = generate_audio_path($question_type, $currentQuestion->currentID, $file_type2);
          }
          if (!empty($file_type3)) {
            var_dump('3');
            $currentQuestion->questionAudioPath3 = generate_audio_path($question_type, $currentQuestion->currentID, $file_type3);
          }
          // stick all the Question Audio path. COMMA
          $currentQuestion->questionAllPaths = allPathsGenerator($currentQuestion->questionAudioPath, $currentQuestion->questionAudioPath2, $currentQuestion->questionAudioPath3);

          // generate file paths for Question Audio
          if (!empty($answer_audio_type)) {
            var_dump('4');
            $currentQuestion->answerAudioPath = generate_audio_path($question_type, $currentQuestion->currentID, $answer_audio_type);
          }
          if (!empty($answer_audio_type2)) {
            var_dump('5');
            $currentQuestion->answerAudioPath2 = generate_audio_path($question_type, $currentQuestion->currentID, $answer_audio_type2);
          }
          if (!empty($answer_audio_type3)) {
            var_dump('6');
            $currentQuestion->answerAudioPath3 = generate_audio_path($question_type, $currentQuestion->currentID, $answer_audio_type3);
          }
          // stick all the Question Audio path. COMMA
          $currentQuestion->answerAllPaths = allPathsGenerator($currentQuestion->answerAudioPath, $currentQuestion->answerAudioPath2, $currentQuestion->answerAudioPath3);

          //   input Picture
          if (!empty($pic1_type)) {
            var_dump('7');
            $currentQuestion->picPath1 = generate_pic_path($question_type, $currentQuestion->currentID, $pic1_type);
          }
          $currentQuestion->picAllPaths = allPathsGenerator($currentQuestion->picPath1);

var_dump($file_type);
var_dump($file_type2);
var_dump($file_type3);
var_dump($answer_audio_type);
var_dump($answer_audio_type2);
var_dump($answer_audio_type3);
var_dump($pic1_type);

var_dump($currentQuestion);


    
          if (!CheckRedundant($currentQuestion->mainTableName, 'title', $currentQuestion->title)) {
            // insert the record to database
            $currentQuestion->insertMe();
            // transfer data to the standard location for question audio
            if (!empty($file_type)) { 
              move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $currentQuestion->questionAudioPath);
            }
            if (!empty($file_type2)) { 
              move_uploaded_file($_FILES['uploadedfile2']['tmp_name'], $currentQuestion->questionAudioPath2);
            }
            if (!empty($file_type3)) { 
              move_uploaded_file($_FILES['uploadedfile3']['tmp_name'], $currentQuestion->questionAudioPath3);
            }

            if (!empty($answer_audio_type)) { 
              move_uploaded_file($_FILES['answer-audio-file']['tmp_name'], $currentQuestion->answerAudioPath);
            }
            if (!empty($answer_audio_type2)) { 
              move_uploaded_file($_FILES['answer-audio-file2']['tmp_name'], $currentQuestion->answerAudioPath2);
            }

            if (!empty($answer_audio_type3)) { 
              move_uploaded_file($_FILES['answer-audio-file3']['tmp_name'], $currentQuestion->answerAudioPath3);
            }

            if (!empty($pic1_type)) {
              move_uploaded_file($_FILES['pic-input1']['tmp_name'], $currentQuestion->picPath1);
            }
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("New record has submitted, cheers!");});</script>';
            echo '<script type="text/javascript">alert("One new record has been added, cheers!");</script>';
          } else {
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.error("Duplicated records have found, submittion fails!");});</script>';
            echo '<script type="text/javascript">alert("Same Record has found.");</script>';
          }
    
        }
        ?>
        </div>

    </section>

</div>

@endsection

@section('additional_js')
<!-- jQuery -->
{{-- <script src="{{ asset('library/jquery-validation-1.14.0/lib/jquery.js') }}"></script> --}}
{{--
<!-- <script src="/library/jquery/dist/jquery.min.js"></script> --> --}}
<!-- jQuery-UI -->
{{-- <script src="{{ asset('library/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Boostrap 3.3.7 -->
{{-- <script src="{{ asset('library/bootstrap-3.3.7/dist/js/bootstrap.min.js') }}"></script> --}}
<!-- Self Sourced -->
{{-- <script src="{{ asset('js/index.js') }}"></script> --}}
<!-- Actions -- Self-sourced -->
<script src="{{ asset('js/question_form_actions.js') }}"></script>
<script src="{{ asset('js/rars_form.js') }}"></script>

@endsection