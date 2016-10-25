/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var info_type = typeInit();
    var info_region = regionInit();
    
    searchInit();
})

function searchInit(){

    var type_one_id = $('#type_one_id').data('val');
    var type_two_id = $('#type_two_id').data('val');
    if(type_one_id && type_one_id.length != 0){
        $('#type_one_id').val(type_one_id);
        $('#type_one_id').change();
    }
    if(type_two_id && type_two_id.length != 0){
        $('#type_two_id').val(type_two_id);
    }
    
    var addr_one_id = $('#addr_one_id').data('val');
    var addr_two_id = $('#addr_two_id').data('val');
    if(addr_one_id && addr_one_id.length != 0){
        $('#addr_one_id').val(addr_one_id);
        $('#addr_one_id').change();
    }
    if(addr_two_id && addr_two_id.length != 0){
        $('#addr_two_id').val(addr_two_id);
    }
}

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

$('#searchBtn').on('click', function(){
    var para = getSearchPara();
    
    var url = document.URL.substring(document.URL, document.URL.indexOf('?'));
    url = getSearchUrl(para, url);
    
//    console.log(url);
    window.location.href = url;
});

function getSearchPara(){
    var para = {};
    $('#searchBox .field').each(function(k,v){
        var val = $(v).val();
        if(val && val.length != 0){
            para[$(v).attr('name')] = val;
        }
    });
    
    return para;
}

function getSearchUrl(para, url){
    
    for(k in para){
        if(para[k].length==0) continue;
        if(url.indexOf('?') < 0){
            url += '?'+k+'='+para[k];
        }else{
            url += '&'+k+'='+para[k];
        }
    }

    return url;
}


//前一页 点击
$('.pager li:first').on('click', function(){
    
    if($(this).hasClass('disabled'))
        return;
    
    var url = document.URL.substring(document.URL, document.URL.indexOf('?'));
    url = getParamUrl(param, url);
    
    url = getPageUrl(this, url);
    
    window.location.href = url;
})

//后一页 点击
$('.pager li:last').on('click', function(){
    
    if($(this).hasClass('disabled'))
        return;
    
    var url = document.URL.substring(document.URL, document.URL.indexOf('?'));
    url = getParamUrl(param, url);
    url = getPageUrl(this, url);
    
    window.location.href = url;
})

function getPageUrl(obj, url){
    var pageNow = $(obj).data('go');
    if(url.indexOf('?') < 0){
        url += '?pageNow='+pageNow;
    }else{
        url += '&pageNow='+pageNow;
    }
    
    return url;
}
function getParamUrl(param, url){
    
    for(k in param){
        if(param[k].length==0) continue;
        if(url.indexOf('?') < 0){
            url += '?'+k+'='+param[k];
        }else{
            url += '&'+k+'='+param[k];
        }
    }

    return url;
}
