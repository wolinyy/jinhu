$(function(){
    init();
});

//页面打开初始化
function init(){
    ajaxChart(1);
}

//表格选项切换事件
$(".myChart").click(function(){
    chartTypeChange(this);
})

//确定按钮点击 - 刷新数据
$(".sure").click(function(){
    ajaxChart(1);
})

var active_class = "text-primary";

function flushDataInit(){
    $("table tbody td:not(:first-child) span").text("");
}

function chartTypeChange(obj){
    if($(obj).children().hasClass(active_class)){
        return false;   //重复点击 - 不处理
    }
    
    //样式改变 - active图标
    $("." + active_class).removeClass(active_class);
    $(obj).children().addClass(active_class);
    
    //样式改变 - 是否显示日期
    switch($(obj).data('what')){
        case 'olManCnt':
            $("#type").removeClass("hide");
            break;
        default:
            var dayId = "#day";
            $("#type").addClass("hide");
            $("#type li").removeClass("active"); 
            $("#type li a[href='"+dayId+"']").parent().addClass("active"); 
            break;
    }
    
    ajaxChart(0);
}

function getFuncName(para){
    var ret = para.chartType;
    if(para.type) ret += '_'+para.type.substr(1);
    return ret;
}

function getPara(flushData){
    var para = {};
    para.chartType = $("."+active_class).parent().data("what");
    para.st = $("#st").val();
    para.et = $("#et").val();
    para.type = $("#type li.active a").attr('href');
    if(flushData && flushData==1){
        //确定按钮点击 刷新表格数据
        para.flushData = 1;
    }else{
        para.flushData = 0;
    }
    var funcName = getFuncName(para);
    para.funcName = funcName;
//    console.log(JSON.stringify(para));  //调试时打开
    return para;
}

function getOption(){
    var option = {
        title : {text: '某地区蒸发量和降水量',subtext: '纯属虚构'},
        tooltip : {trigger: 'axis'},
        legend: {y:"bottom",data:['总数']},
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [{type : 'category',boundaryGap : false,data : ['1月','2月','3月']}],
        yAxis : [{type : 'value'}],
        color:[
            '#ff7f50', '#87cefa', '#da70d6', '#32cd32', '#6495ed',
            '#ff69b4', '#ba55d3', '#cd5c5c', '#ffa500', '#40e0d0',
            '#1e90ff', '#ff6347', '#7b68ee', '#00fa9a', '#ffd700',
            '#6b8e23', '#ff00ff', '#3cb371', '#b8860b', '#30e0e0' 
        ],
        series : [ {
                name:'总数',
                type:'bar', smooth:true,
                itemStyle: {normal: {areaStyle: {type: 'default'}}},
                data:[2.0, 4.9, 7.0],
                markLine : {data : [ {type : 'average', name: '平均值'}]}
        } ]
    };
    return option;
}

function getPieOption(){
    var option = {
        title : { text: '认证', subtext: '认证比例',},
        tooltip : { trigger: 'item', formatter: "{a} <br/>{b} : {c} ({d}%)"},
        legend: {y:"bottom",data:[]},
        toolbox: { show : true, feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : { show: true,  type: ['pie'], },
                restore : {show: true},
                saveAsImage : {show: true}
        } }, calculable : true,
        series : [ { name:'访问来源', type:'pie', radius : '55%', center: ['50%', '50%'], data:[],
                 itemStyle: {
                    emphasis: { shadowBlur: 10, shadowOffsetX: 0, shadowColor: 'rgba(0, 0, 0, 0.5)' },
                    normal:{  label:{ show: true, formatter: '{b} : {c} ({d}%)' }, labelLine :{show:true} } 
                } } ]
    };
  return option;
}

function setOption(option, para, len){
    option.title.text = $(" ." + active_class).parent().text();
    if(0==option.title.text.length){
        option.title.text = $("#sub_nav .active a").text();
    }
    option.title.text+=" (" + len +"天)";
    option.title.subtext = para.st + " ~ " + para.et;
    if(option.yAxis){
        if(para.chartType && para.chartType.toLowerCase().indexOf("ratio")>=0)
            option.yAxis[0].max = 0.9;
        else
            delete option.yAxis[0].max;
    }
    
    var graphic = echarts.init(document.getElementById('graphic'));
    graphic.clear();
    graphic.setOption(option);
    window.onresize = graphic.resize;
}

function doDayChart(data){
    var chart = data.chart;
    var para = data.para;
    var dayArr = getDayArr(data.para.st, data.para.et);

    //刷新数据
    if(1 == para.flushData) flushData(data);
    
    //绘图 全局变量
    var option = getOption();
    option.xAxis[0].data = [];
    option.series[0].data = [];
    for(var i=0; i<dayArr.length; i++){
        option.xAxis[0].data.push(dayArr[i]);
        for(var j=0; j<chart.length; j++){
            if(dayArr[i] == chart[j].date){
                option.series[0].data.push(parseFloat(chart[j].cnt));
                break;
            }
        }
        if(option.xAxis[0].data.length > option.series[0].data.length)
            option.series[0].data.push(0);
    }
    
    setOption(option, para, dayArr.length);
}

//饼状图
function DoPieChart(data, title, items){
    var chart = data.chart;
    var para = data.para;
    var dayArr = getDayArr(data.para.st, data.para.et);

    //刷新数据
    if(1 == para.flushData) flushData(data);
    
    var option=getPieOption();
    for(var i in items){
        if(chart[i]!=false){
            option.legend.data.push(items[i]);
            option.series[0].data.push({value:chart[i], name:items[i]});
        }
    }
    
    setOption(option, para, dayArr.length);
}
