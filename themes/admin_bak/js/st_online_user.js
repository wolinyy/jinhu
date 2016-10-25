
function ajaxChart(flushData){
    //参数获取
    var para = getPara(flushData);
//    console.log();
    myAjax($(".sure"), $("#chart").data('url') + para.funcName, para, function(data){
        switch(para.chartType){
            case 'AuthAllCnt': authAllDoDayChart(data);break;
            case 'AuthSysCnt': authAllSysChart(data);break;
            default: doDayChart(data);break;
        }
    })
}

function flushData(data){
    flushDataInit();
    
    //刷新数据
    if(data.sum && data.sum.total_auth_all){
        var sum_total = data.sum.total_auth_all;
        var yester_total = data.yesterday.auth_ok_count;
        if("0" == sum_total) sum_total = 1;
        if("0" == yester_total) yester_total = 1;
        
        $(".sum_smsCnt").text(data.sum.total_account);
        $(".sum_wechatCnt").text(data.sum.total_wechat);
        $(".sum_oneKeyCnt").text(data.sum.total_onekey);
        $(".sum_freeCnt").text(data.sum.total_free);
        $(".sum_appCnt").text(data.sum.total_app);
        $(".sum_noAuthCnt").text(data.sum.total_noauth);
        $(".sum_AuthAllCnt").text(data.sum.total_auth_all);
        $(".sum_sysAppleCnt").text(data.sum.total_sys_apple);
        $(".sum_sysAndroidCnt").text(data.sum.total_sys_android);
        $(".sum_sysOtherCnt").text(data.sum.total_sys_other);
        //终端类型数据会有不准问题
//        $(".sum_sysPCCnt").text(data.sum.total_sys_pc);
        var total_sys_pc = data.sum.total_auth_all-data.sum.total_sys_apple-data.sum.total_sys_android-data.sum.total_sys_other;
        $(".sum_sysPCCnt").text(total_sys_pc);
        
        $(".ratio_smsCnt").text(parseFloat(data.sum.total_account*100/sum_total).toFixed(2) + '%');
        $(".ratio_wechatCnt").text(parseFloat(data.sum.total_wechat*100/sum_total).toFixed(2) + '%');
        $(".ratio_oneKeyCnt").text(parseFloat(data.sum.total_onekey*100/sum_total).toFixed(2) + '%');
        $(".ratio_freeCnt").text(parseFloat(data.sum.total_free*100/sum_total).toFixed(2) + '%');
        $(".ratio_appCnt").text(parseFloat(data.sum.total_app*100/sum_total).toFixed(2) + '%');
        $(".ratio_noAuthCnt").text(parseFloat(data.sum.total_noauth*100/sum_total).toFixed(2) + '%');
        $(".ratio_sysAppleCnt").text(parseFloat(data.sum.total_sys_apple*100/sum_total).toFixed(2) + '%');
        $(".ratio_sysAndroidCnt").text(parseFloat(data.sum.total_sys_android*100/sum_total).toFixed(2) + '%');
        $(".ratio_sysOtherCnt").text(parseFloat(data.sum.total_sys_other*100/sum_total).toFixed(2) + '%');
        $(".ratio_sysPCCnt").text(parseFloat(total_sys_pc*100/sum_total).toFixed(2) + '%');
        
        if(data.yesterday.length!=0){
            $(".yester_smsCnt").text(data.yesterday.auth_account_ok_count);
            $(".yester_wechatCnt").text(data.yesterday.auth_wechat_ok_count);
            $(".yester_oneKeyCnt").text(data.yesterday.auth_onekey_ok_count);
            $(".yester_freeCnt").text(data.yesterday.auth_free_count);
            $(".yester_appCnt").text(data.yesterday.auth_app_ok_count);
            $(".yester_noAuthCnt").text(data.yesterday.auth_noauth_count);
            $(".yester_AuthAllCnt").text(data.yesterday.auth_ok_count);
            $(".yester_sysAppleCnt").text(data.yesterday.system_apple);
            $(".yester_sysAndroidCnt").text(data.yesterday.system_android);
            $(".yester_sysOtherCnt").text(data.yesterday.system_other);
            $(".yester_sysPCCnt").text(data.yesterday.system_pc);
            var system_pc = data.yesterday.auth_ok_count - data.yesterday.system_apple - data.yesterday.system_android - data.yesterday.system_other;
            $(".yester_sysPCCnt").text(system_pc);
        }
    }
}

function authAllDoDayChart(data){
    DoPieChart(data, '认证方式', {
        total_account:'短信',
        total_wechat:'微信',
        total_onekey:'一键认证',
        total_free:'免费体检',
        total_app:'APP',
        total_noauth:'免认证'
    });
}
//设备系统饼图
function authAllSysChart(data){
    DoPieChart(data, '设备系统构成', {
        total_sys_apple:'IOS',
        total_sys_android:'安卓系统',
        total_sys_other:'其他手机',
        total_sys_pc:'PC'
    });
}