/*
 * MWS Admin v2.1 - Login JS
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 */

(function($) {
    $(document).ready(function() {

        if(!$("#can_call_banker").attr('checked')){
            $("#can_call_banker").change();
        };

        if(!$("#user_make").attr('checked')){
            $("#user_make").change();
        };






        $("#room-level-form-dev").validate({     
            onfocusout:true,
            // focusCleanup:true,       
            rules: {
                room_level_code: {
                    required: true,
                    digits:true
                },
                room_level_name: {
                    required: true,
                    maxlength:45
                },
                room_base: {
                    required: true,
                    digits:true
                },
                min_carry: {
                    required:true,    
                    digits:true
                },
                max_carry: {
                    required: true,
                    digits:true
                },
                default_carry: {
                    required: true,
                    digits:true
                },
                min_user: {
                    required: true,
                    digits:true
                },
                max_user: {
                    required: true,
                    digits:true
                },
                tax: {
                    required: true,
                    number:true
                },
                can_bet_times: {
                    required: true,
                    digits:true
                },
                poke_times: {
                    required: true,
                    digits:true
                },
                room_id_range: {
                    required: true,
                },
                exp_rate: {
                    required: true,
                    digits:true
                },
                prepare_timeout: {
                    required: true,
                    digits:true
                },
                grabbing_timeout: {
                    required: true,
                    digits:true
                },
                choos_banker_timeout: {
                    required: true,
                    digits:true
                },
                bet_timeout: {
                    required: true,
                    digits:true
                },
                deal_timeout: {
                    required: true,
                    digits:true
                },
                result_timeout: {
                    required: true,
                    digits:true
                }
            },
            messages: {
                username: {
                    required:"请输入用户名",
                    remote: jQuery.format("用户名已经存在")   
                },
                password: {
                    required:"请输入密码"
                },
                repassword: {
                    required:"请输入确认密码",
                    equalTo: "两次输入密码不一致"
                },
                email: {
                    required:"请输入电子邮箱",
                    email:"电子邮箱格式不正确"
                },
                realname: {
                    required:"请输入真实姓名"
                }   

            },           
            errorPlacement: function(error, element) {
                error.appendTo(element.parent()); 
            },
            invalidHandler: function(form, validator) {
                 
                if($.fn.effect) {
                    $("#mws-login").effect("shake", {distance: 6, times: 2}, 35);
                }
            }

        });

        $.fn.placeholder && $('[placeholder]').placeholder();
    });

}) (jQuery);

//加 动画效果  

function messagebox(title,msg)
{

  msgtitle = arguments[0]? arguments[0]:title;
  
  $("#message-details").html(msg);
  $("#dialog:ui-dialog").dialog("destroy");
  $("#dialog-message").dialog({
    modal: true,
    width: 360,
    height: 230,
    title: msgtitle,
    buttons: {
        "确认":function() {
             $( this ).dialog( "close" );
        },

    }
  });
}


function onlyInt(event){
    event.value=event.value.replace(/\D/g,'');
}

function onlyFloat(event){
    event.value=event.value.replace(/[\D^.]/g,'');
}

function cleanStr(event){
    event.value=event.value.replace(/[\^%&'"(),;=?$\x22]/g,'')
}

function ifgrab($event){
    $bool = !$event.checked;
    if(!$bool){
        $("#grabbing_timeout").attr('value',this.placeholder);    
    }else{
        $("#grabbing_timeout").attr('value',' ');
    }
    $("#grabbing_timeout").attr('readOnly',$bool);
}

function ifUserMakeFee($event){
    $bool = !$event.checked;
    $("#user_make_fee").attr('readOnly',$bool);
    $("#user_make_fee_desc").attr('readOnly',$bool);
    $("#user_make_fee_type").attr('disabled',$bool);

}

function curEditting(event){
    var id = event.id;
    var min_exp = document.getElementById('min_exp_'+id).value;
    var level_name = document.getElementById('level_name_'+id).value;

    var confirm = window.confirm('确认修改?');

    if(!confirm){
        window.location='/game/userlevellist';//修改前的值,获取比较麻烦&工期较紧...so...
    }else{
        $.ajax({
            type: "POST",
            url: "/game/userleveledit",
            data: "level=" + id + "&min_exp=" + min_exp+"&level_name=" + level_name,
            beforeSend: function(){
                // $("confirm").text("登录中，请稍候￼￼");
            },
            success: function(msg){
                // alert(msg);
                //修改对应记录的显示
                messagebox('修改结果','修改成功');
            }
        });
    }
}

function curDel(event){
    var id = event.id;
    var confirm = window.confirm('确认 删除?');

    if(!confirm){
        window.location='/game/userlevellist';//修改前的值,获取比较麻烦&工期较紧...so...
    }else{
        $.ajax({
            type: "POST",
            url: "/game/userleveldel",
            data: "level=" + id,
            success: function(msg){
                alert(msg);
                if(msg) {
                    window.location='/game/userlevellist';
                }
            }
        });
    }
}



