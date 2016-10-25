$(function(){
    
//    alert(new Date(1472722187000).Format('yyyy-MM-dd'));
    //load_map();
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setShowModalEditCustom(function(data){
        ShowModalEditCustom(data);
    }).setShowModalAddCustom(function(){
        ShowModalAddCustom(this);
    }).init();
    select_init();
});
var roleName = {
    0:"普通用户",
    10:'分类信息管理员',
    100:'超级管理员',
};
var statusName = {
    0:"添加未激活",
    1:'已经激活',
    2:'黑名单',
};

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
            + '</td><td>' + (list[i].name?list[i].name:"")
            + '</td><td>' + (list[i].pname?list[i].pname:"")
            + '</td><td>' + (list[i].type?list[i].type:"")
            + '</td><td>' + (list[i].order?list[i].order:"")
            +'</td>'
            + _self.ShowOperate(i)
            +'</tr>'
        );
    }
}

//添加自定义
function ShowModalAddCustom(_self){
    $("#name").attr('readonly', false);
}

//编辑自定义
function ShowModalEditCustom(data){
    $("#name").attr('readonly', true);
//    console.log(data);
//    $("input[name='role'][value='"+ roleRadioVal[data.role] +"']").prop('checked', true);
    $("#pid").data('select2')['val']([data.pid]);
    $("#type").data('select2')['val']([data.type]);
}