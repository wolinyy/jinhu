$(function(){
    //load_map();
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setShowEditDataHandler(function (data){
        return ShowEditDataHandler(data);
    }).setBeforeSubmit(function (){
        return BeforeSubmit(this);
    }).init();
    
    ModalInit();
});

function BeforeSubmit(_self){
    
    var data = _self.post_data;
    if(data.mac){
        //编辑位置信息
        return true;
    }
    
    //批量编辑
    if(undefined != data.proj_id){
        //批量修改项目
        if(0 == data.proj_id.length){
            $("#update_proj_modal").modal("hide");
            return false;
        }
    }else if(undefined != data.group_id){
        //批量配置分组
        if(0 == data.group_id.length){
            $("#update_proj_modal").modal("hide");
            return false;
        }
    }else if(undefined != data.owner_id){
        //批量把设备分配给用户
        if(0 == data.owner_id.length){
            $("#update_user_modal").modal("hide");
            return false;
        }
    }
    
    _self.post_data.id = [];
    var tbody = $(_self.table + " tbody");
    tbody.find("input[type=checkbox]:checked").each(function(){
        _self.post_data.id.push($(this).val());
    })
    return true;
}

function beforeShow(){
    var alert_obj = $(".alert-hint");
    alert_obj.find("strong").text("");
    alert_obj.find("span").text();
    alert_obj.addClass('sr-only');
}

$("#batch_update_user").on('click', function(e){
    var _self=myTable;
    var tbody = $(_self.table + " tbody");
    if(! tbody.find("input[type=checkbox]:checked").length){
        _self.show_hint({code:-1, msg:'请先勾选选项'});
        return;
    }

    $("#update_user_modal").modal('show');
});

$("#batch_update_proj").on('click', function(e){
    var _self=myTable;
    var tbody = $(_self.table + " tbody");
    if(! tbody.find("input[type=checkbox]:checked").length){
        _self.show_hint({code:-1, msg:'请先勾选选项'});
        return;
    }

    $("#update_proj_modal").modal('show');
});


$("#batch_update_group").on('click', function(e){
    var _self=myTable;
    var tbody = $(_self.table + " tbody");
    if(! tbody.find("input[type=checkbox]:checked").length){
        _self.show_hint({code:-1, msg:'请先勾选选项'});
        return;
    }

    $("#update_group_modal").modal('show');
});

function ModalInit(){
    $("#update_user_modal, #update_proj_modal, #update_group_modal").modal({
        backdrop:'static',
        keyboard: false,
        show:false
    }).on('show.bs.modal', function (e) {
        beforeShow();
//        alert('show.bs.modal');
    }).on('shown.bs.modal', function (e) {
//        alert('shown.bs.modal');
    }).on('hide.bs.modal', function (e) {
//        alert('hide.bs.modal');
    }).on('hidden.bs.modal', function (e) {
//        alert('hidden.bs.modal');
    });
}

function ShowEditDataHandler(data){
    if(!data.description){
        data.description = "";
    }
    if(!data.position_desc){
        data.position_desc = "";
    }
    return data;
}
function TableRefresh(_self){
    var list = _self.data.list;
    var page = _self.data.pagination;
    var tbody = $("table tbody");
    tbody.empty();
    var who;
    for(var i=0; i<list.length; i++){
        if($('body').data('role')==list[i].account_id){
            who = '<span class="label label-primary">自己</span>';
        }else{
            who = list[i].sys_user?list[i].sys_user.company:"";
        }
        
        tbody.append(
            '<tr><td><label class="checkbox-inline">&nbsp;'
            + '<input type="checkbox" value="' + list[i].mac + '">'
            + ((page.page_now-1)*page.page_size+i+1) + '</label>'
            + '</td><td>' + list[i].mac
            + '</td><td>' + (list[i].description?list[i].description:"")
            + '</td><td>' + (-1!=list[i].proj_id?list[i].proj.name:"")
            + '</td><td>' + who
            + '</td><td>' + (list[i].group?list[i].group.key_name:"")
            + '</td><td>' + list[i].model
            + '</td><td>' + list[i].serial_num
            + '</td><td>' + (list[i].sw_ver?list[i].sw_ver:"")
            + '</td><td>' + (list[i].position_desc?list[i].position_desc:"")
            + '</td><td>' + (0!=list[i].status?"在线":"离线")
            +'</td>'
            + _self.ShowOperate(i, '<button type="button" class="btn btn-primary btn-xs show_edit-btn" data-index="'+i+'">编辑</button>')
            +'</tr>'
        );
    }
}

$("#update_user_modal").validate({
    errorPlacement:function(error, element){
        $(error).addClass('col-sm-9 col-sm-push-3');
        $(element).closest(".form-group").append(error);
    },
    submitHandler: function(form) {
        myTable.submitHandler(form);
    }
});

$("#update_proj_modal").validate({
    errorPlacement:function(error, element){
        $(error).addClass('col-sm-9 col-sm-push-3');
        $(element).closest(".form-group").append(error);
    },
    submitHandler: function(form) {
        myTable.submitHandler(form);
    }
});

$("#update_group_modal").validate({
    errorPlacement:function(error, element){
        $(error).addClass('col-sm-9 col-sm-push-3');
        $(element).closest(".form-group").append(error);
    },
    submitHandler: function(form) {
        myTable.submitHandler(form);
    }
});