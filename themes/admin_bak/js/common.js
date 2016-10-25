
function getFormValue(domEle){
    var val;
    switch(domEle.tagName.toLowerCase()){
        case "input":
            switch(domEle.type.toLowerCase()){
                case "checkbox": val = ($(domEle).prop("checked")?"1":"0"); break;
                case "radio": val = $("input[name='" + $(domEle).attr('name') + "']:checked").val(); break;
                default: val = $.trim($(domEle).val()); break; //text password 
            }
            break;
        case "select" : val = $(domEle).val(); break;
        case "textarea": val = $(domEle).text(); break;
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
        case "textarea": $(domEle).text(value); break;
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