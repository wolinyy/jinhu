/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    pagination_refresh(page);
})

function pagination_refresh(page){
    $("#Pagination").pagination(page.total, { 
        callback: pageCallBack, 
        prev_text: '&laquo;', 
        next_text: '&raquo;',
        ellipse_text:'...',
        items_per_page: page.size, 
        num_display_entries: 3, 
        current_page: (page.now-1), 
        num_edge_entries: 2
    });
    page_info_refresh(page);
}

function pageCallBack(page_index){
    var param = {};
    param.pageNow = page_index+1;
    param.pageSize = $('#page_size').val();

    myAjax($("#body"), '/info/mng', param, function(data){

//        console.log(data);
        
        //时间转日期
        for(k in data.infoNew){
            data.infoNew[k].create_at = new Date(parseInt(data.infoNew[k].create_at) * 1000).Format('yyyy-MM-dd hh:mm');
            data.infoNew[k].update_at = new Date(parseInt(data.infoNew[k].update_at) * 1000).Format('yyyy-MM-dd hh:mm');
        }
//        console.log(data);
        var html = template('tmpAttr', data);
        document.getElementById('tbody').innerHTML = html;
        page_info_refresh(data.page);
        
        page = data.page;
    })

    return false;
}

function page_info_refresh(page){
    $('.dataTables_info').empty().append('每页 <label> <select class="form-control input-sm" id="page_size">'
        +'<option value="10">10</option>'
//        +'<option value="25">25</option>'
//        +'<option value="50">50</option>'
//        +'<option value="100">100</option>'
        +'</select>'
        +'</label> 条，共 <strong id="page_total">'+page.total+'</strong> 条，'
        +'第 <strong><span id="page_now">'+page.now
        +'</span>/<span id="page_nums">'+page.pageCount+'</span></strong> 页'
    );
    $('#page_size').val(page.size);
}

$('table').on('click', '.del-btn', function(){
    var obj = this;
    var r=confirm("您确定要删除该条记录？")
    if (r==true) {
        var para = {
            id:$(obj).parents("tr").find("input[type=checkbox]").val()
        };
        
        var _this = $("table thead");
        myAjax(_this, _this.data('del'), para, function(data){
            show_hint(data);
            pageCallBack(parseInt(page.now, 10)-1);
        }, function(data){
            show_hint(data);
        });
    }
})

/*批量删除*/
$('body').on('click', '#batch_del', function(){
    var obj = this;
    var tbody = $("table tbody");
    if(! tbody.find("input[type=checkbox]:checked").length){
        show_hint({code:-1, msg:'请先勾选选项'});
        return;
    }
    var r=confirm("您确定要删除选中的记录？")
    if (r==true) {
        var para = { id:[]};
        tbody.find("input[type=checkbox]:checked").each(function(){
            para.id.push($(this).val());
        })
        myAjax($(obj), $(obj).data("url"), para, function(data){
            show_hint(data);
            pageCallBack(parseInt(page.now, 10)-1);
        }, function(data){
            show_hint(data);
        });
    }
})

$('table').on('click', '.update-btn', function(){
    var obj = this;
    var para = {
        id:$(obj).parents("tr").find("input[type=checkbox]").val()
    };

    var _this = $("table thead");
    myAjax(_this, _this.data('uptime'), para, function(data){
        show_hint(data);
        pageCallBack(parseInt(page.now, 10)-1);
    }, function(data){
        show_hint(data);
    });
})

$('#check-all').on('click', function(){
    $('table tbody input:checkbox').prop("checked", $(this).prop("checked"));
});