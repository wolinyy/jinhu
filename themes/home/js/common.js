
function getFormValue(domEle){
    var val;
    switch(domEle.tagName.toLowerCase()){
        case "input":
            switch(domEle.type.toLowerCase()){
                case "checkbox": 
                    var arr=[];
                    $("input[name='" + $(domEle).attr('name') + "']:checked").each(function(k, v){
                        arr.push(v.value);
                    })
//                    console.log(arr);
                    val = arr.join(',');
                    break;
                case "radio": val = $("input[name='" + $(domEle).attr('name') + "']:checked").val(); break;
                default: val = $.trim($(domEle).val()); break; //text password 
            }
            break;
        case "select" : val = $(domEle).val(); break;
        case "textarea": val = $(domEle).val(); break;
        default: break;
    }
    return val;
}

function setFormValue(id, value){
    var domEle = $("#"+id).get(0);
    if(!domEle) return;
    switch(domEle.tagName.toLowerCase()){
        case "input":
            switch(domEle.type.toLowerCase()){
                case "checkbox": $("input[name='" + $(domEle).attr('name') + "'][value=" + value + "]").prop("checked", true); break;
                case "radio": $("input[name='" + $(domEle).attr('name') + "'][value=" + value + "]").prop("checked", true); break;
                default: $(domEle).val(value); break; //text password 
            }
            break;
        case "select" : $(domEle).val(value); break;
        case "textarea": $(domEle).val(value); break;
        default: break;
    }
}

function myAjax(_this, url, data, succFunc, errorFunc)
{
    if(_this && 1 == _this.data('click')){
        return;
    }
    if(_this){
        _this.data('click', 1);
    }
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: 'json'
    }).done(function(data, textStatus, jqXHR){
        if(_this)
            _this.data('click', 0);
        if(data.result == true || data.code == '0'){
            if(succFunc)
                succFunc(data);
            else
                location.reload();
        }else{
            if(data.code == '10'){
                location.href = "/admin/admin/logout";
                return;
            }
            if(errorFunc)
                errorFunc(data);
            else
                alert(data.msg);
        }
    }).fail(function(jqXHR, textStatus, errorThrown){
        if(_this)
            _this.data('click', 0);
        /*解析错误，基本是要重新登录*/
        if("parsererror"==textStatus){
            alert("返回格式错误");
//            location.reload(true);
            return;
        }
        alert("服务器没有回应！");
    });
}

function ajaxFileUpload(_this, url, fileElementIds, moreData, func, funcErr)
{
    $("#loading").ajaxStart(function(){
        $(this).show();
    }).ajaxComplete(function(){
        $(this).hide(0);
    });
    
    $.ajaxFileUpload({
        url:url, 
        secureuri:false,
        fileElementId:fileElementIds,
        dataType: 'json',
        data:moreData,
        success: function (data, status) {
            _this.data('click', 0);
            $("#loading").hide(0);
            _this.parent().find(".loading").hide(0);
            if (data.result) {
                func(data);
            }else{
                funcErr(data);
            }
        },
        error: function (data, status, e) {
            _this.data('click', 0);
            $("#loading").hide(0);
            _this.parent().find(".loading").hide(0);
            alert("文件上传出错");
        }
    })

    return false;
}

function isExitsFunction(funcName) {
    try {
        if (typeof(eval(funcName)) == "function") {
            return true;
        }
    } catch(e) {}
    return false;
}

function getDays(strDateStart,strDateEnd){
   var strSeparator = "-"; //日期分隔符
   var oDate1;
   var oDate2;
   var iDays;
   oDate1= strDateStart.split(strSeparator);
   oDate2= strDateEnd.split(strSeparator);
   var strDateS = new Date(oDate1[0], oDate1[1]-1, oDate1[2]);
   var strDateE = new Date(oDate2[0], oDate2[1]-1, oDate2[2]);
   iDays = parseInt(Math.abs(strDateS - strDateE ) / 1000 / 60 / 60 /24)//把相差的毫秒数转换为天数 
   return iDays ;
}

