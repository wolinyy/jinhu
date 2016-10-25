/*表单*/
$(function(){
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setShowModalAddCustom(function(){
        ShowModalAddCustom();
    }).setShowModalEditCustom(function(){
        ShowModalEditCustom(this);
    }).setBeforeSubmit(function(){
        return BeforeSubmit(this);
    }).setDel(function(obj){
        Del(obj);
    }).setDelBatch(function(obj){
        DelBatch(obj);
    }).init();
    select_init();
})

function Del(obj){
    var _self = myTable;
    var r=confirm("您确定要删除该条记录？")
    if (r==true) {
        var index = $("tbody tr").index($(obj).parents("tr"));
        var data = _self.data.list[index];
        var para = {
            id:$(obj).parents("tr").find("input[type=checkbox]").val(),
            portal_sync_id:data.portal_sync_id
        };
        var _this = $(_self.table + " thead");
        myAjax(_this, _this.data('del'), para, function(data){
            _self.getListWithPage();
            _self.show_hint(data);
        }, function(data){
            _self.show_hint(data);
        });
    }
}

function DelBatch(obj){
    var _self = myTable;
    var tbody = $(_self.table + " tbody");
    if(! tbody.find("input[type=checkbox]:checked").length){
        _self.show_hint({code:-1, msg:'请先勾选选项'});
        return;
    }
    var r=confirm("您确定要删除选中的记录？")
    if (r==true) {
        var para = { id:[], portal_sync_id:[]};
        var index;
        var data;
        tbody.find("input[type=checkbox]:checked").each(function(){
            index = $("tbody tr").index($(this).parents("tr"));
            data = _self.data.list[index];
            para.id.push($(this).val());
            para.portal_sync_id.push(data.portal_sync_id);
        })
        myAjax($(obj), $(obj).data("url"), para, function(data){
            _self.getListWithPage();
            _self.show_hint(data);
        }, function(data){
            _self.show_hint(data);
        });
    }
}

function setPortal(portal_sync_id){
//    window.open('/admin/ad/setPortal?id='+id);
    location.href = ('/admin/ad/setPortal?id='+portal_sync_id);
}

function TableRefresh(_self){
    var list = _self.data.list;
    var page = _self.data.pagination;
    var tbody = $("table tbody");
    tbody.empty();
    var portal_from;
    for(var i=0; i<list.length; i++){
        if(1==list[i].portal_from){
            portal_from = '内部 &nbsp; <button class="btn btn-primary btn-xs" onclick="setPortal('+list[i].portal_sync_id+')">定制</button>';
        }else{
            portal_from = "第三方";
        }
        tbody.append(
            '<tr><td><label class="checkbox-inline">&nbsp;'
            + '<input type="checkbox" value="' + list[i].id + '">'
            + ((page.page_now-1)*page.page_size+i+1) + '</label>'
            + '</td><td>' + list[i].name
            + '</td><td>' + portal_from
            + '</td><td>' + '<a href="'+ list[i].portal_url +'" target="_blank">' +list[i].portal_url + '</a>'
            +'</td>'
            + _self.ShowOperate(i)
            +'</tr>'
        );
    }
}

function ShowModalAddCustom(){
    $('input[name="portal_from"][value=1]').prop('checked', true);
    portalFromChange();
}
function ShowModalEditCustom(){
    portalFromChange();
}

function BeforeSubmit(_self){
//    alert(JSON.stringify(_self.post_data))
//    console.log(_self.post_data);
    var d = _self.post_data;
    return true;
}

$("#myModal").on('change', 'input[name="portal_from"]', function(){
    portalFromChange();
})

function portalFromChange(){
    if("1" == $('input[name="portal_from"]:checked').val()){
        $("#portal_url_open").collapse("hide");
        $("#portal_url").removeAttr('required');
        $("#portal_url").closest('.form-group').removeClass('require');
        $('#portal_url-error').remove();
    }else{
        $("#portal_url_open").collapse("show");
        $("#portal_url").attr('required', true);
        $("#portal_url").closest('.form-group').addClass('require');
    }
}