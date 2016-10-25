/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$().ready(function(){
    $(".scrollLoading").scrollLoading();
});

//属性 点击
$('.attr li a').on('click', function(){
    
    var attr=getAttrArr();

    var id = $(this).parents('ul').data('id');
    var v = $(this).parent('li').data('val');
    attr[id] = v;

//    console.log(attr);
    var url = getAttrUrl(attr);
    var region = getRegionArr();
    url = getRegionUrl(region, url);
    
    window.location.href = url;
})

//区域 点击
$('.region li a').on('click', function(){
    
    var attr=getAttrArr();
    
    var url = getAttrUrl(attr);
    var region = getRegionArr();
    var key = $(this).parents('ul').data('name');
    var val = $(this).parent('li').data('id');
    
    if(key == 'rpid'){
        region = {};
    }
    if(val && val.length != 0)
        region[key] = val;
    
    url = getRegionUrl(region, url);
    
//    console.log(url);
//    return;
    
    window.location.href = url;
})

//前一页 点击
$('.pager li:first').on('click', function(){
    
    if($(this).hasClass('disabled'))
        return;
    
    var attr=getAttrArr();
    var region = getRegionArr();
    var url = getAttrUrl(attr);
    url = getRegionUrl(region, url);
    url = getPageUrl(this, url);
    
    window.location.href = url;
})

//后一页 点击
$('.pager li:last').on('click', function(){
    
    if($(this).hasClass('disabled'))
        return;
    
    var attr=getAttrArr();
    var region = getRegionArr();
    
    var url = getAttrUrl(attr);
    url = getRegionUrl(region, url);
    url = getPageUrl(this, url);
    
    window.location.href = url;
})

function getAttrArr(){
    var attr={};
    $('.attr').each(function(k, v){
        var val = $(v).find('.active').data('val');
        if(val && val.length != 0){
            attr[$(v).data('id')] = val;
        }
    });
    return attr;
}

function getAttrUrl(attr){
    var url = document.URL.substring(document.URL, document.URL.indexOf('?'));
     
    for(k in attr){
        if(attr[k].length==0) continue;
        if(url.indexOf('?') < 0){
            url += '?attr['+k+']='+attr[k];
        }else{
            url += '&attr['+k+']='+attr[k];
        }
    }

    return url;
}

function getPageUrl(obj, url){
    var pageNow = $(obj).data('go');
    if(url.indexOf('?') < 0){
        url += '?pageNow='+pageNow;
    }else{
        url += '&pageNow='+pageNow;
    }
    
    return url;
}

function getRegionArr(){
    var region={};
    $('.region').each(function(k, v){
        var val = $(v).find('.active').data('id');
        if(val && val.length != 0){
            region[$(v).data('name')] = val;
        }
    });
//    console.log(region);
    return region;
}

function getRegionUrl(region, url){
    for(k in region){
//        console.log(k + ' - ' + region[k]);
        if(region[k].length==0) continue;
        if(url.indexOf('?') < 0){
            url += '?'+k+'='+region[k];
        }else{
            url += '&'+k+'='+region[k];
        }
    }

    return url;
}