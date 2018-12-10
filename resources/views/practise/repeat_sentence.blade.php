@extends('layouts.main')
@php
$Question = json_decode($Question_Object, true);
@endphp

@section('extra-metas')
<meta id='audio_src' content="{{ URL::to('/').$Question['Audio']['Src'] }}">
@endsection

@section('extra-styles')
{{ HTML::style('css/simple-audio-player.css') }}
{{ HTML::style('css/checkbox.css') }}
{{ HTML::style('css/table.css') }}
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
                    <h3 class="box-title">{{ $Question['Title'] }}</h3>
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
                            <h5>Play Question</h5>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="progress progress-xxs">
                                        <div id="timer" class="progress-bar progress-bar-danger" style="width: 0%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row is-table-row">
                                <div id="question-play-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a class="btn btn-app"><i
                                            class="fa fa-play"></i> Play</a></div>
                                <div id="question-step-backward-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a
                                        class="btn btn-app"><i class="fa fa-step-backward"></i> Reset</a></div>
                                <div class="hidden-xs hidden-sm hidden-md col-lg-1"></div>
                                <div id="question-audio-play" class="hidden-xs col-sm-6 col-md-6 col-lg-7"></div>
                                <div id="question-tracktime" class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="margin-top:20px"></div>
                            </div>

                        </div>
                        <!-- ./col-xs-12 -->
                    </div>
                    <!-- ./row -->


                    <div class="row">
                        <div class="col-xs-12">
                            <h5>Record</h5>
                            <div class="row is-table-row">
                                <div id="record-play-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a class="btn btn-app"><i
                                            class="fa fa-play"></i> Play</a></div>
                                <div id="record-step-backward-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a
                                        class="btn btn-app"><i class="fa fa-step-backward"></i> Rsest</a></div>
                                <div class="hidden-xs hidden-sm hidden-md col-lg-1"></div>
                                <div id="record-audio-play" class="hidden-xs col-sm-6 col-md-6 col-lg-7"></div>
                                <div id="record-tracktime" class="col-xs-4 col-sm-2 col-md-2 col-lg-2" style="margin-top:20px"></div>
                            </div>
                        </div>
                        <!-- ./col-xs-12 -->
                    </div>
                    <!-- ./row -->

                    <div class="row form-group">
                        <!-- .row -->
                        <div class="col-xs-3">
                        </div>
                        <div class="col-xs-8">
                            <button class="col-xs-4 col-sm-3 col-md-4 col-lg-3 btn" id="record-button" onclick="startRecording(this, 'repeat_sentence');">record</button>
                            <span class="col-xs-1"></span>
                            <button class="col-xs-4 col-sm-3 col-md-4 col-lg-3 btn" id="stop-button" onclick="stopRecording(this);"
                                disabled>stop</button>
                        </div>
                        <div class="col-xs-1">
                        </div>
                    </div>
                    <!-- ./row -->

                    <div class="row">
                        <!-- .row -->
                        <div class="col-xs-12">

                            <div class="box collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Question Answer</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                            Press Me To See >>>>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body" style="">
                                    <div class="col-xs-10">{{ $Question['Transcript'] }}</div>
                                </div>
                                <!-- /.box-body -->
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
{{ HTML::script('js/timer.js') }}
@endsection