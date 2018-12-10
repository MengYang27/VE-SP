/**
This script is completely abandoned, cheers.
**/



// function record_timer(duration, id) {
//
//     var current_process = 0;
//     var timerId = setInterval(() => {
//         current_process += 1;
//         $("#" + id).css("width", current_process * 1000 * 100 / duration + "%");
//     }, 1000);
//
//     setTimeout(() => {
//         clearInterval(timerId);
//     }, duration);
//
// }




/** Abandoned function **/

// function question_timer(wavesurfer, id) {
//
//     $(document).ready(function() {
//         // wavesurfer.on('audioprocess', function() {
//         //     var current_time = wavesurfer.getCurrentTime();  question_audio_play from question_audio_play.js
//         //     var duration_time = wavesurfer.getDuration();  question_audio_play from question_audio_play.js
//         //     $("#timer").css("width", current_time / duration_time * 120+"%");
//         //
//         //     console.log(wavesurfer.on('seek', 'audioprocess'));
//         // });
//         var former_ratio = 0;
//         var duration_time;
//         var current_time;
//         var current_ratio;
//
//         wavesurfer.on('audioprocess', function() {
//             duration_time = Math.floor(wavesurfer.getDuration() * 90) / 100; // question_audio_play from question_audio_play.js
//         });
//
//         wavesurfer.on('audioprocess', function() {
//             current_time = Math.ceil(wavesurfer.getCurrentTime() * 100) / 100; // question_audio_play from question_audio_play.js
//             // console.log(current_time / duration_time);
//             current_ratio = current_time / duration_time;
//             // console.log(current_ratio - former_ratio);
//             if (current_ratio - former_ratio > 0.05) {
//                 $("#" + id).css("width", (current_time / duration_time) * 100 + "%")
//                 former_ratio = current_ratio;
//             }
//         });
//
//         // wavesurfer.on('pause', function() {
//         //      former_ratio = 0;
//         //      $("#"+id).css("width", "100%")
//         //     current_ratio
//         // });
//
//         wavesurfer.on('finish', function() {
//             former_ratio = 0;
//             $("#" + id).css("width", "100%")
//         });
//
//         question_audio_play.on('play', function() {
//             if (current_time == 0) {
//                 $("#" + id).css("width", "0%");
//             }
//         });
//
//     });
//
// }
//
// question_timer(question_audio_play, "timer");
