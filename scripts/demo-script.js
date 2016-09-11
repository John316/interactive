demonstration = true;
function outputMessage(data) {
  var html = '';
  $(data).each(function (i, el) {
    html += '<div id="mess'+el.id+'" class="message-body"><div onclick="deleteMessage('+el.id+')" class="mess-cancel">x</div><div class="message-text">' + el.text + '</div></div>';
  });
  $('#message-aside').html(html);
}
function deleteMessage(id) {
  var url = "controllers/message_controller.php?url=deleteMessage";
  sendPost(url, {id: id}, function (data) {
    $('#mess'+id).remove();
  });
}
