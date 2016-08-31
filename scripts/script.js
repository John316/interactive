
function sendPost(url, data, callbeak){
  $.post(url, data)
  .done(function( data ) {
    if(callbeak){
      callbeak(data);
    }
    cl( "Data Loaded: " + data );
  })
  .fail(function() {
    cl( "error" );
  })
  .always(function() {
    cl( "finished" );
  });
}
function cl(m) {
  console.log(m);
}
function cd(o) {
  console.dir(o);
}
$( document ).ready(function() {
    $("#sendLevel").click(function(){
      var level1 = $("#level1").val();
      var level2 = $("#level2").val();
      var url = "controllers/level_controller.php";
      var data = {level1: level1, level2:level2, level3:0};
      sendPost(url, data);
    });
});
