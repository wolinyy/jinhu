/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var info_type = typeInit();
    var info_region = regionInit();
    
})

function typeInit(){
    var prePid = -1;
    var typeObj = {};
    for(var i=0; i<type.length; i++){
        if(prePid != type[i].pid){
            prePid = type[i].pid
            typeObj[prePid] = {};
            typeObj[prePid]['name'] = type[i].pname;
            typeObj[prePid]['sub'] = {};
            typeObj[prePid]['sub'][type[i].id] = type[i].name;
            
            $('#type_one_id').append('<option value='+ prePid +'>'+type[i].pname+'</option>');
            
        }else{
            typeObj[prePid]['sub'][type[i].id] = type[i].name;
        }
    }
    
    $('#type_one_id').on('change', function(){
        $('#type_two_id').empty();
        $('#type_two_id').append("<option value=''>二级分类</option>");
        
        if(! $(this).val()) return;
        var subObj = typeObj[$(this).val()]['sub'];
        for(var k in subObj){
            $('#type_two_id').append("<option value='"+k+"'>"+subObj[k]+"</option>");
        }
    });
            
//    console.log(typeObj);
    return typeObj;
}

function regionInit(){
    var prePid = -1;
    var RegionObj = {};
    for(var i=0; i<region.length; i++){
        if(prePid != region[i].pid){
            prePid = region[i].pid
            RegionObj[prePid] = {};
            RegionObj[prePid]['name'] = region[i].pname;
            RegionObj[prePid]['sub'] = {};
            RegionObj[prePid]['sub'][region[i].id] = region[i].name;
            
            $('#addr_one_id').append('<option value='+ prePid +'>'+region[i].pname+'</option>');
        }else{
            RegionObj[prePid]['sub'][region[i].id] = region[i].name;
        }
    }
    
    $('#addr_one_id').on('change', function(){
        $('#addr_two_id').empty();
        $('#addr_two_id').append("<option value=''>乡村</option>");
        
        if(! $(this).val()) return;
        var subObj = RegionObj[$(this).val()]['sub'];
        for(var k in subObj){
            $('#addr_two_id').append("<option value='"+k+"'>"+subObj[k]+"</option>");
        } 
    });
    
//    console.log(RegionObj);
    return RegionObj;
}

$(".form-group").on('change', '#type_two_id', function(){
    var id = $(this).val();
    if(id.length == 0) {
        document.getElementById('attr').innerHTML = '';
        return;
    }
    myAjax($("#type_two_id"), '/info/getAttr/'+id, '', function(data){
        for(var i=0; i<data.list.length; i++){
            if(data.list[i].type == 2 || data.list[i].type == 3){
                var tmpArr = data.list[i].value.split("\n");
                data.list[i].len = tmpArr.length;
                data.list[i].obj = [];
                for(var j=0; j<tmpArr.length; j++){
                    var objArr = tmpArr[j].split(":");
                    data.list[i].obj[j] = {};
                    data.list[i].obj[j].key = objArr[0];
                    data.list[i].obj[j].value = objArr[1];
                }
            }
        }
//        console.log(data);
        var html = template('tmpAttr', data);
        document.getElementById('attr').innerHTML = html;
    })
})

function BeforeSubmit(para){
    var imgs = [];
    $("#imgDrag img").each(function(){
        var id = $(this).data('id');
        if(id){
            imgs.push(id);
        }
    });
    para.imgs = imgs;
    return para;
}

function submitHandler(form){
    var para = {};
    for(var i=0; i<form.length; i++){
        if(0 != form[i].name.length && $(form[i]).attr('id') == $(form[i]).attr('name')){
            para[form[i].name] = getFormValue(form[i]);//form[i].value;
        }
    }
    var para = BeforeSubmit(para);
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
        if(!$(form).data('modal') && url){
            //跳转回列表页面
            window.location.href = url;
            return;
        }
        $(".modal").modal('hide');

    }, function(data){
        //操作失败，给出提示
        alert_obj.find("strong").text("操作失败!");
        alert_obj.find("span").text(data.msg);
        alert_obj.addClass('alert-danger').removeClass('alert-success').removeClass('sr-only');
        if(20 == data.code){
            $("#code").click();
        }
    });
}

