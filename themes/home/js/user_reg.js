/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$.validator.setDefaults({
    submitHandler: function(form) {
        reg_submit(form);
    }
});
$("#form, #myModal").validate({
    onkeyup:false,
    errorPlacement:function(error, element){
        $(element).after(error);
    },
    rules:{
        name:{
            required:true,
            rangelength:[4,20],
            remote:{     //验证用户名是否存在
                type:"POST",
                url:"/user/reg_form_check.html",             //servlet
                data:{
                  name:function(){return $("#name").val();}
                },
            },
        },
        email:{
            remote:{     //验证用户名是否存在
                type:"POST",
                url:"/user/reg_form_check.html",             //servlet
                data:{
                  email:function(){return $("#email").val();}
                },
            },
        },
        vCode:{
            required:true,
            minlength:4,
            maxlength:4,
            remote:{
                type:"POST",
                url:"/user/reg_code_check.html",             
                data:{
                    vCode:function(){return $("#vCode").val();}
                } 
            }
        }
    },
    messages: {
        name:{
            required:"用户名不能为空！",
            rangelength:jQuery.validator.format("用户名位数必须在{0}到{1}字符之间！"),
            remote:jQuery.validator.format("用户名已经被注册"),
            success:"valid",
        },
        phone:{
            required:"联系电话不能为空！",
        },
        email:{
            required:"邮箱不能为空，需要使用邮箱激活验证！",
            remote:jQuery.validator.format("邮箱已经被注册"),
        },
        passwd:{
            required:"请输入密码！",
        },
        repasswd:{
            required:"请再次输入密码！",
        },
        vCode:{
            required:"请输入验证码",
            remote:jQuery.validator.format("验证码错误")
        },
    }
});

function reg_submit(form){
    var para = {};
    for(var i=0; i<form.length; i++){
        if(0 != form[i].name.length && $(form[i]).attr('id') == $(form[i]).attr('name')){
            para[form[i].name] = getFormValue(form[i]);
        }
    }
    var para = before_submit(para);
    if(false == para)return;
    var data = {};
    for(var k in para){
        data[k.replace(/\./,"|")] = para[k];
    }
    
    var alert_obj = $(form).find(".alert-hint");
    myAjax($(form), $(form).find(".panel-body").data('url'), {data:data}, function(data){
        alert_obj.addClass('sr-only');
        //操作成功，刷新页面，给出提示
        var url = $(form).data('url');
        if(url){
            window.location.href = url;
            return;
        }
    }, function(data){
        //操作失败，给出提示
        alert_obj.find("strong").text("操作失败!");
        alert_obj.find("span").text(data.msg);
        alert_obj.addClass('alert-danger').removeClass('alert-success').removeClass('sr-only');
        $('#hint').removeClass('hide');
        if(20 == data.code){
            $("#code").click();
        }
    });
}

function before_submit(para){
    return para;
}