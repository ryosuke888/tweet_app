$(function() {
  $('.tweet-btn').click(function() {
    $('#tweet-modal').fadeIn();
  });
  $('.tweet-modal-close').click(function() {
    $('#tweet-modal').fadeOut();
  });
  $('.heart').click(function() {
  	$('#heart').css('display', 'none');
    $('#heart2').fadeIn();
  });
  $('.heart2').click(function() {
  	$('#heart2').css('display', 'none');
    $('#heart').fadeIn();
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