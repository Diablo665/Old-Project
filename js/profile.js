$(document).ready(function(){
    $(window).on('load', function () {
		var $preloader = $('.preloader'),
		    $loader = $preloader.find('.preloader__loader');
		$loader.fadeOut();
		$preloader.delay(250).fadeOut(200);
	});


    $(document).on('click','.open-more-info',function(){
        $('.moreInfo').css('display', 'block');
        $('.profile-card .open-more-info').attr('name', 'chevron-up-circle');
        $('.profile-card .open-more-info').attr('class','close-more-info hd hydrated');
    })

    $(document).on('click', '.close-more-info', function(){
        $('.moreInfo').css('display', 'none');
        $('.profile-card .close-more-info').attr('name', 'chevron-down-circle');
        $('.profile-card .close-more-info').attr('class','open-more-info hd hydrated');
    })

    $('#post-text').on('input', function(){
        this.style.height = '1px';
	    this.style.height = (this.scrollHeight + 6) + 'px'; 

    })

    $('#add-post-btn').on('click', function(){
        $('.add-post').fadeToggle();
    })
});

