$(function(){
//    var map;
//    load_map();
//    alert(new Date(1472722187000).Format('yyyy-MM-dd'));
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setShowModalEditCustom(function(data){
        ShowModalEditCustom(data);
    }).setShowModalAddCustom(function(){
        ShowModalAddCustom(this);
    }).setBeforeSubmit(function(){
        BeforeSubmit(this);
    }).init();
    select_init();
//    
//    if(typeof FileReader != undefined){  
//        $("#imgAddDiv").removeClass('hide');
//    }

    if($('#imgDrag > div:visible').length > 6){
        $('#imgDrag > div:last').addClass('hide');
    }
});

var typeName = {
    1:'行文本',
    2:'单选',
    3:'多选',
    4:'文本域',
};
var statusName = {
     0:'未审核',
     1:'可信用户，自动通过',
     2:'人工审核通过',
     3:'人工审核失败',
     4:'被多人举报，不可见',
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
            + '</td><td>' + list[i].t1_name + '/' + list[i].t2_name
            + '</td><td>' + list[i].r1_name + (list[i].r2_name?'/' + list[i].r2_name:"")
            + '</td><td>' + (list[i].title?list[i].title:"")
            + '</td><td>' + (list[i].content?list[i].content:"")
            + '</td><td>' + (list[i].name?list[i].name:"")
            + '</td><td>' + (list[i].phone?list[i].phone:"")
            + '</td><td>' + (statusName[list[i].status]?statusName[list[i].status]:"未知类型")
            + '</td><td>' + (list[i].is_delete==1?'已删除':"未删除")
            + '</td><td>' + (list[i].create_at?(new Date(parseInt(list[i].create_at) * 1000).Format('yyyy-MM-dd')):"")
            + '</td><td>' + (list[i].update_at?(new Date(parseInt(list[i].update_at) * 1000).Format('yyyy-MM-dd')):"")
            + '</td><td>' + (list[i].limit?list[i].limit:"")
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

function BeforeSubmit(data){
    var imgs = [];
    $("#imgDrag img").each(function(){
        var id = $(this).data('id');
        if(id){
            imgs.push(id);
        }
    });
    data.post_data.imgs = imgs;
    return true;
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
            $("#"+sidStr).data('select2')['val']([$("#"+sidStr).data('val')]);
            $("#"+sidStr).data('val', '');
        }
        if(fcall)
            fcall(data);
    }, function(data){});
}

function RegionChanged(fidStr, sidStr, fcall){
    var id = $("#"+fidStr).val();
    if(!id || 0==id.length) return;
    myAjax($("#"+fidStr), '/admin/region/getT2Name/'+id, '', function(data){
        $("#"+sidStr).empty();
        $("#"+sidStr).append("<option value=''>乡村</option>");
        $("#"+sidStr).select2({
            data: data.list,
            width:"100%",
            minimumResultsForSearch: Infinity,
          })
        if(""!=$("#"+sidStr).data('val')){
            $("#"+sidStr).data('select2')['val']([$("#"+sidStr).data('val')]);
            $("#"+sidStr).data('val', '');
        }
        if(fcall)
            fcall(data);
    }, function(data){});
}

$(".form-group").on('change', '#type_one_id', function(){
    TypeChanged('type_one_id', 'type_two_id');
})

$(".form-group").on('change', '#type_two_id', function(){
//    限制编辑的时候第一次不执行
    var flag = $("#id").data('first');
    
    if(flag == 1){
        $("#id").data('first', 0);
        return false;
    }
    
    var id = $(this).val();
    if(id.length == 0) {
        document.getElementById('attr').innerHTML = '';
        return;
    }
    myAjax($("#type_two_id"), '/admin/info_attr/getAttr/'+id, '', function(data){
        for(var i=0; i<data.list.length; i++){
            if(data.list[i].type == 2 || data.list[i].type == 3){
                var tmpArr = data.list[i].value.split("\n");
                data.list[i].len = tmpArr.length;
                data.list[i].obj = [];
                for(var j=0; j<tmpArr.length; j++){
                    var objArr = tmpArr[j].split(":");
                    data.list[i].obj[j] = {};
                    data.list[i].obj[j].key = objArr[0];
                    data.list[i].obj[j].value = objArr[1];
                }
            }
        }
        console.log(data);
        var html = template('tmpAttr', data);
        document.getElementById('attr').innerHTML = html;
    })

//    var data = {
//        title: '标签',
//        list: ['文艺', '博客', '摄影', '电影', '民谣', '旅行', '吉他']
//    };
//    var html = template('test', data);
//    document.getElementById('attr').innerHTML = html;
})

