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

var typeName = {
    1:'字符行文本',
    2:'单选',
    3:'多选',
    4:'文本域',
    5:'数值行文本',
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
            + '</td><td>' + (list[i].c1_name?list[i].c1_name:"")
            + '</td><td>' + (list[i].c2_name?list[i].c2_name:"")
            + '</td><td>' + (typeName[list[i].type]?typeName[list[i].type]:"未知类型")
            + '</td><td>' + (list[i].value?list[i].value:"")
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
    $("#value").val('');
    $("#order").val(100);
}

//编辑自定义
function ShowModalEditCustom(data){
    $("#name").attr('readonly', true);
//    console.log(data);
//    $("input[name='role'][value='"+ roleRadioVal[data.role] +"']").prop('checked', true);
    $("#type_id").data('select2')['val']([data.type_id]);
//    $("#type2_id").data('select2')['val']([data.type2_id]);
    $("#type").data('select2')['val']([data.type]);
    
    $("#type2_id").data('val', data.type2_id);
    TypeChanged('type_id', 'type2_id');
}

function TypeChanged_bak(fcall){
    var id = $("#type_id").val();
    if(!id || 0==id.length) return;
    myAjax($("#type_id"), '/admin/info_type/getT2Name/'+id, '', function(data){
        $("#type2_id").empty();
        $("#type2_id").append("<option value=''>二级分类</option>");
        $("#type2_id").select2({
            data: data.list,
            width:"100%",
            minimumResultsForSearch: Infinity,
          })
        if(""!=$("#type2_id").data('val')){
            $("#type2_id").data('select2')['val']([$("#type2_id").data('val')]);
            $("#type2_id").data('val', '');
        }
        if(fcall)
            fcall(data);
    }, function(data){});
}

function TypeChanged(fidStr, sidStr, fcall){
    var id = $("#"+fidStr).val();
    if(!id || 0==id.length) return;
    myAjax($("#"+fidStr), '/admin/info_type/getT2Name/'+id, '', function(data){
        $("#"+sidStr).empty();
        $("#"+sidStr).append("<option value=''>二级分类</option>");
        $("#"+sidStr).select2({
            data: data.list,
            width:"100%",
            minimumResultsForSearch: Infinity,
          })
        if(""!=$("#"+sidStr).data('val')){
            $("#"+sidStr).data('select2')['val']([$("#type2_id").data('val')]);
            $("#"+sidStr).data('val', '');
        }
        if(fcall)
            fcall(data);
    }, function(data){});
}

$("#myModal").on('change', '#type_id', function(){
    TypeChanged('type_id', 'type2_id');
})

$("#search-div").on('change', '#q_type_id', function(){
    TypeChanged('q_type_id', 'q_type2_id');
})