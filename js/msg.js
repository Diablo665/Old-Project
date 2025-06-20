var lastLenght = 0;
var chat = document.getElementById("chatBox");
var lastID = 0;
var i = 0;
var msg 
var mode = "";
let messageID = [];
let contener = [];
var idUser = 0;



var array = {'read':'<ion-icon name="checkmark-circle-outline" style =  "color: green; font-size: 16"></ion-icon>', "unread": '<ion-icon name="close-circle-outline" style =  "color: red; font-size: 16"></ion-icon>'};


$(document).ready(function(){
    $(window).on('load', function () {
		var $preloader = $('.preloader'),
		    $loader = $preloader.find('.preloader__loader');
		$loader.fadeOut();
		$preloader.delay(250).fadeOut(200);
	});
    
    checkPosition();
    msg = setInterval(getMessage, 1000, $(".textImg").attr('id'));
    $(document).on('click', '.leftMenu .messageBlock', function(){
        idUser = $(this).attr('id');
        lastID = $(".textImg").attr('id');
        if(lastID != idUser){
            clearInterval(msg);
            lastLenght = 0;
            i = 0;
            $(".message").remove();
            
            $(".chatInput").fadeIn(500);
            $(".textImg").attr('id', idUser);
            $('#friendsImage').html(`<img src = "../php/getImage.php?ID=${idUser}" class = image>`);
            $("#none").html($(this).find('.headerName').text() + "<br><span></span>");
            msg = setInterval(getMessage, 1000, idUser);
                
            
        }
    });


    $("#UserInputMessage").keyup(function(e){

        if(e.key === "Enter" || e.keyCode === 13){
            if(mode != "edit"){
                sendMessage();
                return;
            }
            updateBD($("#UserInputMessage").val(), $(".textImg").attr('id'));
        }
    });

    function sendMessage(){
        let time = "23:00";
        if($("#UserInputMessage").val()){
            $("#stat").html("Отправляется").css({
                color: "#fff",
                background: 'grey',
            }).fadeIn(500);

            chat.scrollTop = chat.scrollHeight + 100;
            updateBD($("#UserInputMessage").val(), $(".textImg").attr('id'));
            $("#UserInputMessage").val("");

            

        }
    } 
    
    function updateBD(text, messageTo){
        if(mode == "edit"){
            $.get('../php/message/editMessage.php?newText='+ text,{'messageTo': messageTo, 'messageID' : $('.selected').attr("messageID")}, function(){
                editMessageList($("#UserInputMessage").val());
                $("#UserInputMessage").val('')
                $("#close").trigger('click');
            })
            return;
        }
        $.get('../php/message/sendMessage.php?messageText=' + text, {'messageTo': messageTo, 'status': "unread", "mode": mode}, function(data){
            $("#stat").html("Отправлено").css({background: "green"}, 500).fadeOut(1000);

        });
    }


    function getMessage(ID, mode = null){
        if(ID != ""){
        $.get({
            url: '../php/message/getMessage.php',
            data: {"messageTo":$(".textImg").attr
            ('id')}, 
            success: function(json){showMessage(json, ID)}, 
            async:false // to make it synchronous
        });
    }
    }


    function showMessage(json, idUser){
        
        if(lastLenght > json.length){
            i = 0;
            lastLenght = json.length;
            contener = [];
            for(i; i < lastLenght; i++){
                contener.push(json[i][4]);
            }
            $('.message').each(function(){
                if(contener.indexOf($(this).attr('messageID')) == -1){
                    $(this).remove();
                }
            })

        };

        for(lastLenght; lastLenght < json.length; lastLenght++){
            
            chat.scrollTop = chat.scrollHeight +1000;
            if(lastLenght > 0 && json[lastLenght][3].slice(0, 10) != json[lastLenght-1][3].slice(0,10)){
                $(".chatBox").append('<div class = "message messageTime">'+ json[lastLenght][3].slice(0,10) +'</div>')
                
            }
            if(json[lastLenght][0] == idUser){
                $("#chatBox").append('<div class = "message MyMessage '+ json[lastLenght][6]+'" id ='+ json[lastLenght][4] +' messageID =' + json[lastLenght][4]+ '> \
                                    <p>' + json[lastLenght][2] + '</p><span>'+ json[lastLenght][3].slice(10) +'</span> \
                                    </div>');
            }
            if(json[lastLenght][0] != idUser){
                $("#chatBox").append('<div class = "message friendMessage '+ json[lastLenght][6]+'" id ='+ json[lastLenght][4] +' messageID = ' + json[lastLenght][4]+ '>  \
                                    <p>' + json[lastLenght][2] + '<br> </p> <span>' + json[lastLenght][3].slice(10) +'</span> \
                                    </div>');
            }
            messageID.push(json[lastLenght][4]);
            $(".lastMessage"+idUser).text(json[lastLenght][2]);
        }
 
        for(n = 0; n<json.length; n++){
            if(json[n][5] && json[n][6] < 20){
                $('#chatBox').find('#'+json[n][4]).text(json[n][2]);
            }
        }
        
        lastLenght = json.length;
        updateStatus(json);
        checkPosition();
    }
    
    
    function updateStatus(json){
        
        for(let x = 0; x < json.length; x++){
            $('.MyMessage.unread').each(function(){
                if(json[x][4] == $(this).attr('messageID') && json[x][6] == "read"){
                    $(this).find('.status').html(array['read']);
                }
            });
        }
    }
    
    
    setInterval(getMessageList, 1500);
    var lastList = 0;
    var z = 0;
    function getMessageList(){
    $.get('../php/message/getMessageList.php', function(result){
            if(result.length > 0){$("#MessageNone").hide(500);}
            updateMessageList(result);
        });
        
    }
    
    
    function updateMessageList(json, mode = null){
        if(json.length > lastList){
            z = lastList;
            lastList = json.length;
        }
        for(z; z < json.length; z++){
            $(".chatList").prepend(`<div id =${json[z][1]} class = messageBlock> 
                <div class = imageUS> 
                <img src = '../php/getImage.php?ID=${json[z][1]}' class = image>
                </div> 
                <div class = information>
              <div class = header> 
                <h4 class = headerName>${json[z][2]}</h4>
                <p class = time> </p> 
              </div>
              <div class = message_panel> 
                <p class = 'lastMessage'>${json[z][3].slice(0, 25)}</p>
                <b class = notRead></b>
              </div>
            </div>
          </div>`);
        }
        for(let z2 = 0; z2<json.length; z2++){
            $(".chatList").find("#"+json[z2][1] +" .time").text(getInterval(json[z2][5]));
            $(".chatList").find("#"+json[z2][1] +" .lastMessage").text(json[z2][3].slice(0, 25));
            $(".chatList").find("#"+json[z2][1] +" .notRead").text(json[z2][7]).css({backgroundColor: 'none'})
        
            
        }


    }
    
    function getInterval(seconds){
        if(seconds < 60){
                return "";
        }else if(seconds >= 60 && seconds < 3600){
                return Math.floor(seconds / 60) + "m";
        }else if(seconds >= 3600 && seconds < 86400){
                return Math.floor(seconds / 3600) + "ч";
        }else{
            return Math.floor(seconds / 3600 / 24) + "д";
        }
    }

    $(document).on('click', '.friendMessage', function(){
        $(".editPanel").fadeIn();
        $(this).addClass("selected");

    })


    $(document).on('click', '.MyMessage', function(){
        $(".editPanel").fadeIn();
        $(this).addClass("selected");
    
    })

    $("#close").click(function(){
        $(".editPanel").hide();
        $(".message").removeClass("selected");
        mode = "";
    })

    $("#deleteMessage").click(function(){ 
        let deleted = getSelected()
        var getJsonString = JSON.stringify(deleted);
        $.post("../php/message/deleteMessage.php", {'data':getJsonString}, function(){
            $(".selected").remove();
            
        });

    });

    $("#editMessage").click(function(){
        let edit = getSelected();
        if(edit.length > 1){
            alert("Редактировать можно только 1 сообщение");
            return;
        }else{
            mode = "edit";
            let text = $('.selected').text().trim();
            $("#UserInputMessage").val(text.slice(0, text.length - 10));
            
            
        }




    })

    $("#information").click(function(){
        alert("Данная функция еще находится в разработке");
    })

    function getSelected(){
        let array = []
        
        $(".selected").each(function(){
            array.push($(this).attr("messageID"));
        });
        return array;
    }

    function editMessageList(text){
        $.get('../php/message/editMessageList.php?messageText='+ text, {"messageTo":$(".textImg").attr
        ('id')}, function(){ 

        })
    }
    
    
    function checkPosition(){
    if(idUser != 0){
    
    $('.friendMessage.unread').each(function(){
        var div_position = $(this).offset();
        // отступ сверху
        var div_top = div_position.top;
        // отступ слева
        var div_left = div_position.left;
        // ширина
        var div_width = 0;
        // высота
        var div_height = 30;
     
        // проскроллено сверху 
        var top_scroll = $(document).scrollTop();
        // проскроллено слева
        var left_scroll = $(document).scrollLeft();
        // ширина видимой страницы
        var screen_width = $(window).width();
        // высота видимой страницы
        var screen_height = $(window).height();
     
        // координаты углов видимой области
        var see_x1 = left_scroll;
        var see_x2 = screen_width + left_scroll;
        var see_y1 = top_scroll;
        var see_y2 = screen_height + top_scroll;
     
        // координаты углов искомого элемента
        var div_x1 = div_left;
        var div_x2 = div_left + div_height;
        var div_y1 = div_top;
        var div_y2 = div_top + div_width;
     
        // проверка - виден див полностью или нет
        if(div_y1 >= see_y1 && div_y2 <= see_y2 ){


            $.get({
                url: '../php/message/readMessage.php?messageID='+$(this).attr('id')+'&messageTo='+idUser,
                async:false, // to make it synchronous
                success: function(){
                    $(this).removeClass('unread');
                    $(this).find('ion-icon').attr('name',"checkmark-circle-outline").css({color: 'green', fontSize: '16'});
                }
            
            });
            
        }else{
            // если не виден
        }
    })
    
    }
    
}
}); 
            
              