$(".form-group").on('change', '#addr_one_id', function(){
    RegionChanged('addr_one_id', 'addr_two_id');
})

$("#search-div").on('change', '#q_type_id', function(){
    TypeChanged('q_type_id', 'q_type2_id');
})

//加载地图
function load_map(){
    if(! $("#map_canvas").length)
        return;
    var preMarker=null;
    var lng = $("#lng").val();
    var lat = $("#lat").val();
    var zoom = $("#zoom").val();
    if(0 == lng.length) lng = 116.404;
    if(0 == lat.length) lat = 39.915;
    if(0 == zoom.length) zoom = 11;
    map = new BMap.Map("map_canvas");
    var point = new BMap.Point(lng, lat);
    map.centerAndZoom(point, zoom);
    var marker = new BMap.Marker(point);    //创建标注点
    map.addOverlay(marker);                 //添加标注点到地图
    map.addControl(new BMap.NavigationControl());
    map.addControl(new BMap.ScaleControl());
    map.addControl(new BMap.OverviewMapControl());
    map.enableScrollWheelZoom();
    var myIcon = new BMap.Icon("http://api.map.baidu.com/img/markers.png", new BMap.Size(23, 25), {
             offset: new BMap.Size(10, 25),                  // 指定定位位置
             imageOffset: new BMap.Size(0, -275)   // 设置图片偏移
    });
    map.addEventListener("click", function(e){
            var point = new BMap.Point(e.point.lng, e.point.lat);
        var marker = new BMap.Marker(point, {icon: myIcon});
            //map.removeOverlay(preMarker); 
            map.clearOverlays();

            map.addOverlay(marker);
            preMarker=marker;  
            $('#lng').val(e.point.lng);
            $('#lat').val(e.point.lat);
    });

    $("#search_address").click(function(){
        if ($("#addr_one_id")[0].selectedIndex === 0)
                return;
        // 创建地址解析器实例
        var myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        var province = $("#addr_one_id > option").eq($("#addr_one_id")[0].selectedIndex).text();
        var city = $("#addr_two_id > option").eq($("#addr_two_id")[0].selectedIndex).text();
        var address = $("#addr_detail").val();
        myGeo.getPoint(address, function(point, addr){//province + city + 
            if (point) {
                    map.centerAndZoom(point, addr.confidence);
                    map.clearOverlays();
                    var marker = new BMap.Marker(point);    //创建标注点
                    map.addOverlay(marker);                 //添加标注点到地图
                    $("#lng").val(point.lng);
                    $("#lat").val(point.lat);
                    //console.log(point);
            }else{
                myGeo.getPoint(area, function(point, addr) {
                    if (point) {
                        map.centerAndZoom(point, addr.confidence);
                        map.clearOverlays();
                        var marker = new BMap.Marker(point);    //创建标注点
                        map.addOverlay(marker);                 //添加标注点到地图
                        $("#lng").val(point.lng);
                        $("#lat").val(point.lat);
                        //console.log(point);
                    }
                }, province);
            }
        }, province);
    });
}

//html5图片上传、预览
$("body").on("change", "#fileUpload", function(){
    if(this.files){
        //获取上传文件中的第一个
        var file = this.files[0];
        //文件类型检测
        if(!/image\/\w+/.test(file.type)){
            alert("请选择图片类型的文件！");
            return ;
        }
        //文件大小限制1M
        if(file.size > 2*1024*1024){
            alert("文件大小不能超过2M");
            return ;
        }
    }

    var _this = $(this);
    if(_this.data("click")){
        alert("正在处理中，请稍等");
        return ;
    }

    _this.data('click', 1);
    ajaxFileUpload(_this, "/admin/info/imgUpload", _this.attr("id"), null, function(data){
        $('#target').attr('src', data.msg+'?a='+Math.random());
        $("#JcropModal").modal('show');
    },function(data){
        alert(data.msg);
    });
});

$('#testShow').on('click', function(){
    $("#JcropModal").modal('show');
})

