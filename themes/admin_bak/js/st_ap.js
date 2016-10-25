
function ajaxChart(flushData){
    //参数获取
    var para = getPara(flushData);
//    console.log();
    myAjax($(".sure"), $("#chart").data('url') + para.funcName, para, function(data){
        ap_runStatDoDayChart(data);
    })
}

function flushData(data){
    flushDataInit();
    
    var now_ol_nums = data.now_ol_nums;
    if(now_ol_nums)
        $(".hisTotal").text(now_ol_nums.online_num + " / " + now_ol_nums.total_num);
    if(data.sum && data.sum.online_cnt){
        var dayLen = getDays(data.para.st, data.para.et)+1;
        var sum_all = parseInt(data.sum.offline_cnt, 10) + parseInt(data.sum.online_cnt, 10);
        $(".avg_apStat").text(Math.round(data.sum.online_cnt/dayLen) + " / " + Math.round(sum_all/dayLen));
        $(".yester_apStat").text(data.yesterday.online_cnt + " / " + (parseInt(data.yesterday.offline_cnt, 10)+parseInt(data.yesterday.online_cnt)));
    }
}

function ap_runStatDoDayChart(data){
    //    alert(JSON.stringify(data.para));
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
    option.series[0].name = "在线数";
    option.series[0].stack = 'one';
    option.series[0].data = [];
    
    option.series.push(clone(series_obj));
    option.series[1].name = "离线数";
    option.series[1].stack = 'one';
    option.series[1].data = [];
    
    for(var i=0; i<dayArr.length; i++){
        option.xAxis[0].data.push(dayArr[i]);
        for(var j=0; j<chart.length; j++){
            if(dayArr[i] == chart[j].date){
                option.series[0].data.push(chart[j].online_cnt);
                option.series[1].data.push(chart[j].offline_cnt);
                break;
            }
        }
        if(option.xAxis[0].data.length > option.series[0].data.length){
            option.series[0].data.push(0);
            option.series[1].data.push(0);
        }
    }
    //console.log(option);
    option.legend.data = ['在线数', '离线数'];
    
    setOption(option, para, dayArr.length);
}