Date.prototype.Format = function(format){ 
    var o = { 
    "M+" : this.getMonth()+1, //month 
    "d+" : this.getDate(), //day 
    "h+" : this.getHours(), //hour 
    "m+" : this.getMinutes(), //minute 
    "s+" : this.getSeconds(), //second 
    "q+" : Math.floor((this.getMonth()+3)/3), //quarter 
    "S" : this.getMilliseconds() //millisecond 
    } 

    if(/(y+)/.test(format)) { 
    format = format.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length)); 
    } 

    for(var k in o) { 
    if(new RegExp("("+ k +")").test(format)) { 
    format = format.replace(RegExp.$1, RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length)); 
    } 
    } 
    return format; 
} 

function getDayArr(strDateStart,strDateEnd){
   var days = getDays(strDateStart, strDateEnd);

   var oDate1 = strDateStart.split("-");
   var strDate = new Date(oDate1[0], oDate1[1]-1, oDate1[2]);
   var dayArr = [];
   var tmpDate = new Date();
   for(var i=0; i<=days; i++){
       tmpDate.setTime(strDate.getTime()+i*24*60*60*1000);
       dayArr.push(tmpDate.Format("yyyy-MM-dd"));
   }
   return dayArr;
}

function strTruncate(str,len){
    if(!len) len = 22;
    if(str.length >len){
        return str.substr(0, len)+'...';
    }else
        return str;
}

function clone(obj){  
    var o;  
    switch(typeof obj){  
    case 'undefined': break;  
    case 'string'   : o = obj + '';break;  
    case 'number'   : o = obj - 0;break;  
    case 'boolean'  : o = obj;break;  
    case 'object'   :  
        if(obj === null){  
            o = null;  
        }else{  
            if(obj instanceof Array){  
                o = [];  
                for(var i = 0, len = obj.length; i < len; i++){  
                    o.push(clone(obj[i]));  
                }  
            }else{  
                o = {};  
                for(var k in obj){  
                    o[k] = clone(obj[k]);  
                }  
            }  
        }  
        break;  
    default:          
        o = obj;break;  
    }
    return o;
}

function sec2day(sec){
    var day = Math.floor(sec / 60 / 60 / 24);
    var hour = Math.floor(sec /60 /60 % 24);
    var min = Math.floor(sec / 60 % 60);
    return day + '天' + hour + '时' + min + '分';
}

/* jQuery.validatora自定义函数 */
if(jQuery.validator){
    // 中文字两个字节
    jQuery.validator.addMethod("byteRangeLength", function(value, element, param) {
        var length = value.length;
        for(var i = 0; i < value.length; i++){
            if(value.charCodeAt(i) > 127){
                length++;
            }
        }
      return this.optional(element) || ( length >= param[0] && length <= param[1] );   
    }, $.validator.format("请确保输入的值在{0}-{1}个字节之间(一个中文字算2个字节)"));

    // 邮政编码验证   
    jQuery.validator.addMethod("isZipCode", function(value, element) {
        var tel = /^[0-9]{6}$/;
        return this.optional(element) || (tel.test(value));
    }, "请正确填写您的邮政编码");

    // 手机号码验证   
    jQuery.validator.addMethod("isPhone", function(value, element) {
        var tel = /^1[0-9]{10}$/;
        return this.optional(element) || (tel.test(value));
    }, "请正确填写您的手机号码");

}

//告警信息提示
function show_hint (para, select){
    if(!select) select = "#alert-hint";
    if(!para){ //隐藏
        $(select).addClass('sr-only');
        return;
    }else if(0 == para.code || true==para.result){
        $(select + " strong").text("操作成功!");
        $(select + " span").text('');
        $(select).addClass('alert-success').removeClass('alert-danger').removeClass('sr-only');
    }else{
        $(select + " strong").text("操作失败!");
        $(select + " span").text(para.msg);
        $(select).addClass('alert-danger').removeClass('alert-success').removeClass('sr-only');
    }
    location.href = "#";
}