$("#JcropModal").modal({
    backdrop:'static',
    keyboard: false,
    show:false
}).on('show.bs.modal', function (e) {
    //alert('show.bs.modal');
}).on('shown.bs.modal', function (e) {
    //alert('shown.bs.modal');
    $('#target').cropper({
        aspectRatio: 16 / 9,
        autoCropArea: 1,
        crop: function(e) {
          // Output the result data for cropping image.
          $('#x').val(Math.round(e.x));
          $('#y').val(Math.round(e.y));
          $('#w').val(Math.round(e.width));
          $('#h').val(Math.round(e.height));
        },
        dragMode: 'move',
        cropBoxResizable: false,
        guides: false,
        zoomable:false,
        viewMode: 1,
      });
}).on('hide.bs.modal', function (e) {
    //alert('hide.bs.modal');
}).on('hidden.bs.modal', function (e) {
    //alert('hidden.bs.modal');
    $('#target').cropper('destroy');
});

$("#btnCropSure").on('click', function(){
    //个数判断
//    if($('#imgDrag').children().length > 6){
//        alert('图片已经达到上限，无法继续添加');
//        return false;
//    }

    var index = $('#imgDrag').data('index');
    var imgObj = $('#imgDrag img:eq('+index+')');
    
    //参数初始化
    var para = {};
    para.x = $('#x').val();        //起点坐标
    para.y = $('#y').val();        //起点坐标
    para.width = $('#w').val();     //裁剪宽度
    para.height = $('#h').val();    //裁剪高度
    if(!! imgObj.data('id')){
        para.id = imgObj.data('id');
        para.oldimg = imgObj.attr('src');
    }
    
    myAjax($(this), '/admin/info/imgCrop/', para, function(data){
        
        
        if(!imgObj.data('id')){
            //返回id
            var html = template('jsImgAdd', data);
    //        $('#imgDrag').append(html);
            $('#imgDrag > div:last').before(html);
        }else{
            imgObj.attr('src', data.msg);
            imgObj.data('id', data.id);
        }
        $("#JcropModal").modal('hide');
        if($('#imgDrag > div:visible').length > 6){
            $('#imgDrag > div:last').addClass('hide');
        }
//        console.log(data);
//        alert('succ' + data.msg);
    });
});

//添加图片
$('#imgDrag').on('click', 'a', function(){
    var index = $(this).parent().index();
    $('#imgDrag').data('index', index);
//    alert($(this).index());
    $("#fileUpload").click();
})
//删除图片
$('#imgDrag').on('click', '.delImg', function(e){
    var index = $(this).parent().parent().index();
    var imgObj = $('#imgDrag img:eq('+index+')');
    
    var para = {};
    para.id = imgObj.data('id');
    para.oldimg = imgObj.attr('src');
    
    myAjax($(this), '/admin/info/imgDel/', para, function(data){
        $('#imgDrag > div:eq('+index+')').remove();
    })
})
//更新图片
$('#imgDrag').on('click', '.updateImg', function(e){
    var index = $(this).parent().parent().index();
    $('#imgDrag').data('index', index);
    $("#fileUpload").click();
})

//批量审核
$('#batch_edit_review').on('click', function(){
    $("#StatusModal").modal('show');
});

$("#StatusModal").modal({
    backdrop:'static',
    keyboard: false,
    show:false
}).on('show.bs.modal', function (e) {
    //alert('show.bs.modal');
}).on('shown.bs.modal', function (e) {
    //alert('shown.bs.modal');
}).on('hide.bs.modal', function (e) {
    //alert('hide.bs.modal');
}).on('hidden.bs.modal', function (e) {
    //alert('hidden.bs.modal');
});

$('#btnStatusSure').on('click', function(){
    var tbody = $("table tbody");
    if(! tbody.find("input[type=checkbox]:checked").length){
        show_hint({code:-1, msg:'请先勾选选项'});
        $("#StatusModal").modal('hide');
        return;
    }
    var para = { 
        id: [], 
        status: $('#status').val(),
    };
    tbody.find("input[type=checkbox]:checked").each(function(){
        para.id.push($(this).val());
    })
    myAjax($(this), $(this).data("url"), para, function(data){
        location.reload(true);
    }, function(data){
       show_hint(data);
       $("#StatusModal").modal('hide');
    });
})
