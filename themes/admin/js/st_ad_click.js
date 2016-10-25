
function ajaxChart(flushData){
    //参数获取
    var para = getPara(flushData);
//    console.log();
    myAjax($(".sure"), $("#chart").data('url') + para.funcName, para, function(data){
        doDayChart(data);
    })
}

function flushData(data){
    flushDataInit();
    
    //刷新数据
    if(data.sum){
        var dayLen = getDays(data.para.st, data.para.et)+1;
        if(data.sum.total_cpm) $(".avg_adCPM").text((parseFloat(data.sum.total_cpm)/dayLen).toFixed(0));
        if(data.sum.total_cpc) $(".avg_adClickCnt").text((parseFloat(data.sum.total_cpc)/dayLen).toFixed(0));
        if(data.sum.total_click_ratio) $(".avg_adClickRatio").text((parseFloat(data.sum.total_click_ratio*100)/dayLen).toFixed(2) + '%');
        if(data.yesterday.length!=0){
            $(".yester_adCPM").text(data.yesterday.cpm);
            $(".yester_adClickCnt").text(data.yesterday.cpc);
            $(".yester_adClickRatio").text(data.yesterday.portal_click_ratio*100+"%");
        }else{
            $(".yester_adCPM").text('-');
            $(".yester_adClickCnt").text('-');
            $(".yester_adClickRatio").text('-');
        }
        $("#adTimeTop").empty();
        $("#adHisTop").empty();
        if(data.timeTop.length!=0){
            for(var i=0; i<data.timeTop.length; i++){
                $("#adTimeTop").append("<tr title='"+data.timeTop[i].url+"'><td>"+strTruncate(data.timeTop[i].url)+"</td><td>"+(parseFloat(data.timeTop[i].cnt)/dayLen).toFixed(0)+"</td><td>"+data.timeTop[i].yester_cnt+"</td></tr>");
            }
        }else{
            $("#adTimeTop").append("<tr><td colspan=3><span class='text-center clearfix'>暂无数据</span></td></tr>");
        }
        if(data.hisTop.length!=0){
            for(var i=0; i<data.hisTop.length; i++){
                $("#adHisTop").append("<tr title='"+data.hisTop[i].url+"'><td>"+strTruncate(data.hisTop[i].url)+"</td><td>"+data.hisTop[i].cnt+"</td></tr>");
            }
        }else{
            $("#adHisTop").append("<tr><td colspan=2><span class='text-center clearfix'>暂无数据</span></td></tr>");
        }
    }
}