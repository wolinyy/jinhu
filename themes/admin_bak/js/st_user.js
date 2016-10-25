$(function(){
    var para = {};
    para.per_page = 10;
    para.offset = 0;
    individual_user(para);
    select_init();
})

var authType = {
    1:'免认证', 5:'免认证',
    6:'一键登录', 
    7:'免费体验', 
    8:'短信', 9:'短信',
    11:'app', 15:'app', 16:'app', 24:'appc',
    13:'微信', 14:'微信'
};

var sysType = {
    0:'pc',
    1:'apple',
    2:'android',
    3:'other mobile',
    100:'未知'
};

function individual_user(para){
    if(!para.offset)
        para.offset = 0;
    myAjax(null, $("#chart").data('url')+'individual_user'+'/'+para.offset, para, function(data){
        //生成表格
        $("#staList").empty();
        if(data.sta_list.length!=0){
            for(var i=0; i<data.sta_list.length; i++){
                $("#staList").append(
                      "<tr><td>"+data.sta_list[i].sta_mac
                    //+"</td><td>"+(data.sta_list[i].name?data.sta_list[i].name:'')
                    //+"</td><td>"+(data.sta_list[i].last_phone?data.sta_list[i].last_phone:'')
                    +"</td><td>"+data.sta_list[i].first_date
                    +"</td><td>"+(data.sta_list[i].last_ap?data.sta_list[i].last_ap:'')
                    +"</td><td>"+data.sta_list[i].last_date
                    +"</td><td>"+authType[data.sta_list[i].last_authType]
                    +"</td><td>"+data.sta_list[i].login_cnt
                    +"</td><td>"+data.sta_list[i].login_day
                    +"</td><td>"+sysType[data.sta_list[i].system_type]
//                    +"</td><td><a class='myTab' href='#individual_user_detail'>查看详情</a>"
                    +"</td></tr>"
                );
            }
            var page = data.pagination;
            if (page.cur_page == 0) page.cur_page = 1;
            $("#Pagination").pagination(page.total_rows, { 
                callback: pageselectCallback, 
                prev_text: '&laquo;', 
                next_text: '&raquo;',
                ellipse_text:'...',
                items_per_page: page.per_page, 
                num_display_entries: 3, 
                current_page: (page.cur_page-1), 
                num_edge_entries: 2
            });
            $(".dataTables_info").empty().append('每页 <label> <select class="form-control input-sm" id="per_page">'
                +'<option value="10">10</option>'
                +'<option value="25">25</option>'
                +'<option value="50">50</option>'
                +'<option value="100">100</option></select>'
                +'</label> 条，共 <strong id="page_total">'+page.total_rows+'</strong> 条，'
                +'第 <strong><span id="page_now">'+page.cur_page
                +'</span>/<span id="page_nums">'+Math.ceil(page.total_rows /page.per_page)+'</span></strong> 页'
            );
            $("#per_page").val(page.per_page);
        }else{
            $("#staList").append("<tr><td colspan=8><span class='text-center clearfix'>暂无数据</span></td></tr>");
            $(".panel-footer").hide();
        }
    })
}

$(".dataTables_info").on('change', "#per_page", function(){
    var para = {};
    para.per_page = $(this).val();
    para.offset = 0;
    individual_user(para);
})

function pageselectCallback(page_id) { 
    var para = {};
    para.per_page = 10;
    para.offset = page_id * para.per_page;
    individual_user(para);
    return false;
} 

function individual_user_detail_clear(){
    $("[class^=iud]").text('');
}

function individual_user_detail_show(data){
    var class_prefix = ".iud_";
    $(class_prefix + 'sta_mac').text(data.sta_mac);
    if(data.name) $(class_prefix + 'name').text(data.name);
    if(data.last_phone) $(class_prefix + 'last_phone').text(data.last_phone);
    $(class_prefix + 'system_type').text(sysType[data.system_type]);
    $(class_prefix + 'login_cnt').text(data.login_cnt);
    $(class_prefix + 'login_day').text(data.login_day);
    $(class_prefix + 'first_date').text(data.first_date);
    if(data.last_ap) $(class_prefix + 'last_ap').text(data.last_ap);
    $(class_prefix + 'last_date').text(data.last_date);
    $(class_prefix + 'last_authType').text(authType[data.last_authType]);
}

function individual_user_detail(para){
    para.mac = $(".is_head").data("mac");
    individual_user_detail_clear();
    myAjax(null, $("body").data('site')+'alliance/index_statistics/'+para.funcName, para, function(data){
        individual_user_detail_show(data.sta_info);
    })
}