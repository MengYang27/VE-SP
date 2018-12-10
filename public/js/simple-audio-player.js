'use strict';

var audioPlayer = document.querySelector('.simple-audio-player');
var playPause = audioPlayer.querySelector('#simple-playPause');
var playpauseBtn = audioPlayer.querySelector('.simple-play-pause-btn');
var progress = audioPlayer.querySelector('.simple-progress');
var sliders = audioPlayer.querySelectorAll('.simple-slider');
var volumeBtn = audioPlayer.querySelector('.simple-volume-btn');
var volumeControls = audioPlayer.querySelector('.simple-volume-controls');
var volumeProgress = volumeControls.querySelector('.simple-slider .simple-progress');
var player = document.querySelector('audio');
var currentTime = audioPlayer.querySelector('.simple-current-time');
var totalTime = audioPlayer.querySelector('.simple-total-time');
var speaker = audioPlayer.querySelector('#simple-speaker');

var firstAttemptState = true;

var draggableClasses = ['simple-pin'];
var currentlyDragged = null;

window.addEventListener('mousedown', function (event) {

  if (!isDraggable(event.target)) return false;

  currentlyDragged = event.target;
  var handleMethod = currentlyDragged.dataset.method;

  this.addEventListener('mousemove', window[handleMethod], false);

  window.addEventListener('mouseup', function () {
    currentlyDragged = false;
    window.removeEventListener('mousemove', window[handleMethod], false);
  }, false);
});

playpauseBtn.addEventListener('click', togglePlay);
player.addEventListener('timeupdate', updateProgress);
player.addEventListener('volumechange', updateVolume);
player.addEventListener('loadedmetadata', function () {
  //totalTime.textContent = formatTime(player.duration);
});
player.addEventListener('canplay', makePlay);
player.addEventListener('ended', function () {
  playPause.attributes.d.value = "M18 12L0 24V0";
  player.currentTime = 0;
});

volumeBtn.addEventListener('click', function () {
  volumeBtn.classList.toggle('simple-open');
  volumeControls.classList.toggle('simple-hidden');
});

window.addEventListener('resize', directionAware);

sliders.forEach(function (slider) {
  var pin = slider.querySelector('.simple-pin');
  slider.addEventListener('click', window[pin.dataset.method]);
});

directionAware();

function isDraggable(el) {
  var canDrag = false;
  var classes = Array.from(el.classList);
  draggableClasses.forEach(function (draggable) {
    if (classes.indexOf(draggable) !== -1) canDrag = true;
  });
  return canDrag;
}

function inRange(event) {
  var rangeBox = getRangeBox(event);
  var rect = rangeBox.getBoundingClientRect();
  var direction = rangeBox.dataset.direction;
  if (direction == 'horizontal') {
    var min = rect.left;
    var max = min + rangeBox.offsetWidth;
    if (event.clientX < min || event.clientX > max) return false;
  } else {
    var min = rect.top;
    var max = min + rangeBox.offsetHeight;
    if (event.clientY < min || event.clientY > max) return false;
  }
  return true;
}

function updateProgress() {
  if (firstAttemptState) return false;
  totalTime.textContent = formatTime(player.duration);
  var current = player.currentTime;
  var percent = current / player.duration * 100;
  progress.style.width = percent + '%';

  currentTime.textContent = formatTime(current);
}

function updateVolume() {
  volumeProgress.style.width = player.volume * 100 + '%';
  if (player.volume >= 0.5) {
    speaker.attributes.d.value = 'M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z';
  } else if (player.volume < 0.5 && player.volume > 0.05) {
    speaker.attributes.d.value = 'M0 7.667v8h5.333L12 22.333V1L5.333 7.667M17.333 11.373C17.333 9.013 16 6.987 14 6v10.707c2-.947 3.333-2.987 3.333-5.334z';
  } else if (player.volume <= 0.05) {
    speaker.attributes.d.value = 'M0 7.667v8h5.333L12 22.333V1L5.333 7.667';
  }
}

function getRangeBox(event) {
  var rangeBox = event.target;
  var el = currentlyDragged;

  if (event.type == 'click' && isDraggable(event.target)) {
    rangeBox = event.target.parentElement.parentElement;
  }
  if (event.type == 'mousemove') {
    rangeBox = el.parentElement.parentElement;
  }

  return rangeBox;
}

function getCoefficient(event) {
  var slider = getRangeBox(event);
  var rect = slider.getBoundingClientRect();
  var K = 0;

  if (slider.dataset.direction == 'horizontal') {
    var offsetX = event.clientX - rect.left;
    var width = slider.clientWidth;
    K = offsetX / width;
  } else if (slider.dataset.direction == 'vertical') {
    var height = slider.clientHeight;
    var offsetY = event.clientY - rect.top;
    K = 1 - offsetY / height;
  }
  return K;
}

function rewind(event) {
  if (!firstAttemptState && inRange(event)) {
    player.currentTime = player.duration * getCoefficient(event);
  }
}

function changeVolume(event) {
  if (inRange(event)) {
    player.volume = getCoefficient(event);
  }
}

function formatTime(time) {
  var min = Math.floor(time / 60);
  var sec = Math.floor(time % 60);
  return min + ':' + (sec < 10 ? '0' + sec : sec);
}

function togglePlay() {
  if (player.paused) {
    playPause.attributes.d.value = "M0 0h6v24H0zM12 0h6v24h-6z";
    player.play();
  } else {
    playPause.attributes.d.value = "M18 12L0 24V0";
    player.pause();
  }
}

function makePlay() {
  playpauseBtn.style.display = 'block';
}

function directionAware() {
  if (window.innerWidth < 810){
    volumeControls.style.bottom = '50px';
    volumeControls.style.left = '-87px';
  } else {
    volumeControls.style.bottom = '-3px';
    volumeControls.style.left = '52px';
  }
}