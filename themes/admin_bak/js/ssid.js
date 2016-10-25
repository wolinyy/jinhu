$(function(){
    //load_map();
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).init();
    
    formInit();
});

$("input[name='auth_type']").on('change', function(){
    formInit();
});

function formInit(){
    $("#auth_key_open").collapse(0!=$("input[name='auth_type']:checked").val()?"show":"hide");
}

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
            + '</td><td>' + list[i].key_name
            + '</td><td>' + list[i].ssid
            + '</td><td>' + ("1" == list[i].ssid_enctype?"gb2312":("2" == list[i].ssid_enctype?"Both":"utf-8"))
            + '</td><td>' + (0==list[i].auth_type?"不加密":"加密")
            + '</td><td>' + (0==list[i].portal_auth_enable?"不认证":"认证")
            + '</td><td>' + list[i].vlan_id
            + '</td><td>' + (list[i].authstrategy?list[i].authstrategy.name:"")
            + '</td><td>' + (list[i].portalstrategy?list[i].portalstrategy.name:"")
            +'</td>'
            + _self.ShowOperate(i)
            +'</tr>'
        );
    }
}