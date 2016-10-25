
function ajaxChart(flushData){
    //参数获取
    var para = getPara(flushData);
//    console.log();
    myAjax($(".sure"), $("#chart").data('url') + para.funcName, para, function(data){
        time_shareDoDayChart(data);
    })
}

function flushData(data){
    //刷新数据
    if(!data.sum) return;
    var tb = $("#tb_time_share");
    tb.empty();
    var sum, yester;
    var len = 24;
    for(var i=0; i<len;i++){
        sum = yester = 0;
        for(var j=0;j<data.sum.length;j++){
            if(data.sum[j].hour < i) continue;
            else if(data.sum[j].hour == i){ sum = data.sum[j].total; break; }
            else if(data.sum[j].hour > i){ break; }
        }
        for(var j=0;j<data.yesterday.length;j++){
            if(data.yesterday[j].hour < i) continue;
            else if(data.yesterday[j].hour == i){ yester = data.yesterday[j].total; break; }
            else if(data.yesterday[j].hour > i){ break; }
        }
        tb.append("<tr><td>"+i+"-"+(i+1)+"</td><td>"+sum+"</td><td>"+yester+"</td><tr>");
    }
}

function time_shareDoDayChart(data){
    //    alert(JSON.stringify(data.para));
    var chart = data.chart;
    var para = data.para;
    var hour_min = 0;
    var hour_max = 24;
    var unit = "时";
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
    
    for(var i=hour_min; i<hour_max; i++){
        option.xAxis[0].data.push(i+'-'+(i+1)+unit);
        for(var j=0; j<chart.one.length; j++){
            if(i == chart.one[j].hour){
                option.series[0].data.push(parseFloat(chart.one[j].keep_number));
                option.series[1].data.push(parseFloat(chart.one[j].new_number));
                break;
            }
        }
        if(option.xAxis[0].data.length > option.series[0].data.length) option.series[0].data.push(0);
        if(option.xAxis[0].data.length > option.series[1].data.length) option.series[1].data.push(0);
    }
    
    //console.log(option);
    option.legend.data = ['留存数', '新增数'];
    
    setOption(option, para, dayArr.length);
}