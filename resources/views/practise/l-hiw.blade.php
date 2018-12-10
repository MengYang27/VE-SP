@extends('layouts.main')
@php
$Question = json_decode($Question_Object, true);
@endphp

@section('extra-metas')
<meta id='audio_src' content="{{ URL::to('/').$Question['Audio']['Src'] }}">
@endsection

@section('content')
<!-- Main content -->
<section class="content">

    <div class="row">
        <!-- .row  -->
        <div class="col-xs-12">
            <!-- .col-xs-12  -->
            <div class="box box-warning">
                <!-- .box -->

                <div class="box-header with-border">
                    <!-- box-header -->
                    <h3 class="box-title">Preparation</h3>
                    <table class="pull-right">
                        <tr>
                            @foreach ($Question['Tags'] as $tag => $tag_class)
                            <td>
                                <div class="{{ $tag_class }}">
                                    {{ $tag }}
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
                <!--./box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Play Question</h4>

                            <div class="row is-table-row">
                                <div id="question-play-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a class="btn btn-app"><i
                                            class="fa fa-play"></i> Play</a></div>
                                <div id="question-step-backward-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a
                                        class="btn btn-app"><i class="fa fa-step-backward"></i> Reset</a></div>
                                <div class="hidden-xs hidden-sm hidden-md col-lg-1"></div>
                                <div id="question-audio-play" class="hidden-xs col-sm-6 col-md-6 col-lg-7"></div>
                                <div id="question-tracktime" class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="margin-top:20px"></div>
                            </div>
                            <!-- ./row -->


                            <div class="row">
                                <!-- .row -->
                                <div class="col-xs-12">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <i class="fa fa-tasks"></i>

                                            <h3 class="box-title">Click on incorrect words to highlight them.</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class='hiw-question'>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>

                            </div>
                            <!-- ./row -->

                            <div id="answer" class="row" style="display: none;">
                                <div class="col-md-3 col-sm-6 col-xs-12">

                                    <div class="info-box">
                                        <span class="info-box-icon bg-red"><i class="fa fa-trophy"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Score</span>
                                            <span class="info-box-number">4/6</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                            </div>
                            <!-- ./row -->


                            <div class="row">
                                <!-- .row -->
                                <div class="col-xs-12">
                                    <div class="btn-toolbar">
                                        <button type="button" class="btn btn-success" onclick="checkButton()">Check</button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.reload()">Redo</button>
                                    </div>
                                </div>
                            </div>
                            <!-- ./row -->

                            <div class="pull-left">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-menu-left">
                                </button>
                            </div>

                            <div class="pull-right">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-menu-right">
                                </button>
                            </div>

                        </div>
                        <!-- ./box-body -->

                    </div>
                    <!-- ./box -->
                </div>
                <!-- ./col-xs-12  -->

            </div>
            <!-- ./row -->


</section>
<!-- /.content -->
@endsection

@section('extra-scripts')
{{ HTML::script('js/wavesurfer.js') }}
{{ HTML::script('js/audio_shared_functions.js') }}
{{ HTML::script('js/recorder.js') }}
{{ HTML::script('js/question_audio_play.js') }}
{{ HTML::script('js/audio_record.js') }}
{{ HTML::script('js/hiw_question.js') }}
{{ HTML::script('js/timer.js') }}
@endsection