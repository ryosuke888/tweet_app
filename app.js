$(function() {
  $('.tweet-btn').click(function() {
    $('#tweet-modal').fadeIn();
  });
  $('.tweet-modal-close').click(function() {
    $('#tweet-modal').fadeOut();
  });
  
  $('.logout').click(function() {
    $('#logout-modal').fadeIn();
  });
  $('.logout-modal-close').click(function() {
    $('#logout-modal').fadeOut();
  });


  $('#reply-open-btn').click(function() {
  	$('.reply-open').css('display', 'none');
    $('.reply-box').fadeIn();
  });
  $('#reply-back').click(function() {
  	$('.reply-box').css('display', 'none');
    $('.reply-open').fadeIn();
  });
  
});