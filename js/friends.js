$(document).ready(function(){
    $('.buttonAdd').click(function(){
        alert('Данная функция ещё находится в разработке');
    });
    $('.buttonSendMessage').click(function(){
        window.location.href = "https://dsmessage.ru/messages/?msg="+($(this).closest('div').attr('id'));
    });
    
    $(window).on('load', function () {
		var $preloader = $('.preloader'),
		    $loader = $preloader.find('.preloader__loader');
		$loader.fadeOut();
		$preloader.delay(250).fadeOut(200);
	});

});