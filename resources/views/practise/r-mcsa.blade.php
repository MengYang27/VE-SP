@extends('layouts.main')
@php
$Question = json_decode($Question_Object, true);
@endphp

@section('extra-styles')
{{ HTML::style('css/simple-audio-player.css') }}
{{ HTML::style('css/checkbox.css') }}
{{ HTML::style('css/table.css') }}
@endsection

<!-- Main content -->
@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="box">
            <!--  Timer Progress Section Start  -->
            <div id="timer_bar"></div>
            <!--  Timer Progress Section End  -->
            <div class="box-header with-border">
                <div class="col-md-6" style="width:100% !important;">
                    <!-- ***MCMAl Start*** -->
                    <div id="dynamic-content">
                        <h3 class="title">{{ $Question['Title'] }}</h3>
                        <h4>{{ $Question['Subtitle'] }}</h4>
                        <!-- tag Class Section -->
                        <div>
                            <table class="tag">
                                <tr>
                                    @foreach ($Question['Tags'] as $tag)
                                    <td class="tag stop_select" onclick="click_tag(this)">{{ $tag }}</td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                        <!--  Textarea Section Start  -->
                        <div>
                            <!--  Textarea and Timer Row Start  -->
                            <div class="row">
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td id="readingcontent-banner">
                                                Click "Start" button to read.
                                            </td>
                                            <td id='readingcontent-get' class='hide'>
                                                {{ $Question['Content'] }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!--  Timer Section  -->
                                <div class="col-md-2 pull-right">
                                    <table class="table table-bordered timer">
                                        <tr>
                                            <td class="timer stop_select"><span id="timer" data-method="60"
                                                    data-section="reading">Start</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!--  Textarea and Timer Row End  -->
                            <!-- tag Class Section -->
                            <div>
                                <table class="tag">
                                    <tr>
                                        <td class="tag stop_select" onclick="click_tag(this)">Redo</td>
                                        <td class="tag stop_select" onclick="click_tag(this)">Dictionary</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--  Textarea Section End  -->
                        <!--  Choices Section Start  -->
                        <div>
                            <!--  Checkbox Section Start  -->
                            <div name="type_multiple">
                                <p><strong>{{ $Question['Question'] }}</strong></p>
                                @foreach ($Question['Options'] as $option)
                                <label class="checkbox_container">
                                    <strong><span>A</span>&nbsp;</strong>
                                    <span>{{ $option }}</span>
                                    <input type="checkbox" class="checkbox_single">
                                    <span class="checkmark"></span>
                                </label>
                                @endforeach
                            </div>
                            <!--  Checkbox Section End  -->
                            <!--  Transcript Section Start  -->
                            <div>
                                <input type="button" class="btn disabled stop_select" name="disables" onclick="show_next_division(this)"
                                    value="Show Transcript" />
                                <div id="transcript_section" style="display:none">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                {{ $Question['Transcript'] }}
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- tag Class Section -->
                                    <div>
                                        <table class="tag">
                                            <tr>
                                                @foreach ($Question['Flags'] as $flag)
                                                <td class="tag stop_select" onclick="click_tag(this)">{{ $flag }}</td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--  Transcript Section End  -->
                        </div>
                        <!--  Choice Section End  -->
                        <!--  Result Section Start  -->
                        <div>
                            <br />
                            <input type="button" class="btn disabled stop_select" name="disables" onclick="show_next_division(this)"
                                value="Show Answer" />
                            <!--  Correct Answer and Explanation Start  -->
                            <div id="result_section" style="display:none">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="cell_mark">
                                            <span class="result_emphasized">
                                                {{ $Question['Answer'] }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $Question['Explaination'] }}
                                        </td>
                                    </tr>
                                </table>
                                <!-- Marking Section Start -->
                                <div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Current Score</td>
                                            <td>1/1</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!--  Correct Answer and Explanation End  -->
                        </div>
                        <!--  Reslut Section End  -->
                        <hr />
                        <!--  Buttons Row Start -->
                        <div>
                            <!--  Previous Button Start  -->
                            <div class="pull-left">
                                <br />
                                <input type="button" class="btn" onclick="" value="Previous" />
                                <br />
                            </div>
                            <!--  Previous Button End  -->
                            <!--  Next Button Start -->
                            <div class="pull-right">
                                <br />
                                <input type="button" class="btn" onclick="" value="Next" />
                                <br />
                            </div>
                            <!--  Next Button End  -->
                        </div>
                        <!--  Buttons Row End  -->
                    </div>
                    <!-- ***MCMAl End*** -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('extra-scripts')
{{ HTML::script('js/actions.js')}}
@endsection