$(document).ready(function(){
    var code = ''
    var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
    $('.close').click(function(){
        $('#openModal').remove()
    })

    $('#sendEmail').click(function(){
        var email = $('#email');
        if(email.val() != ''){
            if(email.val().search(pattern) == 0){
                $('.errors').text('');
                $.get('../php/profile/checkEmail.php', {'email': email.val()}, function(result){
                    $('.modal-body').html(result['result']);
                    code = result['code'];
                })
            }
            else{
                $('.errors').text('Проверьте пожалуйста корректность введенного email адреса');
            }
            
        }else{
            $('.errors').text('Поле для email не должно быть пустым');
        }
    })

    $(document).on('click', '#checkCode', function(){
        if(parseInt(code) == parseInt($('#verefyCode').val())){
            console.log('yes')
        }else{
            $('.errors').text('Неверный код подтверждения');
        }
    })
	
})