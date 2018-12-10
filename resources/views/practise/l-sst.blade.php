@extends('layouts.main')
@php
$Question = json_decode($Question_Object, true);
@endphp

@section('extra-styles')
<style>
    textarea {
        background-color: white;
        border: 1px solid grey;
    }
</style>
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
                            <p class="paragraph">
                                You will hear a short lecture. Write a summary for a fellow student who was not present
                                at the lecture. You should write 50-70 words. You have 10 minutes to finish this task.
                                Your response will be judged on the Quality of Your writing and on how well your
                                response presents the key points presented in the lecture.
                            </p>
                            <audio src="{{ $Question['Audio']['Src'] }}" controls="controls" type="{{ $Question['Audio']['Format'] }}"></audio>
                        </div>
                    </div>
                    <!-- ./row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="sst-answer">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <textarea rows="10" cols="150" placeholder="Input your answer here!"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-warning btn-sm">Submit Answer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
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
                                    <div class="col-xs-10">
                                        <h5>Sample Answer</h5>
                                        <p class="paragraph">
                                            {{ $Question['Answer'] }}
                                        </p>
                                        <h5>Transcript</h5>
                                        <p class="paragraph">
                                            {{ $Question['Transcript'] }}
                                        </p>
                                    </div>
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
                    <!-- ./box-body -->
                    <!-- ./box -->
                </div>
                <!-- ./col-xs-12  -->
            </div>
        </div>
    </div>
    <!-- ./row -->
</section>
<!-- /.content -->
@endsection

@section('extra-scripts')
{{ HTML::script('js/timer.js') }}
@endsection