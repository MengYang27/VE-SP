$(document).ready(function(){
  $("a.db-sessions").click(function() {
    var session_name = $(this).text()
    $(".box-title.post-list").html(session_name);
  })
});
