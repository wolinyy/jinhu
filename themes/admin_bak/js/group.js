$(function(){
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setShowModalAddCustom(function(data){
        ShowModalAddCustom(data);
    }).setShowModalEditCustom(function(data){
        ShowModalEditCustom(data);
    }).init();
});

function ShowModalAddCustom(){
    $(".select-ajax").select2("val", "");
    collapse_radio_5g_enable();
    collapse_radio_5g_open();
}

function ShowModalEditCustom(data){
    //数据清空初始化
    $("#ssid_id_2gs").empty();
    $("#ssid_id_5gs").empty();
    
    //radio标签值修改
    $("input[name='radio_type_2g'][value=1]").prop('checked', true);
    $("input[name='radio_type_5g'][value=1]").prop('checked', true);
    
    //数据赋值初始化
    if(data.radio_ssids_0 && 0!=data.radio_ssids_0.length){
        var wlanConf = data.radio_ssids_0;
        for(var i=0; i<wlanConf.length; i++){
            $("#ssid_id_2gs").append('<option value="'+ (wlanConf[i].ssid_id + '-' + wlanConf[i].ssid_enctype) +'" selected>'+ wlanConf[i].wlan_name +'</option>');
        }
    }
    if(data.radio_ssids_1 && 0!=data.radio_ssids_1.length){
        var wlanConf = data.radio_ssids_1;
        for(var i=0; i<wlanConf.length; i++){
            $("#ssid_id_5gs").append('<option value="'+ (wlanConf[i].ssid_id + '-' + wlanConf[i].ssid_enctype) +'" selected>'+ wlanConf[i].wlan_name +'</option>');
        }
    }
    select_init();
    collapse_radio_5g_enable();
    collapse_radio_5g_open();
}

function getSsid(list){
    if(list){
        var ssidStr_tmp = "";
        var cnt_tmp = 0;
        var wlanConf;
        var arr=[];
        for(var j=0; j<list.length; j++){
            wlanConf = list[j];
            if(2 == wlanConf.ssid_enctype){
                if(!arr[wlanConf.ssid_id]){
                    arr[wlanConf.ssid_id] = 1;
                    //两种编码
                    ssidStr_tmp += '<span class="label label-primary">'+wlanConf.wlan_name+'</span>&nbsp;';
                    cnt_tmp += 2;
                }
            }else {
                //gb2312
                ssidStr_tmp += '<span class="label ' + (1 == wlanConf.ssid_enctype?'label-success':'label-warning') + '">'+wlanConf.wlan_name+'</span>&nbsp;';
                cnt_tmp += 1;
            }
        }
    }
    var obj = {ssidStr:ssidStr_tmp, cnt:cnt_tmp};
    return obj;
}

function TableRefresh(_self){
    var list = _self.data.list;
    var page = _self.data.pagination;
    var tbody = $("table tbody");
    tbody.empty();
    for(var i=0; i<list.length; i++){
        var obj_2G = getSsid(list[i].radio_ssids_0);
        var obj_5G = getSsid(list[i].radio_ssids_1);
        
        var Str = "";
        if(obj_2G.cnt && 0!=obj_2G.cnt){
            Str += '<span class="label label-default">2G :</span>&nbsp;&nbsp;' + obj_2G.ssidStr + '&nbsp;<span class="label label-default">'+obj_2G.cnt+'个</span>';
        }
        if(obj_5G.cnt && 0!=obj_5G.cnt){
            Str += (0!=obj_2G.cnt?"<br />":"") + '<span class="label label-default">5G :</span>&nbsp;&nbsp;' + obj_5G.ssidStr + '&nbsp;<span class="label label-default">'+obj_5G.cnt+'个</span>';
        }
        tbody.append(
            '<tr><td><label class="checkbox-inline">&nbsp;'
            + '<input type="checkbox" value="' + list[i].id + '">'
            + ((page.page_now-1)*page.page_size+i+1) + '</label>'
            + '</td><td>' + list[i].name
            + '</td><td>' + (1==list[i].ssids_enable?"打开":"关闭")
            + '</td><td>' + Str
            +'</td>'
            + _self.ShowOperate(i)
            +'</tr>'
        );
    }
}

function collapse_radio_5g_open(){
    $('#radio_5g_open').collapse(0!=$('input[name="radio_type_2g"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="radio_type_2g"]', function(){
    collapse_radio_5g_open();
})

function collapse_radio_5g_enable(){
    $('#radio_5g_enable').collapse(0!=$('input[name="radio_type_5g"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="radio_type_5g"]', function(){
    collapse_radio_5g_enable();
})