$.validator.setDefaults({
    submitHandler: function(form) {
        submitHandler(form);
    }
});
$("#form, #myModal").validate({
    errorPlacement:function(error, element){
        $(element).after(error);
    },
    messages:{
        type_one_id:{
            required:"请选择一级分类！",
        },
        type_two_id:{
            required:"请选择二级分类！",
        },
        addr_one_id:{
            required:"请选择所属地区 - 镇！",
        },
        title:{
            required:"请填写信息标题",
        },
        content:{
            required:"请填写信息内容",
        },
        name:{
            required:"请填写联系人",
        },
        phone:{
            required:"请填写联系电话",
        },
        passwd:{
            required:"请填写管理密码",
        },
        vCode:{
            required:"请填写验证码",
            remote:jQuery.validator.format("验证码错误")
        }
    },
    rules:{
        vCode:{
            required:true,
            minlength:4,
            maxlength:4,
            remote:{
                type:"POST",
                url:"/info/add_code_check.html",             
                data:{
                    vCode:function(){return $("#vCode").val();}
                } 
            }
        }
    }
});

//html5图片上传、预览
$("body").on("change", "#fileUpload", function(){
    if(this.files){
        //获取上传文件中的第一个
        var file = this.files[0];
        //文件类型检测
        if(!/image\/\w+/.test(file.type)){
            alert("请选择图片类型的文件！");
            return ;
        }
        //文件大小限制1M
        if(file.size > 2*1024*1024){
            alert("文件大小不能超过2M");
            return ;
        }
    }

    var _this = $(this);
    if(_this.data("click")){
        alert("正在处理中，请稍等");
        return ;
    }

    _this.data('click', 1);
    ajaxFileUpload(_this, "/info/imgUpload", _this.attr("id"), null, function(data){
        $('#target').attr('src', data.msg+'?a='+Math.random());
        $("#JcropModal").modal('show');
    },function(data){
        alert(data.msg);
    });
});

$("#JcropModal").modal({
    backdrop:'static',
    keyboard: false,
    show:false
}).on('show.bs.modal', function (e) {
    //alert('show.bs.modal');
}).on('shown.bs.modal', function (e) {
    //alert('shown.bs.modal');
    $('#target').cropper({
        aspectRatio: 16 / 9,
        autoCropArea: 1,
        crop: function(e) {
          // Output the result data for cropping image.
          $('#x').val(Math.round(e.x));
          $('#y').val(Math.round(e.y));
          $('#w').val(Math.round(e.width));
          $('#h').val(Math.round(e.height));
        },
        dragMode: 'move',
        cropBoxResizable: false,
        guides: false,
        zoomable:false,
        viewMode: 1,
      });
}).on('hide.bs.modal', function (e) {
    //alert('hide.bs.modal');
}).on('hidden.bs.modal', function (e) {
    //alert('hidden.bs.modal');
    $('#target').cropper('destroy');
});

$("#btnCropSure").on('click', function(){
    //个数判断
//    if($('#imgDrag').children().length > 6){
//        alert('图片已经达到上限，无法继续添加');
//        return false;
//    }

    var index = $('#imgDrag').data('index');
    var imgObj = $('#imgDrag img:eq('+index+')');
    
    //参数初始化
    var para = {};
    para.x = $('#x').val();        //起点坐标
    para.y = $('#y').val();        //起点坐标
    para.width = $('#w').val();     //裁剪宽度
    para.height = $('#h').val();    //裁剪高度
    if(!! imgObj.data('id')){
        para.id = imgObj.data('id');
        para.oldimg = imgObj.attr('src');
    }
    
    myAjax($(this), '/info/imgCrop/', para, function(data){
        
        
        if(!imgObj.data('id')){
            //返回id
            var html = template('jsImgAdd', data);
    //        $('#imgDrag').append(html);
            $('#imgDrag > div:last').before(html);
        }else{
            imgObj.attr('src', data.msg);
            imgObj.data('id', data.id);
        }
        $("#JcropModal").modal('hide');
        if($('#imgDrag > div:visible').length > 6){
            $('#imgDrag > div:last').addClass('hide');
        }
//        console.log(data);
//        alert('succ' + data.msg);
    });
});

//添加图片
$('#imgDrag').on('click', 'a', function(){
    var index = $(this).parent().index();
    $('#imgDrag').data('index', index);
//    alert($(this).index());
    $("#fileUpload").click();
})
//删除图片
$('#imgDrag').on('click', '.delImg', function(e){
    var index = $(this).parent().parent().index();
    var imgObj = $('#imgDrag img:eq('+index+')');
    
    var para = {};
    para.id = imgObj.data('id');
    para.oldimg = imgObj.attr('src');
    
    myAjax($(this), '/info/imgDel/', para, function(data){
        $('#imgDrag > div:eq('+index+')').remove();
    })
})
//更新图片
$('#imgDrag').on('click', '.updateImg', function(e){
    var index = $(this).parent().parent().index();
    $('#imgDrag').data('index', index);
    $("#fileUpload").click();
})