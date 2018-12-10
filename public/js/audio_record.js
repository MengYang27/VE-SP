/**
**** Dependences: recorder.js (please load it before this script in html) ****

1. Recoding Kit
This is the js scriipt for recording users' audio input from browser.
For Using the code, you need to set a code block like this:

<div class="row">
    <div class="col-xs-12">
        <h5>Record</h5>
        <div class="row is-table-row">
            <div id="record-play-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a class="btn btn-app"><i class="fa fa-play"></i> Play</a></div>
            <div id="record-step-backward-button" class="col-xs-4 col-sm-2 col-md-2 col-lg-1"><a class="btn btn-app"><i class="fa fa-step-backward"></i> Rsest</a></div>
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
        <button class="col-xs-4 col-sm-3 col-md-4 col-lg-3" id="record-button" onclick="startRecording(this, 'repeat_sentence');">record</button>
        <span class="col-xs-1"></span>
        <button class="col-xs-4 col-sm-3 col-md-4 col-lg-3" id="stop-button" onclick="stopRecording(this);" disabled>stop</button>
    </div>
    <div class="col-xs-1">
    </div>
</div>
<!-- ./row -->

record-play-button: The play button
record-step-backward-button: The step backward button
record-audio-play: The area where the audio wave would be shown on the screen
record-tracktime: Showing "the current time" : "the duration" like 00:15 / 01:36

record-button: Record button
stop-button: Stop button


PS: you may need to change the IDs of the <div>s' above to avoid confusion.


2. Timer for recorder

You can also add a timer for the recorder by adding html like this:

<div class="row">
    <div class="col-xs-12">
        <div class="progress progress-xxs">
            <div id="timer" class="progress-bar progress-bar-danger" style="width: 0%">
            </div>
        </div>
    </div>
</div>

PS:
For different types of questions, you may need to set question_type for timeLimit().

**/

var audio_context;
var recorder;
var record_audio_play;
var set_timer;

// log in console.log
function __log(e, data) {
    console.log("\n" + e + " " + (
    data || ''));
}

// for set different time limit for different types of questions,
// simply add case and time in miliseconds would work.
function timeLimit(question_type = "retell_lecture") {
    switch (question_type) {
        case "repeat_sentence":
            max_time = 15000; // in miliseconds
            break;
        case "answer_short_question":
            max_time = 10000; // in miliseconds
            break;
        case "retell_lecture":
            max_time = 40000; // in miliseconds
            break;
    }
    return max_time;
}

function startUserMedia(stream) {

    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.');

    recorder = new Recorder(input);
    __log('Recorder initialised.');
}

// binding with the record button (#record-play-button) directly.
function startRecording(button, qtype = "repeat_sentence", timer_id = "timer") {

    var current_process = 0;
    var duration = Math.ceil(timeLimit(qtype) / 1000) * 1000 ;

    // reset the timer bar after stopping button is triggered.
    $("#" + timer_id).css("width", current_process * 1000 * 100 / duration + "%");

    // recording start
    recorder && recorder.record();
    button.disabled = true;
    $('#stop-button').prop('disabled', false);

    // log in console.log
    __log('Recording...');

    // these lines below is the timer part.
    set_timer = setInterval(() => {
        current_process += 1;
        $("#" + timer_id).css("width", current_process * 1000 * 100 / duration + "%");
    }, 1000);
    setTimeout(() => {
        clearInterval(set_timer);
        $("#stop-button").trigger("click");
    }, duration);

}

// binding with the stop button directly.
function stopRecording(button) {

    recorder && recorder.stop();
    button.disabled = true;
    $('#record-button').prop('disabled', false);
    __log('Stopped recording.');

    recorder && recorder.exportWAV(function(blob) {

        if (typeof record_audio_play !== 'object') {

            record_audio_play = new WaveSurfer.create({
                container: '#record-audio-play',
                waveColor: 'rgb(183, 193, 192)',
                progressColor: 'rgb(10, 85, 140)',
                barWidth: '0.5',
                barHeight: '2',
                height: 60,
                maxCanvasWidth: 500,
                hideScrollbar: true
            });
        }

        record_audio_play.loadBlob(blob);

        recorder.clear();

        if (typeof record_audio_play == 'object') {
            record_audio_play.on('ready', function() {
                seektimeupdate(record_audio_play, 'record-tracktime');
            });
            record_audio_play.on('audioprocess', function() {
                seektimeupdate(record_audio_play, 'record-tracktime');
            });
        }

    }); //exportWAV

    clearInterval(set_timer);

}





$(document).ready(function() {

    $("#record-play-button").on("click", function() {
        record_audio_play.playPause();
    });

    $("#record-step-backward-button").click(function() {
        record_audio_play.seekTo(0);
    });

});

window.onload = function init() {
    try {
        // webkit shim
        window.AudioContext = window.AudioContext || window.webkitAudioContext;
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
        window.URL = window.URL || window.webkitURL;

        audio_context = new AudioContext;
        __log('Audio context set up.');
        __log('navigator.getUserMedia ' + (
            navigator.getUserMedia
            ? 'available.'
            : 'not present!'));
    } catch (e) {
        alert('No web audio support in this browser!');
    }

    navigator.getUserMedia({
        audio: true
    }, startUserMedia, function(e) {
        __log('No live audio input: ' + e);
    });

};
