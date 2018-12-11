<?php
  use App\Http\Model\rsClass;
  // use functiion App\Http\AuxiliaryFunc\ReturnMaxID;
  // include
  // use App\AuxiliaryFunc;

?>

<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'AuxiliaryFunc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'DatabaseFunc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'model/raClass.php';

$_id = "";
if (isset($_GET['qid'])) {
    $_id = $_GET['qid'];  // in this case we enter this page from the table page.
} else {
    $_id = $_POST['currentID'];
}

$infoFromDB = SelectSigleRow('rsinfo','rsid', $_id);
// var_dump($infoFromDB);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // *****************************
  // ***** ADDING NEW RECORD *****
  // *****************************
  // var_dump($_POST);
  // var_dump($_FILES);
  $currentQuestion = new rsClass ();
  $question_type = $currentQuestion->questionType;
  $currentQuestion->currentID = $_id;
  $currentQuestion->title = test_input($_POST["title"]);
  $currentQuestion->content = test_input($_POST["content"]);
  $currentQuestion->isfrequent = isset($_POST["isfrequent"]) ? 1 : 0;
  $currentQuestion->isnew = isset($_POST["isnew"]) ? 1 : 0;
  $currentQuestion->isjj = isset($_POST["isjj"]) ? 1 : 0;
  $currentQuestion->difficulty = (int) $_POST["difficulty"];
  $currentQuestion->categories_array = isset($_POST["categories"]) ? $_POST["categories"] : null;
  $currentQuestion->categories = flatten_array($currentQuestion->categories_array);
  $currentQuestion->updatedate = date("Y-m-d H:i:s");
  $currentQuestion->publishdate = isset($_POST["publishDate"]) ? $_POST["publishDate"] : date("Y-m-d H:i:s"); 
  $currentQuestion->comment = test_input($_POST["comment"]);
  $currentQuestion->sampleAnswerAudioPath = $_POST['sampleAnswerAudioPath'];
  $currentQuestion->sampleAnswerAudioPath2 = $_POST['sampleAnswerAudioPath2'];
  $currentQuestion->sampleAnswerAudioPath3 = $_POST['sampleAnswerAudioPath3'];
  $currentQuestion->wordCount = $_POST["wordCount"];
  $currentQuestion->inputUser = $session->get('userId');
  $audioPaths_array = string_to_array(",", $infoFromDB[0][13]);
  // var_dump($audioPaths_array);
//   var_dump($_POST);
//   var_dump($currentQuestion->sampleAnswerAudioPath);
//   var_dump($currentQuestion->sampleAnswerAudioPath);
//   var_dump($currentQuestion->sampleAnswerAudioPath);

  if (array_key_exists(0, $audioPaths_array) && $audioPaths_array[0] !== '' && $currentQuestion->sampleAnswerAudioPath == '') { unlink($audioPaths_array[0]); }
  if (array_key_exists(1, $audioPaths_array) &&  $audioPaths_array[1] !== '' && $currentQuestion->sampleAnswerAudioPath2 == '') { unlink($audioPaths_array[1]); }
  if (array_key_exists(2, $audioPaths_array) &&  $audioPaths_array[2] !== '' && $currentQuestion->sampleAnswerAudioPath3 == '') { unlink($audioPaths_array[2]); }

  $currentQuestion->sampleAnswerAudioPath = updateFiles($currentQuestion->currentID, 'uploadedfile', $currentQuestion->sampleAnswerAudioPath, $question_type);
  $currentQuestion->sampleAnswerAudioPath2 = updateFiles($currentQuestion->currentID, 'uploadedfile2', $currentQuestion->sampleAnswerAudioPath2, $question_type);
  $currentQuestion->sampleAnswerAudioPath3 = updateFiles($currentQuestion->currentID, 'uploadedfile3', $currentQuestion->sampleAnswerAudioPath3, $question_type);
  $currentQuestion->audioPaths = allPathsGenerator($currentQuestion->sampleAnswerAudioPath, $currentQuestion->sampleAnswerAudioPath2, $currentQuestion->sampleAnswerAudioPath3);
  $currentQuestion->updateMe();

  // var_dump($currentQuestion);

//   // // for debugging please comment out the header and exit lines.
  header('content-type:text/html;charset=uft-8');
  // 重定向页面
  header('location:/questionmgt/speaking?updates=1&rid=2');
  exit();
}

?>


