@extends('layouts.main')
@php
$Question = json_decode($Question_Object, true);
@endphp

@section('extra-styles')
{{ HTML::style('css/rp.css') }}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- .row  -->
        <div class="col-xs-12">
            <!-- .col-xs-12  -->
            <div class="box">
                <!-- .box -->
                <div class="box-header with-border">
                    <!-- box-header -->
                    <h3 class="box-title">{{ $Question['ID'] }}--{{ $Question['Title']}}</h3>
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
                            <h5>The text boxes in the left panel have been placed in a random order. Restore the
                                original order by dragging the boxes from the left panel to right panel.</h5>
                        </div>
                    </div>
                    <!-- ./row -->

                    <div class="row">
                        <div class="col-xs-12 row-eq-height">
                            <div class="col-xs-5 thumbnail">
                                <ul id="left-sortable" class="list-group connectedSortable">
                                    @foreach ($Question['Options'] as $opt)
                                    <li class="list-group-item">{{ $opt }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-xs-1">
                                <input type="button" name="reset" value="RESET" />
                                <span class="glyphicon glyphicon-random center-block"></span>
                            </div>

                            <div class="col-xs-5 thumbnail">
                                <ul id="right-sortable" class="list-group connectedSortable">
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- ./row -->

                    <div class="row form-group">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-success" onclick="doneButton()">Done</button>
                            <div class="btn-group-horizontal pull-right">
                                <button type="button" class="btn btn-danger">Redo</button>
                                <button type="button" class="btn btn-info">Pronouns</button>
                                <button type="button" class="btn btn-info">Logical Connecotrs</button>
                                <button type="button" class="btn btn-info">Definite Article</button>
                            </div>
                        </div>
                    </div>
                    <!-- ./row -->

                    <div id="answer" style="display: none;">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 100px">Pairs</th>
                                            <th>Explanation</th>
                                        </tr>
                                        <tr>
                                            <td class="right-answer">DA</td>
                                            <td>Update software</td>

                                        </tr>
                                        <tr>
                                            <td class="wrong-answer">AC</td>
                                            <td>Clean database</td>
                                        </tr>
                                        <tr>
                                            <td class="wrong-answer">CE</td>
                                            <td>Cron job running</td>
                                        </tr>
                                        <tr>
                                            <td class="wrong-answer">EB</td>
                                            <td>Fix and squish bugs</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ./col-xs-12 -->
                        </div>
                        <!-- ./row -->

                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-trophy"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Score</span>
                                        <span class="info-box-number">1/5</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                        <!-- ./row -->
                    </div>


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-menu-left">
                                </button>
                            </div>

                            <div class="pull-right">
                                <button type="button" class="btn btn-warning glyphicon glyphicon-menu-right">
                                </button>
                            </div>
                        </div>
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
{{ HTML::script('js/reorder_paragraph.js') }}
<script>
    function doneButton() {
        document.getElementById("answer").style.display = "block";
    }
</script>
@endsection