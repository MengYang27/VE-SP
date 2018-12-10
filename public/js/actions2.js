'use strict';

var main = document.querySelector('#dynamic-content');
var startButton = main.querySelector('table.table.table-bordered.timer');
startButton.addEventListener('click', function () {
    let duration = parseInt(this.querySelector('#timer').dataset.method);
    let section = this.querySelector('#timer').dataset.section === 'reading' ? 'reading' : null;
    timer(duration, section);
    this.style.pointerEvents = 'none';
});

var singleCheckboxes = main.getElementsByClassName('checkbox_single');
for (let i = 0; i < singleCheckboxes.length; i++){
    singleCheckboxes[i].addEventListener('click', function(){
        single_check_box_action(this);
    }, false);
};

var multipleCheckboxes = main.getElementsByClassName('checkbox_multiple');
for (let i = 0; i < multipleCheckboxes.length; i++){
    multipleCheckboxes[i].addEventListener('click', function(){
        multiple_check_box_action(this);
    }, false);
};

function single_check_box_action(item) {
    for (let i = 0; i < singleCheckboxes.length; i++){
        singleCheckboxes[i].checked = false;
    }
    item.checked = true;
}

function multiple_check_box_action() {

}

function show_next_division(item) {
    if (!item.classList.contains('disabled')) {
        item.nextElementSibling.style.display = "block";
    }
}

function click_tag(item) {
    console.log(item);
}

function timer(start_point, section = null) {
    if (section === "reading") {
        var banner = document.getElementById('readingcontent-banner');
        var content = document.getElementById('readingcontent-get');
        banner.style.fontSize = "inherit";
        banner.style.textAlign = 'left';
        banner.classList.add("hide");
        content.classList.add("stop_select");
        content.classList.remove("hide");
    } else {
        togglePlay();
    }
    let duration = parseInt(start_point, 10);
    let timer_box = document.getElementById('timer');
    let disables = document.getElementsByName('disables');
    let progress = document.getElementById('timer_bar');

    var temp = setInterval(function () {
        start_point = parseInt(start_point, 10);

        progress.style.width = 100 - start_point / duration * 100 + '%';

        let hours = Math.floor(start_point / (60 * 60));
        let minutes = Math.floor(start_point % (60 * 60) / 60);
        let seconds = Math.floor(start_point % 60);

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        if (start_point < 31) {
            timer_box.style.color = 'red';
            progress.style.height = '5px';
            progress.style.backgroundColor = 'red';
        } else {
            timer_box.style.color = 'inherit';
            progress.style.height = '3px';
            progress.style.backgroundColor = '#127cd4';
        }
        timer_box.innerHTML = hours + ':' + minutes + ':' + seconds;

        if (--start_point < 0) {
            disables.forEach((item) => {
                item.classList.remove('disabled');
                item.classList.remove('stop_select');
            });
            if (section === "reading") {
                content.classList.remove("stop_select");
            }
            let playpauseBtnPath = playpauseBtn.querySelector('path');
            playpauseBtnPath.style.fill = '#D8D8D8';
            playpauseBtn.classList.remove('stop_click');

            let progressBtn = document.getElementById('simple-progress-pin');
            progressBtn.style.backgroundColor = '#127bc4';
            progressBtn.style.cursor = 'pointer';

            /* parentElement position:
                <div class="simple-controls">
                    <span class="simple-current-time">-:--</span>
                        <div class="simple-slider" data-direction="horizontal">    <-----"progressBtn.parentElement.parentElement"
                            <div class="simple-progress">
                                <div class="simple-pin" id="simple-progress-pin" data-method="rewind"></div>
             */
            progressBtn.parentElement.parentElement.style.cursor = 'pointer';
            firstAttemptState = false;
            clearInterval(temp);
        }
    }, 1000);
}