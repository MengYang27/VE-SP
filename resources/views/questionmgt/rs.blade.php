<?php
  use App\Http\Model\rsClass;
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
    if(isset($_GET["updates"]) && $_GET["updates"] == '1') {
      echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("The record has been updated, cheers!");});</script>';
      echo '<script type="text/javascript">alert("One new record has been added, cheers!");</script>';
    }
    ?>

    <div class="content">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">Velocity English - Repeat Sentence</a></li>
            <!-- <li role="presentation"><a href="#"></a></li> -->
        </ul>
        <!-- The content of the document...... -->
        <form id="form" method="post" action="{{ url('/questionmgt/speaking/rs?updates=1') }}" enctype="multipart/form-data"
            onkeydown="if(event.target.nodeName !== 'TEXTAREA' &&
            event.keyCode==13){return
            false;}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- <div class="alert alert-info" id="alertboard" role="alert">Velocity English - Read Aloud</div> -->
            </div>
            <div class="row" style="min-height: 135px;">
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

            <div class="row">
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


            <div class="row">
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

        <div class="row">
            <?php
        // var_dump($_POST);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // *****************************
          // ***** ADDING NEW RECORD *****
          // *****************************
        //   include_once('./model/rsClass.php');
        //   include_once('./AuxiliaryFunc.php');
    
          $currentQuestion = new rsClass ();
          $currentQuestion->currentID = null !== ReturnMaxID('rsinfo', 'RSID') ? ReturnMaxID('rsinfo', 'RSID')+1 : 1;
          $question_type = $currentQuestion->questionType;
          $currentQuestion->title = test_input($_POST["title"]);
          $currentQuestion->content = test_input($_POST["content"]);
          $currentQuestion->isfrequent = isset($_POST["isfrequent"]) ? 1 : 0;
          $currentQuestion->isnew = isset($_POST["isnew"]) ? 1 : 0;
          $currentQuestion->isjj = isset($_POST["isjj"]) ? 1 : 0;
          $currentQuestion->difficulty = (int) $_POST["difficulty"];
          $currentQuestion->categories_array = isset($_POST["categories"]) ? $_POST["categories"] : null;
          $currentQuestion->categories = flatten_array($currentQuestion->categories_array);
          $currentQuestion->updatedate = $currentQuestion->publishdate =  date("Y-m-d H:i:s");
          $currentQuestion->comment = test_input($_POST["comment"]);
          $currentQuestion->wordCount = $_POST["wordCount"];
          $currentQuestion->inputUser = $session->get('userId');
        //   var_dump($session);
          $file_type = $_FILES['uploadedfile']['type'];
          $file_type2 = $_FILES['uploadedfile2']['type'];
          $file_type3 = $_FILES['uploadedfile3']['type'];
        //   var_dump($currentQuestion->wordCount);



          // generate file paths.
          if (!empty($file_type)) {
            $currentQuestion->sampleAnswerAudioPath = generate_audio_path($question_type, $currentQuestion->currentID, $file_type);
          }
          if (!empty($file_type2)) {
            $currentQuestion->sampleAnswerAudioPath2 = generate_audio_path($question_type, $currentQuestion->currentID, $file_type2);
          }
          if (!empty($file_type3)) {
            $currentQuestion->sampleAnswerAudioPath3 = generate_audio_path($question_type, $currentQuestion->currentID, $file_type3);
          }
          // stick all the Audio path. COMMA
          $currentQuestion->allPaths = allPathsGenerator($currentQuestion->sampleAnswerAudioPath, $currentQuestion->sampleAnswerAudioPath2, $currentQuestion->sampleAnswerAudioPath3);
    
          // debugging & testing script.
        //   var_dump($currentQuestion);
          // var_dump($_POST);
    
        //   include_once 'DatabaseFunc.php';
          if (!CheckRedundant($currentQuestion->mainTableName, 'title', $currentQuestion->title)) {
            // insert the record to database
            $currentQuestion->insertMe();
            // transfer data to the standard location
            if (!empty($file_type)) { 
                move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $currentQuestion->sampleAnswerAudioPath);
            }
            if (!empty($file_type2)) { 
              move_uploaded_file($_FILES['uploadedfile2']['tmp_name'], $currentQuestion->sampleAnswerAudioPath2);
            }
            if (!empty($file_type3)) { 
              move_uploaded_file($_FILES['uploadedfile3']['tmp_name'], $currentQuestion->sampleAnswerAudioPath3);
            }
    
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("New record has submitted, cheers!");});</script>';
          } else {
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.error("Duplicated records have found, submittion fails!");});</script>';
          }
    
        }
        ?>
        </div>

    </div>

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