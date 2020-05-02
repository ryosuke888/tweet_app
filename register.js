$(function() {
  $('.next-btn').click(function() {
  	$('.register-contents1').css('display', 'none');
    $('.register-contents2').css('display', 'block');
  });
  $('.back-btn').click(function() {
  	$('.register-contents2').css('display', 'none');
    $('.register-contents1').css('display', 'block');
  });
  
  
});