<?php
$currentQuestion = new rsClass ();
$currentQuestion->currentID = $_id;
$currentQuestion->title = $infoFromDB[0][1];
$currentQuestion->isfrequent = $infoFromDB[0][2];
$currentQuestion->difficulty = $infoFromDB[0][3];
$currentQuestion->isnew = $infoFromDB[0][4];
$currentQuestion->isjj = $infoFromDB[0][5];
$currentQuestion->publishdate = $infoFromDB[0][6];
$currentQuestion->updatedate = date("Y-m-d H:i:s");
$currentQuestion->content = $infoFromDB[0][17];
$currentQuestion->comment = $infoFromDB[0][19];
$currentQuestion->categories = $infoFromDB[0][8];
$currentQuestion->categories_array = string_to_array(",", $currentQuestion->categories);
$currentQuestion->audioPaths = $infoFromDB[0][13];
$currentQuestion->wordCount = $infoFromDB[0][18];
$currentQuestion->inputUser = $session->get('userId');
// var_dump($currentQuestion->audioPaths);
$audioPaths_array = string_to_array(",", $currentQuestion->audioPaths);
$currentQuestion->sampleAnswerAudioPath = array_key_exists(0, $audioPaths_array) ? $audioPaths_array[0] : '';
$currentQuestion->sampleAnswerAudioPath2 = array_key_exists(1, $audioPaths_array) ? $audioPaths_array[1] : '';
$currentQuestion->sampleAnswerAudioPath3 = array_key_exists(2, $audioPaths_array) ? $audioPaths_array[2] : '';
// var_dump($currentQuestion->sampleAnswerAudioPath );
// var_dump($currentQuestion->sampleAnswerAudioPath2 );
// var_dump($currentQuestion->sampleAnswerAudioPath3 );
// echo(array_key_exists(0, $audioPaths_array));
// echo(array_key_exists(1, $audioPaths_array));
// echo(array_key_exists(2, $audioPaths_array));
// var_dump($_POST);
// var_dump($infoFromDB);
// echo "<br/>"."question"."<br/>";
// var_dump($currentQuestion);

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
    // echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("The record has been updated, cheers!");});</script>';
    // }
    
    // var_dump($session);
    $id = $session->get('userId');
    $questionmgt_root = resource_path() . '/' . 'questionmgt/';
    // var_dump($id);
    // var_dump(resource_path());
    // var_dump($questionmgt_root);
    // require($questionmgt_root.'prac_table_data.php');
    // $resource_path = resource_path() . '/' . 

    // var_dump($_POST);
  ?>

    <section class="content container-fluid">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#">Velocity English - Repeat Sentence</a></li>
                <!-- <li role="presentation"><a href="#"></a></li> -->
            </ul>
            <!-- The content of the document...... -->
            <form id="form" method="post" action="{{ url('/questionmgt/speaking/rs_update') }}" enctype="multipart/form-data"
                onkeydown="if(event.target.nodeName !== 'TEXTAREA' &&
            event.keyCode==13){return false;}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- <div class="alert alert-info" id="alertboard" role="alert">Velocity English - Read Aloud</div> -->
                </div>
                <div  style="min-height: 135px;">
                    <div class="form-group col-md-6" style="padding-right: 10px; margin:0;">
                        <label for="title">Title</label>
                        <input style="max-width: 400px;" type="text" name="title" class="form-control" id="title"
                            placeholder="Question Title ..." value="<?php echo $currentQuestion->title; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label class="form-check-label" for="isfrequent">
                            Frequent
                        </label>
                        <input name="isfrequent" class="form-check-input" type="checkbox" value="1" id="isfrequent"
                            <?php echo ($currentQuestion->isfrequent !== '0' ? 'checked' : ''); ?> >
                    </div>

                    <div class="form-group col-md-2">
                        <label class="form-check-label" for="isnew">
                            New
                        </label>
                        <input name="isnew" class="form-check-input" type="checkbox" value="1" id="isnew" <?php echo
                            ($currentQuestion->isnew !== '0' ? 'checked' : ''); ?> >
                    </div>

                    <div class="form-group col-md-2">
                        <label class="form-check-label" for="isjj">
                            Is JiJing
                        </label>
                        <input name="isjj" class="form-check-input" type="checkbox" value="1" id="isjj" <?php echo
                            ($currentQuestion->isjj !== '0' ? 'checked' : ''); ?> >
                    </div>


                    <div class="form-group col-md-2">
                        <label for="difficulty">Difficulty</label>
                        <select name="difficulty" class="form-control" id="difficulty">
                            <option value="0" <?php echo ($currentQuestion->difficulty == '0' ? 'selected' : ''); ?>>No
                                Input</option>
                            <option value="1" <?php echo ($currentQuestion->difficulty == '1' ? 'selected' : '');
                                ?>>Very
                                Easy</option>
                            <option value="2" <?php echo ($currentQuestion->difficulty == '2' ? 'selected' : '');
                                ?>>Easy</option>
                            <option value="3" <?php echo ($currentQuestion->difficulty == '3' ? 'selected' : '');
                                ?>>Medium</option>
                            <option value="4" <?php echo ($currentQuestion->difficulty == '4' ? 'selected' : '');
                                ?>>Hard</option>
                            <option value="5" <?php echo ($currentQuestion->difficulty == '5' ? 'selected' : '');
                                ?>>Very
                                Hard</option>
                        </select>
                    </div>
                    <!-- .row -->
                </div>

                <div >
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
                        <span class='label label-info' id="upload-file-info">
                            <?php echo '' !== $currentQuestion->sampleAnswerAudioPath ? extractDateFromFN($currentQuestion->sampleAnswerAudioPath).' Uploaded' : null; ?></span><i
                            id="delete1" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="upload-file-info2">Question Audio File 2:</label>
                        <span class='label label-info' id="upload-file-info2">
                            <?php echo '' !== $currentQuestion->sampleAnswerAudioPath2 ? extractDateFromFN($currentQuestion->sampleAnswerAudioPath2).' Uploaded' : null; ?></span><i
                            id="delete2" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="upload-file-info3">Question Audio File 3:</label>
                        <span class='label label-info' id="upload-file-info3">
                            <?php echo '' !== $currentQuestion->sampleAnswerAudioPath3 ? extractDateFromFN($currentQuestion->sampleAnswerAudioPath3).' Uploaded' : null; ?></span><i
                            id="delete3" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="form-group col-md-12">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                          <audio controls="controls">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath)}}" type="audio/mp3">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath)}}" type="audio/m4a">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath)}}" type="audio/wav">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath)}}" type="audio/ogg">
                            Your browser does not support the audio element.
                          </audio>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                          <audio controls="controls">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath2)}}" type="audio/mp3">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath2)}}" type="audio/m4a">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath2)}}" type="audio/mav">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath2)}}" type="audio/ogg">
                            Your browser does not support the audio element.
                          </audio>
                        </div>
                
                        <div class="col-sm-4 col-md-4 col-lg-4">
                          <audio controls="controls">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath3)}}" type="audio/mp3">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath3)}}" type="audio/m4a">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath3)}}" type="audio/wav">
                            <source src="{{asset($currentQuestion->sampleAnswerAudioPath3)}}" type="audio/ogg">
                            Your browser does not support the audio element.
                          </audio>
                        </div>
                      </div>

                <div id="hidden_categories"></div>
                <input type="hidden" name="publishDate" value="<?php echo $currentQuestion->publishdate; ?>" />
                <input type="hidden" name="currentID" value="<?php echo $currentQuestion->currentID; ?>" />
                <input type="hidden" id="sampleAnswerAudioPath" name="sampleAnswerAudioPath" value="<?php echo $currentQuestion->sampleAnswerAudioPath; ?>" />
                <input type="hidden" id="sampleAnswerAudioPath2" name="sampleAnswerAudioPath2" value="<?php echo $currentQuestion->sampleAnswerAudioPath2; ?>" />
                <input type="hidden" id="sampleAnswerAudioPath3" name="sampleAnswerAudioPath3" value="<?php echo $currentQuestion->sampleAnswerAudioPath3; ?>" />

                <div >
                    <div class="form-group col-md-8">
                        <label for="content">Answer Script</label>
                        <textarea name="content" class="form-control" id="content" rows="10"><?php echo $currentQuestion->content; ?></textarea>
                        <div id="word-count"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="content">Comment</label>
                        <textarea name="comment" class="form-control" id="comment" rows="10"><?php echo $currentQuestion->comment; ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <button id="back-button" class="btn btn-primary pull-left" type="button">Back</button>
                    <?php if (!isset($_GET['view'])) {echo '<button id="submit-button" class="btn btn-primary pull-right" type="submit">Submit</button>';} ?>
                </div>

                <input type="hidden" id="wordCount" name="wordCount" value="0">
            </form>
    </section>
    {{-- content --}}

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