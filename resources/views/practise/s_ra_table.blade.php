@extends('layouts.practiseLayout')
@section('content')
@include('adminmenu')
@section('extra-metas')
<meta id='audio_src' content="{{ URL::to('/').$question['Audio']['Src'] }}">
@endsection

@section('extra-styles')
<link type="text/css" rel="stylesheet" href="css/simple-audio-player.css">
<link type="text/css" rel="stylesheet" href="css/checkbox.css">
<link type="text/css" rel="stylesheet" href="css/table.css">
@endsection

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Speaking
            <small>Read Aloud</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/studentboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Speaking</li>
            <li class="active">Read Aloud</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        @if(Session::has('message'))

        <!-- Message box to message for any event -->
        <div class="row">
            <!-- First Box -->
            <div class="col-md-12">
                <!-- Message box to message for any event -->
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Event Message !!</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{Session::get('message')}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- Message box to message for any event -->
            </div>
        </div>
        <!-- Message box to message for any event -->

        @endif

        <!-- Executional HTML -->

        <div class="row">
            <!-- .row  -->
            <div class="col-xs-12">
                <!-- .col-xs-12  -->
                <div class="box box-warning">
                    <!-- .box -->
                    <div class="box-header with-border">
                        <!-- box-header -->
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!--./box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">Question</th>
                                                <!-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th>-->
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr onclick="location.href = './read_aloud_question.html';" role="row"
                                                class="odd">
                                                <td width="10%" nclass="sorting_1">1</td>
                                                <td>
                                                    Don't forget to do a library tour on the first week of your
                                                    semester.
                                                </td>
                                            </tr>

                                            <tr role="row" class="even">
                                                <td width="10%" nclass="sorting_1">2</td>
                                                <td>
                                                    The Africa elephant is the largest land mammal in the world.
                                                </td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td width="10%" nclass="sorting_1">3</td>
                                                <td>Acupuncture is a technique involved in traditional Chinese
                                                    medicine.</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td width="10%" nclass="sorting_1">4</td>
                                                <td>...</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td width="10%" nclass="sorting_1">5</td>
                                                <td>...</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td width="10%" nclass="sorting_1">6</td>
                                                <td>...</td>

                                            </tr>
                                            <tr role="row" class="odd">
                                                <td width="10%" nclass="sorting_1">7</td>
                                                <td>...</td>

                                            </tr>
                                            <tr role="row" class="even">
                                                <td width="10%" nclass="sorting_1">8</td>
                                                <td>...</td>

                                            </tr>
                                            <tr role="row" class="odd">
                                                <td width="10%" nclass="sorting_1">9</td>
                                                <td>...</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td width="10%" nclass="sorting_1">10</td>
                                                <td>...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing
                                        1 to 10 of 57 entries</div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" id="example2_previous">
                                                <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                                            </li>
                                            <li class="paginate_button active">
                                                <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a>
                                            </li>
                                            <li class="paginate_button next" id="example2_next">
                                                <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col-xs-12  -->
                    </div>
                </div>
            </div>
            <!-- ./row -->
    </section>
</div>
<!-- /.content -->
@endsection

@section('extra-scripts')
<script type="text/javascript" src="js/wavesurfer.js"></script>
<script type="text/javascript" src="js/audio_shared_functions.js"></script>
<script type="text/javascript" src="js/recorder.js"></script>
<script type="text/javascript" src="js/question_audio_play.js"></script>
<script type="text/javascript" src="js/audio_record.js"></script>
<script type="text/javascript" src="js/timer.js"></script>
@endsection