
function showSite(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp = new XMLHttpRequest();
    } else {
        // IE6, IE5 浏览器执行代码
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("sortable1").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "getcategories.php?cid=" + str, true);
    xmlhttp.send();
}

function checkList(listName, newItem) {
    var dupl = false;
    $("#" + listName + " > li").each(function () {
        // console.log(newItem[0]);
        if ($(this)[0] !== newItem[0]) {
            if ($(this).html() == newItem.html()) {
                dupl = true;
            }
        }
    });

    return !dupl;
}


// $(function () {

    $("#sortable2").sortable({
        receive: function (event, ui) {
            // console.log(ui.item);
            
            var pasteItem = checkList("sortable2", ui.item);
            if (!pasteItem) {
                ui.item.remove();
                toastr.warning('Duplicated items found, removed one.');
            } else {
                $("#hidden_categories").append('<input type="hidden" name="categories[]" value="' + ui.item[0].attributes[1].nodeValue + '"/>');
                // console.log($("#hidden_categories").chldren());
            };
        },
        remove: function (event, ui) {
            $("#hidden_categories input[value='"+ui.item[0].attributes[1].nodeValue+"']").remove();
        }
    });

    function wordCount( val ){
        var wom = val.match(/\S+/g);
        return {
            charactersNoSpaces : val.replace(/\s+/g, '').length,
            characters         : val.length,
            words              : wom ? wom.length : 0,
            lines              : val.split(/\r*\n/).length
        };
    }

    var textarea = document.getElementById("content");
    var result   = document.getElementById("word-count");

    textarea.addEventListener("input", function(){
        var v = wordCount( this.value );
        result.innerHTML = (
            // "<br>Characters (no spaces):  "+ v.charactersNoSpaces +
            // "<br>Characters (and spaces): "+ v.characters +
            // "<br>Words: "+ v.words +
            // "<br>Lines: "+ v.lines
            "Words: " + v.words
            
        );
        document.getElementById("wordCount").value = v.words;
        // console.log(document.getElementById("wordCount").value);
      }, false);


    $("#sortable1, #sortable2").sortable({
        connectWith: ".connectedSortable"
    }).disableSelection();

    // console.log($('#upload-file-info').html(this.files[0].name));

    $('#delete1').on('click', function() {
        $(this).prev('span').text('');
        $('#sampleAnswerAudioPath').replaceWith( $('#sampleAnswerAudioPath').val('').clone( true ));
        $('#my-file-selector').val('');
        // alert($('#sampleAnswerAudioPath').val());
    });

    $('#delete2').on('click', function() {
        $(this).prev('span').text('');
        $('#sampleAnswerAudioPath2').replaceWith( $('#sampleAnswerAudioPath2').val('').clone( true ));
        $('my-file-selector2').val('');
    });

    $('#delete3').on('click', function() {
        $(this).prev('span').text('');
        $('#sampleAnswerAudioPath3').replaceWith( $('#sampleAnswerAudioPath3').val('').clone( true ));
        $('my-file-selector3').val('');
    });


    // 放在 上面 unchange 里面 分离出来放action.js  里面
    var fileNamePattern = new RegExp(/((mp3)|(wav)|(ogg)|(m4a))$/, 'i');
    document.getElementById("my-file-selector").addEventListener("change", function () {
        var filenName= document.getElementById("my-file-selector").files[0].name;
        if (! fileNamePattern.test(document.getElementById("my-file-selector").files[0].type)) {
            // alert(document.getElementById("my-file-selector").files[0].type);
            // alert('Only wav, m4a, mp3 and ogg files are accepted.');
            $('#my-file-selector').val('');
        } else if (document.getElementById("my-file-selector").files[0].size > 40000000) {
            alert('File size could not be larger than 40MB!');
            $('#my-file-selector').val('');
        } else {
            $('#upload-file-info').html(filenName);
        }
    });

    document.getElementById("my-file-selector2").addEventListener("change", function () {
        var filenName= document.getElementById("my-file-selector2").files[0].name;
        if (! fileNamePattern.test(document.getElementById("my-file-selector2").files[0].type)) {
            // alert(document.getElementById("my-file-selector").files[0].type);
            alert('Only wav, m4a, mp3 and ogg files are accepted.');
            $('#my-file-selector2').val('');
        } else if (document.getElementById("my-file-selector2").files[0].size > 40000000) {
            alert('File size could not be larger than 40MB!');
            $('#my-file-selector2').val('');
        } else {
            $('#upload-file-info2').html(filenName);
        }
    });

    document.getElementById("my-file-selector3").addEventListener("change", function () {
        var filenName= document.getElementById("my-file-selector3").files[0].name;
        if (! fileNamePattern.test(document.getElementById("my-file-selector3").files[0].type)) {
            // alert(document.getElementById("my-file-selector").files[0].type);
            alert('Only wav, m4a, mp3 and ogg files are accepted.');
            $('#my-file-selector3').val('');
        } else if (document.getElementById("my-file-selector3").files[0].size > 40000000) {
            alert('File size could not be larger than 40MB!');
            $('#my-file-selector3').val('');
        } else {
            $('#upload-file-info3').html(filenName);
        }
    });

    
    document.getElementById("word-count").innerHTML = "Words: " + wordCount(document.getElementById("content").value).words;
    document.getElementById("wordCount").value = wordCount(document.getElementById("content").value).words;
    // console.log(document.getElementById("wordCount").value );

    $('#back-button').on('click', function () {
        let url_string = window.location.href;
        let url = new URL(url_string);
        let rid;
        if (url.searchParams.get("rid")) {  rid = url.searchParams.get("rid"); } else { rid = '' };
        window.location = "/questionmgt/speaking"+"?rid="+rid;
    });

// });