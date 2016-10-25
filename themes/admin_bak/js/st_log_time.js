////周期变更事件
//$("#type li").click(function(){
//    $("#type li").removeClass("active");
//    $(this).addClass("active");
//    ajaxChart(0);
//})

//var active_class = "text-primary";

function ajaxChart(flushData){
    //参数获取
    var para = getPara(flushData);
    myAjax($(".sure"), $("#chart").data('url') + para.funcName, para, function(data){
        switch(para.type){
            case '#half_hour': doHalfHourChart(data); break;
            default: 
                switch(para.chartType){
                    case 'oldAndNew': oldAndNewDoDayChart(data);break;
                    default: doDayChart(data);break;
                }
                break;
        }
    })
}

function flushData(data){
    flushDataInit();
    
    if(data.sum){
        var dayLen = getDays(data.para.st, data.para.et)+1;
        
        $(".sum_oltimeCnt").text(data.sum.total_ol_cnt);
        $(".sum_olmanCnt").text(data.sum.total_ol_nums);
        $(".sum_PopCnt").text(data.sum.total_pop_cnt);
        $(".sum_PopManCnt").text(data.sum.total_pop_nums);
        $(".sum_timeCnt").text(data.sum.total_authed_cnt);
        $(".sum_manCnt").text(data.sum.total_authed_nums);
        $(".sum_oldAndNew").text(data.sum.total_new_nums + ' - ' + data.sum.total_old_nums);
        
        $(".avg_oltimeCnt").text((parseFloat(data.sum.total_ol_cnt)/dayLen).toFixed(0));
        $(".avg_olmanCnt").text((parseFloat(data.sum.total_ol_nums)/dayLen).toFixed(0));
        $(".avg_PopCnt").text((parseFloat(data.sum.total_pop_cnt)/dayLen).toFixed(0));
        $(".avg_PopManCnt").text((parseFloat(data.sum.total_pop_nums)/dayLen).toFixed(0));
        $(".avg_timeCnt").text((parseFloat(data.sum.total_authed_cnt)/dayLen).toFixed(0));
        $(".avg_manCnt").text((parseFloat(data.sum.total_authed_nums)/dayLen).toFixed(0));
        $(".avg_oldAndNew").text((parseFloat(data.sum.total_new_nums)/dayLen).toFixed(0) + ' - ' + (parseFloat(data.sum.total_old_nums)/dayLen).toFixed(0));

        if(data.yesterday.length!=0){
            $(".yester_olTimeCnt").text(data.yesterday.sta_connect_count);
            $(".yester_olManCnt").text(data.yesterday.sta_peo_count);
            $(".yester_PopCnt").text(data.yesterday.portal_pop_count);
            $(".yester_PopManCnt").text(data.yesterday.portal_pop_peo_count);
            $(".yester_timeCnt").text(data.yesterday.auth_ok_count);
            $(".yester_manCnt").text(data.yesterday.auth_ok_peo_count);
            $(".yester_oldAndNew").text(data.yesterday.sta_new_count + ' - ' + data.yesterday.sta_old_count);
        }
        
        var hisTotal = data.hisTotal;
        if(hisTotal){
            $(".total_ol_nums").text(hisTotal.total_ol_nums?hisTotal.total_ol_nums:0);
            $(".total_auth_nums").text(hisTotal.total_auth_nums?hisTotal.total_auth_nums:0);
            $(".now_ol_nums").text(hisTotal.now_ol_nums);
        }
    }
}

/*
 * half_hour 1-48
 */
function halfHourToTime(half_hour){
    var st,et;
    st = Math.floor((half_hour-1)%48/2)+":"+(half_hour%2?"00":"30");
    et = Math.floor(half_hour%48/2)+":"+(half_hour%2?"30":"00");
    return st+"~"+et;
}

function doHalfHourChart(data){
    var chart = data.chart;
    var para = data.para;
    var dayArr = getDayArr(data.para.st, data.para.et);
    
    //刷新数据
    if(1 == para.flushData) flushData(data);
    
    //绘图
    var option = getOption();
    option.xAxis[0].data = [];
    option.series[0].data = [];
    for(var i=0; i<48; i++){
        option.xAxis[0].data.push(halfHourToTime(i+1));
        for(var j=0; j<chart.length; j++){
            if((i+1) == chart[j].half_hour){
                option.series[0].data.push(chart[j].cnt);
                break;
            }
        }
        if(option.xAxis[0].data.length > option.series[0].data.length)
            option.series[0].data.push(0);
    }
    
    setOption(option, para, dayArr.length);
}

function oldAndNewDoDayChart(data){
    var chart = data.chart;
    var para = data.para;
    var dayArr = getDayArr(data.para.st, data.para.et);
    
    //刷新数据
    if(1 == para.flushData) flushData(data);
    
    //绘图 局部变量
    var option = getOption();
    option.xAxis[0].data = [];
    var series_obj = option.series[0];
    delete series_obj.markLine;
    option.series = [];
    option.series.push(clone(series_obj));
    option.series[0].name = "留存数";
    option.series[0].stack = 'one';
    option.series[0].data = [];
    
    option.series.push(clone(series_obj));
    option.series[1].name = "新增数";
    option.series[1].stack = 'one';
    option.series[1].data = [];
    
    for(var i=0; i<dayArr.length; i++){
        option.xAxis[0].data.push(dayArr[i]);
        for(var j=0; j<chart.length; j++){
            if(dayArr[i] == chart[j].date){
                option.series[0].data.push(parseFloat(chart[j].old_cnt));
                option.series[1].data.push(parseFloat(chart[j].new_cnt));
                break;
            }
        }
        if(option.xAxis[0].data.length > option.series[0].data.length){
            option.series[0].data.push(0);
            option.series[1].data.push(0);
        }
    }
    
    option.legend.data = ['留存数', '新增数'];
    setOption(option, para, dayArr.length);
}