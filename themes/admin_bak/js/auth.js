/*表单*/
$(function(){
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setModalInitCustom(function(){
        ModalInitCustom(this);
    }).setBeforeSubmit(function(){
        return BeforeSubmit(this);
    }).setShowModalEditCustom(function(data){
        ShowModalEditCustom(data);
    }).setShowModalAddCustom(function(){
        ShowModalAddCustom();
    }).init();
    SelectTimeInit();
    select_init();
})

function ShowModalEditCustom(data){
//    var str = '"{"id":20,"repush_time":300,"acct":{"name":"asd","id":24,"account_id":1,"enable":1,"sms_content":"您的验证码是：$password。请不要把验证码泄露给其他人。","station_auth_max_num":-1,"station_bind_max_num":-1,"startUseTime":null,"acct_type":null,"endUseTime":null},"auth_primary":10,"reauth_time_enable":1,"account_id":1,"name":"asd","wechat_auth_id":-1,"acct_auth_id":24,"auth_switchs":2,"free_time":30,"reauth_time":1080}"';
//    data = JSON.parse(str);
//    alert(JSON.stringify(data));
//    console.log(data);
    //展示编辑内容
    //基本配置
    $("[id='authStrategy.name']").val(data.name);
    $("[id='authStrategy.reauth_time_enable']").prop('checked', (data.reauth_time_enable?true:false));
    $("#auth_day").val(Math.floor(data.reauth_time/60/24));
    $("#auth_hour").val(Math.floor(data.reauth_time/60)%24);
    $("#auth_minute").val(data.reauth_time%60);
    $("#ad_day").val(Math.floor(data.repush_time/60/24));
    $("#ad_hour").val(Math.floor(data.repush_time/60)%24);
    $("#ad_minute").val(data.repush_time%60);
    
    //手机认证
    $("input[name='phone_enable'][value="+ (data.auth_switchs & parseInt("0010",2) ? 10:0) + "]").prop("checked", true);
    $("input[name='authStrategy.auth_primary'][value="+ data.auth_primary + "]").prop("checked", true);
    if(data.acct){
        $("input[name='authAcctWay.enable'][value="+ (data.acct.enable?1:0) + "]").prop("checked", true);
        $("[id='authStrategy.station_bind_max_num']").val(data.acct.station_bind_max_num);
        $("[id='authStrategy.station_auth_max_num']").val(data.acct.station_auth_max_num);
    }
    collapse_phone();
    
    //微信认证
    $("input[name='wechat_enable'][value="+ (data.auth_switchs & parseInt("0100",2) ? 100:0) + "]").prop("checked", true);
    if(data.wechat){
        $("input[name='authWechatWay.wechat_type'][value="+ (data.wechat.wechat_type?1:0) + "]").prop("checked", true);
        $("[id='authWechatWay.wechat_appid']").val(data.wechat.wechat_appid);
        $("[id='authWechatWay.wechat_shopid']").val(data.wechat.wechat_shopid);
        $("[id='authWechatWay.wechat_secretkey']").val(data.wechat.wechat_secretkey);
        
        $("[id='authWechatWay.wechat_service_id_name").val(data.wechat.wechat_service_id_name);
        $("[id='authWechatWay.wechat_service_id").val(data.wechat.wechat_service_id);
        $("[id='authWechatWay.wechat_service_id_portal_url").val(data.wechat.wechat_service_id_portal_url);
        $("[id='authWechatWay.wechat_service_id_auth_url").val(data.wechat.wechat_service_id_auth_url);
        
        $("input[name='authWechatWay.wechat_url_type'][value="+ (data.wechat.wechat_url_type?1:0) + "]").prop("checked", true);
    }        
    collapse_wechat();
    collapse_wechat_type();
    collapse_wechat_url_type();
    
    //一键认证
    $("input[name='onekey_enable'][value="+ (data.auth_switchs & parseInt("0001",2) ? 1:0) + "]").prop("checked", true);
    collapse_onekey();
    
    //免费体验
    $("input[name='free_enable'][value="+ (data.auth_switchs & parseInt("1000",2) ? 1000:0) + "]").prop("checked", true);
    collapse_free();
    $("[id='authStrategy.free_time']").val(data.free_time);
    
    //添加主键
    $("[id='authStrategy.id']").val(data.id);
    $("[id='authStrategy.acct_auth_id']").val((data.acct_auth_id?data.acct_auth_id:-1));
    $("[id='authStrategy.wechat_auth_id']").val((data.wechat_auth_id?data.wechat_auth_id:-1));
    
    $('#basic-tab').tab('show');
}

