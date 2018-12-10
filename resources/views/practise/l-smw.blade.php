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
                    <!-- ***HCS Start*** -->
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
                        <!--  Audio and Timer Row Start  -->
                        <div class="row">
                            <!--  Auido Section Start  -->
                            <div class="col-md-10">
                                <table class="table table-noborder">
                                    <tr>
                                        <td>
                                            <!--  Audio Player Start  -->
                                            <div class="simple-audio simple-audio-player">
                                                <!--  Play/Pause Button Start  -->
                                                <div class="simple-play-pause-btn stop_click">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24"
                                                        viewBox="0 0 18 24">
                                                        <path fill="#000000" fill-rule="evenodd" d="M18 12L0 24V0"
                                                            class="simple-play-pause-icon" id="simple-playPause" />
                                                    </svg>
                                                </div>
                                                <!--  Play/Pause Button End  -->
                                                <!--  Progress Start  -->
                                                <div class="simple-controls">
                                                    <span class="simple-current-time">-:--</span>
                                                    <div class="simple-slider" data-direction="horizontal">
                                                        <div class="simple-progress">
                                                            <div class="simple-pin" id="simple-progress-pin"
                                                                data-method="rewind"></div>
                                                        </div>
                                                    </div>
                                                    <span class="simple-total-time">-:--</span>
                                                </div>
                                                <!--  Progress End  -->
                                                <!--  Volumn Controller Start  -->
                                                <div class="simple-volume">
                                                    <div class="simple-volume-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24">
                                                            <path fill="#D8D8D8" fill-rule="evenodd" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z"
                                                                id="simple-speaker" />
                                                        </svg>
                                                    </div>
                                                    <!--  Volume Bar Horizontal Start  -->
                                                    <div class="simple-volume-controls simple-hidden">
                                                        <div class="simple-slider" data-direction="horizontal">
                                                            <div class="simple-progress">
                                                                <div class="simple-pin" id="simple-volume-pin"
                                                                    data-method="changeVolume"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  Volume Bar Horizontal End  -->
                                                </div>
                                                <!--  Volumn Controller End  -->
                                            </div>
                                            <!--  Audio Player End  -->
                                        </td>
                                    </tr>
                                </table>
                                <!--  Audio Source Start  -->
                                <audio>
                                    <source src="{{ URL::to('/').$Question['Audio']['Src'] }}"
                                type="{{ $Question['Audio']['Format'] }}">
                                </audio>
                                <!--  Audio Source End  -->
                            </div>
                            <!--  Audio Section End  -->
                            <!--  Timer Button Start -->
                            <div class="col-md-2 pull-right">
                                <table class="table table-bordered timer">
                                    <tr>
                                        <td class="timer stop_select"><span id="timer" data-method="60">Start</span></td>
                                    </tr>
                                </table>
                            </div>
                            <!--  Timer Button End  -->
                        </div>
                        <!--  Audio and Timer Row End  -->
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
                            <!--  Transcript Section Start -->
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
                                <!-- Marking Section End -->
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
                    <!-- ***HCS END*** -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('extra-scripts')
{{ HTML::script('js/simple-audio-player.js') }}
{{ HTML::script('js/actions.js')}}
@endsection