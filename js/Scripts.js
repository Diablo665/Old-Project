/**/

$(document).ready(function(){

  $(window).on('load', function () {
		var $preloader = $('.preloader'),
		    $loader = $preloader.find('.preloader__loader');
		$loader.fadeOut();
		$preloader.delay(250).fadeOut(200);
	});

  $("#request").click(function(){
    let error = 0;
    $("#ENTRY").find(":input").each(function(){
      if(!$(this).val()){
        $(this).css('border', 'red 1px solid');
        error = 1;
      }
      else{
        $(this).css("border", 'grey 1px solid');
      }
    });

    if($('#password').val().length >= 8){
      var pass = $('#password').val();
      var arr = [/[a-z]+/, /[0-9]+/, /[A-Z]+/];
      $.map(arr, function(regexp) {

        if(pass.match(regexp)){

          $("#passwordUncorrect").html("Пароль должен содержать числа (0-9) символы английсково алфавита(A_Z, a-z) и быть более 8 символов").fadeIn();
          $("#passwordUncorrect").css({
            border:'red',
            background: '#fff',
            color: "red"
  
          })
        }
        });

      if($("#password").val() != $("#repeat_password").val()){
        error = 2;
      }
      if(error == 1){
        $("#message").html("Заполните все поля");
        $("#message").css({
          border:'red',
          background: '#ff0000cd',
          color: "#000"

        }).fadeIn(1000);
      }else if(error == 2){
        $("#message").html("Пароли не совпадают");
        $("#message").css({
          border:'red',
          background: '#ff0000cd',
          color: "#000"

        }).fadeIn(1000);
      }
      else{
        $("#message").fadeOut(500);
        getPOST(); 
      }

  }else{
    $("#message").html("Пароль должен быть длиннее 8 символов");
        $("#message").css({
          border:'red',
          background: '#ff0000cd',
          color: "#000"

        }).fadeIn(1000);
      }
  });

  $("#entry").click(function(){
    let error = 0;
    $("#ENTRY").find(":input").each(function(){
      if(!$(this).val()){
        $(this).css('border', 'red 1px solid');
        error = 1;
      }
      else{
        $(this).css("border", 'grey 1px solid');
      }
    });
    if(error == 1){
      $("#message").html("Заполните все поля");
      $("#message").css({
        border:'red',
        background: '#ff0000cd',
        color: "#000"

      }).fadeIn(1000);
    }
    else{
      $("#message").fadeOut(500);
      getPOST(); 
    }
  });


  $("#ENTRY").submit(function(){
    return false;
  });

  function getPOST(){
    let data = $("#ENTRY :input").serializeArray();
      $.post($("#ENTRY").attr('action'), data, function(json){
        if(json.includes("Error")){
          alert(json);
        }else{
          window.location.href = 'https://dsmessage.ru'+json;
        }
        

    });
  }
});