function collapse_free(){
    $('#free_open').collapse(0!=$('input[name="free_enable"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="free_enable"]', function(){
    collapse_free();
})
function collapse_onekey(){
    $('#onekey_open').collapse(0!=$('input[name="onekey_enable"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="onekey_enable"]', function(){
    collapse_onekey();
})
function collapse_wechat(){
    $('#wechat_open').collapse(0!=$('input[name="wechat_enable"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="wechat_enable"]', function(){
    collapse_wechat();
})
function collapse_wechat_type(){
    $('#wechat_type_2').collapse(2==$('input[name="authWechatWay.wechat_type"]:checked').val()?'show':'hide');
    $('#wechat_type_1').collapse(1==$('input[name="authWechatWay.wechat_type"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="authWechatWay.wechat_type"]', function(){
    collapse_wechat_type();
})
function collapse_wechat_url_type(){
    $('#wechat_url_type_1').collapse(1==$('input[name="authWechatWay.wechat_url_type"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="authWechatWay.wechat_url_type"]', function(){
    collapse_wechat_url_type();
})
function collapse_phone(){
    $('#phone_open').collapse(0!=$('input[name="phone_enable"]:checked').val()?'show':'hide');
}
$("#myModal").on('change', 'input[name="phone_enable"]', function(){
    collapse_phone();
})

function TableRefresh(_self){
    var list = _self.data.list;
    var page = _self.data.pagination;
    var tbody = $("table tbody");
    tbody.empty();
    for(var i=0; i<list.length; i++){
        tbody.append(
            '<tr><td><label class="checkbox-inline">&nbsp;'
            + '<input type="checkbox" value="' + list[i].id + '">'
            + ((page.page_now-1)*page.page_size+i+1) + '</label>'
            + '</td><td>' + list[i].name
            + '</td><td>' + minuteToDay(list[i].reauth_time)
            + '</td><td>' + minuteToDay(list[i].repush_time)
            + '</td><td>' + (list[i].auth_switchs & parseInt("0010",2) ? "打开":"关闭") // 	手机认证
            + '</td><td>' + (list[i].auth_switchs & parseInt("0100",2) ? "打开":"关闭") // 	微信认证
            + '</td><td>' + (list[i].auth_switchs & parseInt("0001",2) ? "打开":"关闭") // 	一键认证
            + '</td><td>' + (list[i].auth_switchs & parseInt("1000",2) ? "打开":"关闭") // 	免费体验
            +'</td>'
            + _self.ShowOperate(i)
            +'</tr>'
        );
    }
}

function BeforeSubmit(_self){
    console.log(_self.post_data);
    var d = _self.post_data;
    if(0 == d['authStrategy.name'].length){
        alert_hint("提示", "策略名不能为空");
        return false;
    }
    var maxbind = parseInt(d['authAcctWay.station_bind_max_num'], 10);
    if(isNaN(maxbind) || maxbind < -1){
        alert_hint("提示", "最大绑定终端数 填写错误");
        return false;
    }
    var maxauth = parseInt(d['authAcctWay.station_auth_max_num'], 10);
    if(isNaN(maxauth) || maxauth < -1){
        alert_hint("提示", "同时上网最大数 填写错误");
        return false;
    }
    var wechat_enable = parseInt(d['wechat_enable'], 10);
    var wechat_type = parseInt(d['authWechatWay.wechat_type'], 10);
    var wechat_url_type = parseInt(d['authWechatWay.wechat_url_type'], 10);
    var appID = d['authWechatWay.wechat_appid'];
    var shopId = d['authWechatWay.wechat_shopid'];
    var secretKey = d['authWechatWay.wechat_secretkey'];
    var wechat_name = d['authWechatWay.wechat_service_id_name'];
    var wechat_id = d['authWechatWay.wechat_service_id'];
    if(wechat_enable && 2==wechat_type){
        if(""==appID || ""==shopId || ""==secretKey){
            alert_hint("提示", "微信配置缺少参数");
            return false;
        }
    }else if(wechat_enable && 1==wechat_type){
        if(""==wechat_name || ""==wechat_id){
            alert_hint("提示", "微信配置缺少参数");
            return false;
        }
    }
    
    var free_time = parseInt(d['authStrategy.free_time'], 10);
    if(isNaN(free_time) || free_time < 5 || free_time > 120){
        alert_hint("提示", "免费体验时长 设置错误");
        return false;
    }
    return true;
}

function minuteToDay(min){
    var dayStr = Math.floor(min/60/24) + "天" + Math.floor(min/60)%24 + "时" + min%60 + "分";
    return dayStr;
}

function ShowModalAddCustom(){
    
}
function ModalInitCustom(){
    SelectTimeInit();
}

function SelectTimeInit(){
    if(0 == $(".day").length) return;
    $(".day").empty();
    $(".hour").empty();
    $(".minute").empty();
    for(var i=0; i<8; i++){
        $(".day").append('<option value='+i+'>'+i+'天</option>');
    }
    for(var i=0; i<24; i++){
        $(".hour").append('<option value='+i+'>'+i+'时</option>');
    }
    for(var i=0; i<60; i++){
        $(".minute").append('<option value='+i+'>'+i+'分</option>');
    }
    
    //赋值
    $(".day, .hour, .minute").each(function(){
        $(this).val($(this).data('val'));
    })
}