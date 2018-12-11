@extends('layouts.questionmgtLayout')

@section('additional_css')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    // var_dump($_GET);
    if(isset($_GET["updates"]) && $_GET["updates"] == '1') {
      echo '<script type="text/javascript">alert("The record has been updated, cheers");</script>';
      echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("The record has been updated, cheers!");});</script>';
    }
    
    // var_dump($session);
    $id               = $session->get('userId');
    $questionmgt_root = resource_path() . '/' . 'questionmgt/';
    // var_dump($id);
    // var_dump($questionmgt_root);
    // require($questionmgt_root.'prac_table_data.php');
    // $resource_path = resource_path() . '/' . 

  ?>

  <section class="content container-fluid">

    <?php
  // notification for after updating a record.
  if(isset($_GET["updates"]) && $_GET["updates"] == '1') {
  echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {toastr.success("The record has been updated, cheers!");});</script>';
  }
?>

    <div id="toolbar">
      <button id="remove" class="btn btn-danger" disabled>
        <i class="glyphicon glyphicon-remove"></i> Delete
      </button>
      <button id="addnew" class="btn btn-success">
        <i class="glyphicon glyphicon-plus"></i> NEW
      </button>
      <div class="btn-group">
        <button id="dropdown-selected" type="button" class="btn btn-default">Read Aloud</button>
        {{-- <button id="dropdown-toggle" type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span --}}
        {{-- <button id="dropdown-toggle" type="button"  class="btn btn-default "></button>
        <ul class="dropdown-menu">
          <li><a href="#">Read Aloud</a></li>
          <li><a href="#">Repeat Sentence</a></li>
          <li class="divider"></li>
        </ul> --}}
      </div>
    </div>

    <table id="table" data-search="true" data-pagination="true" data-url="/questionmgt/questiondata" data-toolbar="#toolbar"
      data-show-pagination-switch="true" data-show-refresh="true" data-show-columns="true" data-minimum-count-columns="2"
      data-page-size="15" data-page-list="[15, 25, 50, 100, 200, ALL]">
    </table>





    <div class="modal fade" id="deleteWarning" tabindex="-1" role="dialog" aria-labelledby="deleteWarning" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Deletion Confirmation</h4>
          </div>
          <div class="modal-body">
            <h3 class="text-danger">Are you sure about delete these records?</h3>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="confirm_deletion" type="button" class="btn btn-primary">OK</button>
          </div>
        </div>
      </div>
    </div>

    <div id="test"><?php #var_dump($_GET); ?></div>
  </div>


</section>
{{-- .content --}}

</div>





<div class="modal fade" id="deleteWarning" tabindex="-1" role="dialog" aria-labelledby="deleteWarning" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Deletion Confirmation</h4>
      </div>
      <div class="modal-body">
        <h3 class="text-danger">Are you sure about delete these records?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="confirm_deletion" type="button" class="btn btn-primary">OK</button>
      </div>
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
<script src="{{ asset('js/questionmgt_index.js') }}"></script>

@endsection
