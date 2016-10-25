$(function () {
  var map;
})

$(function(){
    load_map();
    myTable.setTableRefresh(function(data){
        TableRefresh(this);
    }).setSelectInitCustom(function(){
//        SelectInitCustom(this);
    }).setBeforeSubmit(function(){
        return BeforeSubmit(this);
    }).setShowModalEditCustom(function(data){
        ShowModalEditCustom(data);
    }).init();
    select_init();
    ModalInit();
});

/********************  批量修改客户  ****************************/
function ModalInit(){
    $("#update_user_modal").modal({
        backdrop:'static',
        keyboard: false,
        show:false
    }).on('show.bs.modal', function (e) {
        beforeShow();
    });
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

function ShowModalEditCustom(data){
    $("#industry").data('select2')['val']([data.industry]);
    
    if(data.location){
        var tmpArr = data.location.split('#');
        var tmpArr1 = tmpArr[0].split(':');
        var tmpArr2 = tmpArr[1].split(':');
        
        $("#province").data('select2')['val']([tmpArr1[0]]);
        $("#city").data('val', tmpArr1[1]);
        $("#area").data('val', tmpArr1[2]);
        ProvinceChanged(function(){
            CityChanged();
        });
        
        $("#lng").val(tmpArr2[0]);
        $("#lat").val(tmpArr2[1]);
        $("#zoom").val(tmpArr2[2]);
    }
    
    //数据清空初始化
    $("#account_id").empty();
    $("#group_id").empty();
    
    if(data.group){
        $("#group_id").append('<option value="'+ data.group.id +'" selected>'+ data.group.key_name +'</option>');
    }
    $("#account_id").append('<option value="'+ data.account_id +'" selected>'+ data.company +'</option>');
    select_init();
}

function beforeShow(){
    var alert_obj = $(".alert-hint");
    alert_obj.find("strong").text("");
    alert_obj.find("span").text();
    alert_obj.addClass('sr-only');
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

/********************  批量修改客户  ****************************/
function BeforeSubmit(_self){
//    console.log(_self.post_data);
    if(undefined != _self.post_data.owner_id){
        if(0 == _self.post_data.owner_id.length){
            $("#update_user_modal").modal("hide");
            return false;
        }
        _self.post_data.id = [];
        var tbody = $(_self.table + " tbody");
        tbody.find("input[type=checkbox]:checked").each(function(){
            _self.post_data.id.push($(this).val());
        })
        return true;
    }
//    return false;
    if(0 == _self.post_data.industry.length){
        alert_hint("提示", "请选择行业类别");
        return false;
    }
    if(0 == _self.post_data.province.length
            || 0 == _self.post_data.city.length
            || 0 == _self.post_data.area.length){
        alert_hint("提示", "请选择省市区");
        return false;
    }
    
    _self.post_data.zoom = map.getZoom();
    _self.post_data.location = _self.post_data.province
            + ":" + _self.post_data.city
            + ":" + _self.post_data.area
            + "#" + _self.post_data.lng
            + ":" + _self.post_data.lat
            + ":" + _self.post_data.zoom;
    
    return true;
}

function ProvinceChanged(fcall){
    var id = $("#province").val();
    if(!id || 0==id.length) return;
    myAjax($("#province"), '/admin/proj/getCity/'+id, '', function(data){
        $("#city").empty();
        $("#city").append("<option>市</option>");
        $("#area").empty();
        $("#area").append("<option>区</option>");
        $("#area").data('select2')['val']([$("#area").find("option:first").val()]);
        $("#city").select2({
            data: data.list,
            width:"100%",
            minimumResultsForSearch: Infinity,
          })
        if(""!=$("#city").data('val')){
            $("#city").data('select2')['val']([$("#city").data('val')]);
            $("#city").data('val', '');
        }
        if(fcall)
            fcall(data);
    }, function(data){});
}

function CityChanged(){
    var id = $("#city").val();
    if(!id ||0==id.length) return;
    myAjax($("#city"), '/admin/proj/getArea/'+id, '', function(data){
        $("#area").empty();
        $("#area").append("<option>区</option>");
        $("#area").select2({
            data: data.list,
            width:"100%",
            minimumResultsForSearch: Infinity
          })
        if(""!=$("#area").data('val')){
            $("#area").data('select2')['val']([$("#area").data('val')]);
            $("#area").data('val', '');
        }
    }, function(data){});
}

$("#myModal").on('change', '#province', function(){
    ProvinceChanged();
})

$("#myModal").on('change', "#city", function(){
    CityChanged();
})

function getAddress(address){
    var firstPos = address.indexOf("#");
    var lastPos = address.lastIndexOf("#");

    return address.substr(firstPos+1, (lastPos-firstPos-1));
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
                + '</td><td>' + list[i].name
                + '</td><td>' + list[i].company
                + '</td><td>' + (list[i].group?list[i].group.key_name:"")
                + '</td><td>' + list[i].contact
                + '</td><td>' + list[i].phone
                + '</td><td>' + list[i].industry
                + '</td><td>' + (list[i].address?list[i].address:"")
                + '</td><td>' + list[i].wtp_online_count + " / " + list[i].wtp_count
                +'</td>'
                + _self.ShowOperate(i)
                +'</tr>'
            );
        }
}

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
        if ($("#province")[0].selectedIndex === 0)
                return;
        // 创建地址解析器实例
        var myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        var province = $("#province > option").eq($("#province")[0].selectedIndex).text();
        var city = $("#city > option").eq($("#city")[0].selectedIndex).text();
        var area = $("#area > option").eq($("#area")[0].selectedIndex).text();
        var address = $("#address").val();
        myGeo.getPoint(province + city + area + address, function(point, addr){
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
function modal_show_init(){
    var baidu_map_js = $('body').data('baidu_map_js');
    if(baidu_map_js){
        loadJScript(baidu_map_js);
    }
    select_init();
}

//添加按钮点击
$(".add").on('click', function(){
    var modal = $(this).data("modal");
    var url = $(this).data("url");

    if(!url || 0==url.length){
        alert('错误的按钮');
        return;
    }
    if(1 == modal){
        $('#myModal').data('url', url);
        $('#myModal').modal('show');
    }else{
        location.href = url;
    }
})
