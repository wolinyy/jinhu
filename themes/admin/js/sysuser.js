$(function(){
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
//    1:"管理员",
//    2:'老代理商',
//    3:'老客户',
//    4:'老只读账户',
    11:'一级代理商',
    12:'二级代理商',
    13:'三级代理商',
    14:'四级代理商',
    21:'客户',
    22:'只读客户',
    31:'关联只读账户',
};
var role_agent = 100;
var roleRadioVal = {
//    2:2,
//    3:3,
    11:role_agent,
    12:role_agent,
    13:role_agent,
    14:role_agent,
    21:21,
    22:22,
    31:31
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
            + '</td><td>' + (list[i].company?list[i].company:"")
            + '</td><td>' + (roleName[list[i].role]?roleName[list[i].role]:"未知角色")
            + '</td><td>' + (list[i].contact?list[i].contact:"")
            + '</td><td>' + (list[i].phone?list[i].phone:"")
            + '</td><td>' + (list[i].username?list[i].username:"")
            +'</td>'
            + _self.ShowOperate(i)
            +'</tr>'
        );
    }
}

//添加自定义
function ShowModalAddCustom(_self){
    $("#username").attr('readonly', false);
    $("#password").attr("required", true);
    $("#repassword").attr("required", true);
    $("#password").closest(".form-group").addClass("require");
    $("#repassword").closest(".form-group").addClass("require");
}

//编辑自定义
function ShowModalEditCustom(data){
//    console.log(data);
//    $("input[name='role'][value='"+ roleRadioVal[data.role] +"']").prop('checked', true);
    $("#role").data('select2')['val']([roleRadioVal[data.role]]);
    
    $("#username").attr('readonly', true);
    $("#password").removeAttr("required");
    $("#repassword").removeAttr("required");
    $("#password").closest(".form-group").removeClass("require");
    $("#repassword").closest(".form-group").removeClass("require");
    
    $("#password").val("");
    $("#repassword").val("");
}