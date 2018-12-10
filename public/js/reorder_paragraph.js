$(function() {
    $("#left-sortable, #right-sortable").sortable({connectWith: ".connectedSortable", placeholder: "sortable-placeholder", tolerance: "pointer"}).disableSelection();

    $(".list-group-item").mouseenter(function() {
        $(this).css("background-color", "rgb(236, 236, 236)");
    });

    $(".list-group-item").mouseleave(function() {
        $(this).css("background-color", "rgb(255, 255, 255)");
    });

    var launchPad = $("#left-sortable").clone();
    $("[name='reset']").click(function() {
        $("#right-sortable").empty();
        $("#left-sortable").html(launchPad.html());
    });

});