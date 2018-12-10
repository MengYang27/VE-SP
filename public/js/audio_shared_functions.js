function seektimeupdate(audio_play, id) {
    var curmins = Math.floor(audio_play.getCurrentTime() / 60);
    var cursecs = Math.floor(audio_play.getCurrentTime() - curmins * 60);
    var durmins = Math.floor(audio_play.getDuration() / 60);
    var dursecs = Math.floor(audio_play.getDuration() - durmins * 60);
    if(cursecs < 10){ cursecs = "0"+cursecs; }
    if(dursecs < 10){ dursecs = "0"+dursecs; }
    if(curmins < 10){ curmins = "0"+curmins; }
    if(durmins < 10){ durmins = "0"+durmins; }
    document.getElementById(id).innerHTML = curmins+":"+cursecs+" / "+durmins+":"+dursecs;
}