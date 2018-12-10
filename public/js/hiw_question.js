// a hard-coded question
var question = 'Girls are more likely to use the settle methods of child bullying like verbal accuse although I have witnessed rage and some physical force from young people. Girls are also more likely to be adopt at physical bullying by signaling out or at targeting a person or finding some other way to harass them or belittle others by starting rumors or gossiping. Many parents are concerned that their child may be a victim of a child Bullying. Signs of physical altercations, such as bruises, scrapes and other marks are some signs to look out for.';

var chunked_question = question.split(/[\s]+/);

var chunked_question_tag = new Array();

// generate chunked_question_tag to post on the html page
// in order to let user select
// each word in it has an unique id
chunked_question.forEach(x => {
    var xx;
    
    //hard code some answer words
    if (x == 'settle' || x == 'witnessed' || x == 'physical' || x == 'targeting' || x == 'altercations') { 
        xx = '<span class="question_token answer_word" isselected="no" style="font-size:large;">' + x + '</span>' + ' ';
        
    } else {
        xx = '<span class="question_token" isselected="no" style="font-size:large;">' + x + '</span>' + ' ';
    }
    chunked_question_tag.push(xx);
});
// push into html to show on the page
$(".hiw-question").html(chunked_question_tag);

// this part: user clicks on the word then it turns to be yellow color
// in the background.
$(document).ready(function() {
    $(".question_token").on('mouseenter', function() {
        $(this).css( 'cursor', 'crosshair' );
        $(this).css("background-color", "rgb(231, 231, 231)");
    });
    
    $(".question_token").on('mouseleave', function() {
        if ($(this).attr("isselected") == "yes") {
            $(this).css("background-color", "yellow");
        } else {
            $(this).css("background-color", "white");
        }
    
        $(this).css( 'cursor', 'pointer' );
    });

    $(".question_token").on('click', function() {
        if ($(this).attr("isselected") == "no") {
            $(this).attr("isselected", "yes");
            $(this).css("background-color", "yellow");
        } else {
            $(this).attr("isselected", "no");
            $(this).css("background-color", "white");
        }

    });

});


function checkButton() {
    document.getElementById("answer").style.display = "block";
    $(".answer_word").css('background-color', 'red');
    
    // unregister events
    $(".question_token").off("mouseenter");
    $(".question_token").off("mouseleave");
    $(".question_token").off("click");
}
