
var MyTable = function() {
    var _self = this;
    
    /* 数据库返回结果*/
    this.data;
    /* val */
    this.btn_refresh = ".refresh";      //刷新按钮
    this.btn_search = "#search-btn";    //搜索按钮
    this.btn_check_all = "#check-all";  //全选按钮
    this.btn_check_no = "table tbody input:checkbox";  //多选按钮
    this.btn_show_eidt = ".show_edit-btn"; //编辑按钮-展示
    this.btn_show_add = "#show_add"; //添加按钮-展示
    this.btn_show_select_add = ".show_select_add"; //添加按钮-展示
    this.btn_del = ".del-btn"; //删除按钮
    this.btn_submit = "#submit"; //提交按钮 add or edit
    this.btn_modal_submit = "#modal_submit"; //模态框提交按钮 add or edit
    this.btn_batch_del = "#batch_del"; //批量删除按钮
    
    this.form_search_data = "#search-div .form-group *[id^='q_']";  //搜索表单选择器
    this.data_like = "like";    //判断是否模糊查询
    
    this.table = "table";
    this.div_pagination = "#Pagination";    //分页
    this.div_page_info = ".dataTables_info";
    this.div_page_size = "#page_size";      //选择每页数
    this.div_page_total = "#page_total";      //选择每页数
    this.div_sort = '.sort';    //排序
    this.div_modal = "#myModal";
    
    this.str_page_now = "page_now";
    this.str_page_size = "page_size";
    
    this.val_order = {};
    
    /* function */
    /*查询*/
    this.getListWithPage = function (){
        if( ! $(_self.table).length ){
            return;
        }
        
        //搜集查询信息
        var filter = _self.getFilter();
        //搜集排序信息
        var order = _self.getOrder();
        //搜集分页信息
        var pagination = _self.getPage();
        //提交查询
        var para = {
            filter:filter,
            order:order,
            pagination:pagination
        };
        var _this = $(_self.table + " thead");
        myAjax(_this, _this.data('get'), para, function(data){
//            console.log(data);
            _self.data = data;
            /* 对接参数转化 */
            _self.data.list = data.data;
            if(!data.data || !data.pageinfo) return;
            _self.data.pagination = {
                page_now:data.pageinfo.now,
                page_nums:data.pageinfo.pageCount,
                page_size:data.pageinfo.size,
                page_total:data.pageinfo.total
            };
            
            _self.table_refresh(data);
            _self.pagination_refresh(data);
            $("#check-all").prop('checked', false);
        });
    }
    this.ShowOperate = function(i, opStr) {
        if($(".operation").length){
            if(opStr){
                return '<td>'+opStr+'</td>';
            }else{
                return '<td><button type="button" class="btn btn-primary btn-xs show_edit-btn" data-index="'+i+'">编辑</button>'
                    + '&nbsp;<button type="button" class="btn btn-danger btn-xs del-btn">删除</button></td>';
            }
        }
        return "";
    }
    this.ShowOperateBak = function(i) {
        return '<button type="button" class="btn btn-primary btn-xs show_edit-btn" data-index="'+i+'">编辑</button>'
            + '&nbsp;<button type="button" class="btn btn-danger btn-xs del-btn">删除</button>';
    }
    /*表格刷新 具体页面覆盖*/
    this.table_refresh = function (data){}
    /*分页刷新*/
    this.pagination_refresh = function (data){
        var page = data.pagination;
        $("#Pagination").pagination(page.page_total, { 
            callback: _self.pageselectCallback, 
            prev_text: '&laquo;', 
            next_text: '&raquo;',
            ellipse_text:'...',
            items_per_page: page.page_size, 
            num_display_entries: 3, 
            current_page: (page.page_now-1), 
            num_edge_entries: 2
        });
        $(_self.div_page_info).empty().append('每页 <label> <select class="form-control input-sm" id="page_size">'
            +'<option value="10">10</option>'
            +'<option value="25">25</option>'
            +'<option value="50">50</option>'
            +'<option value="100">100</option></select>'
            +'</label> 条，共 <strong id="page_total">'+page.page_total+'</strong> 条，'
            +'第 <strong><span id="page_now">'+page.page_now
            +'</span>/<span id="page_nums">'+page.page_nums+'</span></strong> 页'
        );
        $(_self.div_page_size).val(page.page_size);
    }
    this.pageselectCallback = function (page_index, jq){
        _self.setPage(page_index+1);
        _self.getListWithPage();
        _self.show_hint();
        return false;
    }
    this.show_modal_add_custom = function(data){}
    this.show_add = function (btn_show_add){
        var modal = $(btn_show_add).data("modal");
        var url = $(btn_show_add).data("url");
        var debug = $(btn_show_add).data("debug");

        if(!url || 0==url.length){
            return;
        }
        if(1 == modal){
            $(_self.div_modal + " .modal-title").text("添加");
            $(_self.div_modal).data('url', url);
            $(_self.div_modal).data('modal', 1);    //对话框打开标记
            $(_self.div_modal).data('debug', (debug?1:0));
            //表单初始化
            //文本框
            $(_self.div_modal).find("input[type!='radio'][type!='checkbox'][type!='hidden']").each(function(){
                var defval = $(this).data('val');
                if(!defval){
                    defval = "";
                }
                $(this).val(defval);
            })
            //$(_self.div_modal).find("input[type!='radio'][type!='checkbox']").val("");
            //radio与checkbox
            $(_self.div_modal).find("input[type='radio'][data-checked],[type='checkbox'][data-checked]").prop("checked", true);
            
            $(_self.div_modal).data('edit', "");
            $(_self.div_modal).modal('show');
        }else{
            location.href = url;
        }
    }
    
    this.show_edit_data_handler = function (data){return data;}
    /*修改*/
    this.show_modal_edit_init = function(data){
        console.log(data);
        
        data = _self.show_edit_data_handler(data);
        for(var k in data){
            setFormValue(k, data[k]);
        }
    }
    this.show_modal_edit_custom = function(data){}
    this.show_edit = function (obj){
        $(_self.div_modal + " .modal-title").text("编辑");
        var modal = $(_self.btn_show_add).data("modal");    //与add保持一致，对话框或者新页面打开
        var url = $(_self.btn_show_add).data("url");
        var pk = $(_self.btn_show_add).data("pk");
        if(!pk) pk = "id";
        var data = _self.data.list[$(obj).data('index')];
        
        if(!url || 0==url.length){
            return;
        }
//        alert(JSON.stringify(data));
//        console.log(data);
        if(1 == modal){
            $(_self.div_modal).data('url', url);
            $(_self.div_modal).data('edit', 1);
            $(_self.div_modal).data('modal', 1);    //对话框打开标记
            
            $(_self.div_modal).modal('show').off('shown.bs.modal').on('shown.bs.modal', function (e) {
                _self.modal_shown_init();
                if("1" == $(_self.div_modal).data("edit")){
                    //数据初始化
                    _self.show_modal_edit_init(data);
                    //各页面自己的初始化
                    _self.show_modal_edit_custom(data);
                    $("input[type='hidden'][name='"+ pk +"']").val(data[pk]);
                }else{
                    $("input[type='hidden'][name='"+ pk +"']").val("");
                    _self.show_modal_add_custom();
                }
            });
        }else{
            location.href = url + "?id="+data[pk];
        }
    }
    //告警信息提示
    this.show_hint = function (para, select){
        if(!select) select = "#alert-hint";
        if(!para){ //隐藏
            $(select).addClass('sr-only');
            return;
        }else if(0 == para.code || true==para.result){
            $(select + " strong").text("操作成功!");
            $(select + " span").text('');
            $(select).addClass('alert-success').removeClass('alert-danger').removeClass('sr-only');
        }else{
            $(select + " strong").text("操作失败!");
            $(select + " span").text(para.msg);
            $(select).addClass('alert-danger').removeClass('alert-success').removeClass('sr-only');
        }
        location.href = "#";
    }

    /*增加*/
    this.submit = function (){
        //搜集表单
        //验证
        //提交
        
    }
    /*删除*/
    this.del = function (obj){
        var r=confirm("您确定要删除该条记录？")
        if (r==true) {
            var para = {
                id:$(obj).parents("tr").find("input[type=checkbox]").val()
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
    /*批量删除*/
    this.del_batch = function (obj){
        var tbody = $(_self.table + " tbody");
        if(! tbody.find("input[type=checkbox]:checked").length){
            _self.show_hint({code:-1, msg:'请先勾选选项'});
            return;
        }
        var r=confirm("您确定要删除选中的记录？")
        if (r==true) {
            var para = { id:[]};
            tbody.find("input[type=checkbox]:checked").each(function(){
                para.id.push($(this).val());
            })
            myAjax($(obj), $(obj).data("url"), para, function(data){
                _self.getListWithPage();
                _self.show_hint(data);
            }, function(data){
                _self.show_hint(data);
            });
        }
    }
    
    this.getSearchKey = function(domEle){
        return $(domEle).attr('id').slice(2);
    }
    this.getFilter = function (){
        var where = {};
        var like = {};
        $(_self.form_search_data).each(function(index, domEle){
            var val = $.trim(getFormValue(domEle));
            if(0 == val.length) return true; // false时相当于break, 如果return true 就相当于continure。
            if('1' == $(domEle).data(_self.data_like)){
                like[_self.getSearchKey(domEle)] = val;
            }else{
                where[_self.getSearchKey(domEle)] = val;
            }
        });

        return {where:where, like:like};
    }
    this.getOrder = function (){
        return this.val_order;
    }
    this.setOrder = function (order){
        this.val_order = order;
    }
    this.getPage = function (){
        var page_now = $(_self.div_pagination).data(_self.str_page_now);
        var page_size = $(_self.div_pagination).data(_self.str_page_size);
        if(!page_now) page_now = 1;
        if(!page_size) page_size = $(_self.div_page_size).val();
        return {page_now:page_now, page_size:page_size};
    }
    this.setPage = function(page_no){
        $(_self.div_pagination).data(_self.str_page_now, page_no);
    }
    this.setSort = function (domEle) {
        var has_asc = $(domEle).hasClass('sort_asc');
        var key = $(domEle).data('sort');
        var asc_desc;
        $(domEle).siblings().removeClass("sort_asc").removeClass("sort_desc");
        $(domEle).removeClass("sort_asc").removeClass("sort_desc");
        if(has_asc){
            asc_desc = "desc";
            $(domEle).addClass("sort_desc");
        }else{
            asc_desc = "asc";
            $(domEle).addClass("sort_asc");
        }
        var order = {sort:("asc"==asc_desc?1:2),sortkey:key};
        _self.setOrder(order);
        _self.getListWithPage();
    }
    
    this.select_init_custom = function(){};
    this.modal_init_custom = function(){};
    
    this.modal_show_init = function (response){
        select_init();
        _self.select_init_custom();
        _self.modal_init_custom();
    }
    this.modal_shown_init = function (){
        if($("#map_canvas").length){
            var baidu_map_js = $('body').data('baidu_map_js');
            if(baidu_map_js){
                _self.loadJScript(baidu_map_js);
            }
        }
        $(_self.div_modal).find('input:first').focus();
    }
    
    //百度地图API功能 异步加载
    this.loadJScript = function (baidu_map_js) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = baidu_map_js + '&callback=load_map';
        document.body.appendChild(script);
    }
    
    this.modal_show_func = function (obj){
        var loaded = $(obj).data("load");
        if(loaded && "1" == loaded)
            return;
        var url = $(obj).data("url");
        $(_self.div_modal + ' .modal-body').load(url + " .panel-body", 'modal=1', function(response,status,xhr){
            if('success' == status){
                _self.modal_show_init(response);
                if(!$(_self.div_modal).data("debug")){
                    $(obj).data("load", 1);
                }
            }
        });
    }
    
    //模态框初始化
    this.modal_init = function (){
        $(_self.div_modal).modal({
            backdrop:'static',
            keyboard: false,
            show:false
        }).on('show.bs.modal', function (e) {
            //alert('show.bs.modal');
            _self.modal_show_func(this);
        }).on('shown.bs.modal', function (e) {
            //alert('shown.bs.modal');
            _self.modal_shown_init();
            if("1" != $(_self.div_modal).data("edit")){
                _self.show_modal_add_custom();
            }
        }).on('hide.bs.modal', function (e) {
            //alert('hide.bs.modal');
        }).on('hidden.bs.modal', function (e) {
            if(_self.validator){
                $("input.error").removeClass('error');
                _self.validator.resetForm();
            }
            $(_self.div_modal).find(".alert-hint").addClass("sr-only");
            //alert('hidden.bs.modal');
        });
        //fix modal force focus
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    }
    
    this.init = function(){
        _self.modal_init();
        _self.getListWithPage();
        _self.validator_init();
        select_init();
    }

    /* event */
    $(this.btn_refresh).on('click', function(){
        _self.getListWithPage();
        _self.show_hint();
    });
    $(this.btn_search).on('click', function(){
        _self.setPage(1);
        _self.getListWithPage();
        _self.show_hint();
    });
    $(this.div_page_info).on('change', this.div_page_size, function(){
        var data_ps_obj = $(_self.div_page_info);
        _self.setPage(1);
        var page_total = parseInt($(_self.div_page_total).text(), 10);  //当前记录总条数
        var page_size = parseInt($(this).val(), 10);    //新的每页数
        var data_ps = data_ps_obj.data(_self.str_page_size);    //旧的每页数
        if(data_ps && page_total <= data_ps && page_total <= page_size){
            //总记录数小于等于每页数时 不用处理
            return;
        }

        $(_self.div_pagination).data(_self.str_page_size, page_size);
        data_ps_obj.data(_self.str_page_size, page_size);
        _self.getListWithPage();
        _self.show_hint();
    });
    $(this.btn_check_all).on('click', function(){
        $(_self.btn_check_no).prop("checked", $(this).prop("checked"));
    });
    $(this.div_sort).on('click', function(){
        _self.setSort(this);
        _self.show_hint();
    })
    $(this.table).on('click', this.btn_del, function(){
        _self.del(this);
    })
    $(this.table).on('click', this.btn_show_eidt, function(){
        _self.show_edit(this);
    })
    $(this.btn_submit).on('click', function(){
        _self.submit(this);
    })
    $(this.btn_modal_submit).on('click', function(){
        _self.modal_submit(this);
    })
    $(this.btn_show_add + ", " + this.btn_show_select_add).on('click', function(){
        _self.show_add(this);
    })
    $(this.btn_batch_del).on('click', function(){
        _self.del_batch(this);
    })
    $("body").on('click', '[type=reset]', function(){
        $(".select-base").each(function(){
            $(this).data('select2')['val']([$(this).find("option:first").val()]);
        });
        if(_self.validator){
//            $(".form-control-static").addClass("sr-only").removeClass('form-control-static').text("");
            _self.validator.resetForm();
        }
        return true;    //执行reset
    });
//    _self.init();
}

MyTable.prototype.setTableRefresh = function(fcall) {
    this.table_refresh = fcall;
    return this;
}

MyTable.prototype.setSelectInitCustom = function(fcall) {
    this.select_init_custom = fcall;
    return this;
}

MyTable.prototype.setModalInitCustom = function(fcall) {
    this.modal_init_custom = fcall;
    return this;
}

MyTable.prototype.setShowModalEditCustom = function(fcall) {
    this.show_modal_edit_custom = fcall;
    return this;
}
MyTable.prototype.setShowEditDataHandler = function(fcall) {
    this.show_edit_data_handler = fcall;
    return this;
}

MyTable.prototype.setDel = function(fcall) {
    this.del = fcall;
    return this;
}
MyTable.prototype.setDelBatch = function(fcall) {
    this.del_batch = fcall;
    return this;
}

MyTable.prototype.setShowModalAddCustom = function(fcall) {
    this.show_modal_add_custom = fcall;
    return this;
}
MyTable.prototype.post_data;
MyTable.prototype.before_submit = function(fcall) {}
MyTable.prototype.setBeforeSubmit = function(fcall) {
    this.before_submit = fcall;
    return this;
}

var myTable = new MyTable();
//myTable.init();

function select_init(){
    //初始化基本的select标签
    $(".select-base").each(function(){
        var _self = $(this);
        if(!_self.data('url')){
            return;
        }
        if(_self.data('loaded')){
            return;
        }
        myAjax(_self, _self.data('url'), null, function(data){
            var list = data.list;
            var option_val_key = _self.data('val_key');
            var option_text_key = _self.data('text_key');
            var option_def_text = _self.data('def_text');
            var option_def_val = _self.data('def_val');
            if(undefined == option_def_text) option_def_text = '请选择';
            if(undefined == option_def_val) option_def_val = '';
            if(undefined == option_val_key) option_val_key = 'id';
            if(undefined == option_text_key) option_text_key = 'name';
            _self.empty();
            _self.append($("<option>").val(option_def_val).text(option_def_text));
            for(var i=0; i<list.length; i++){
                _self.append($("<option>").val(list[i][option_val_key]).text(list[i][option_text_key]));
            }
//            _self.val(option_def_val);
            if(""!=_self.data('val')){
                _self.data('select2')['val']([_self.data('val')]);
                _self.data('val', '');
            }else{
                _self.data('select2')['val']([option_def_val]);
            }
            //只ajax加载一次
            _self.data('loaded', true);
        });
    }).select2({
        width:"100%",
//        theme: "classic",
        minimumResultsForSearch: Infinity
    });
    $(".select-ajax").select2({
        language : "zh-CN",
        theme: "classic",
        width:"100%",
        ajax: {
            type: 'post',
            dataType: 'json',
            delay: 250,
            data: function (params) {   // 组装data
              var ret = {
                //q: params.term, // 搜索关键词
                page: params.page,   // 搜索分页
                //field:"name, name id",
                filter:{like:{}},   //name:$.trim(params.term)
                pagination:{page_now:params.page, page_size:6}
              };
              var key = $(this).data("name");
              if(!key){ key = "name";}
              ret.filter.like[key] = $.trim(params.term)
              return ret;
            },
            processResults: function (data, params) {
              // data-返回数据 params-上面的搜索数据
              params.page = params.page || 1;
              return {
                results: data.data,
                pagination: {
                  more: (params.page * data.pageinfo.size) < data.pageinfo.total
                }
              };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        maximumSelectionLength: 8,
        templateResult: function (repo) {
            if (repo.loading) return repo.text;
//            var name = repo.name?repo.name:(repo.key_name?repo.key_name:"请联系管理员");
            var name = repo.name || repo.key_name || repo.company || "请联系管理员";
            
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + name + "</div></div></div>";

            return markup;
        },
        templateSelection: function (repo) {
            return repo.name || repo.key_name || repo.company || repo.text;
        }
    });
//    $(".form-control-static").addClass("sr-only").removeClass('form-control-static');
}

MyTable.prototype.submitHandler = function(form){
//    alert($(form).attr("id"));
    _self = this;
    var para = {};
    for(var i=0; i<form.length; i++){
        if(0 != form[i].name.length){
            para[form[i].name] = getFormValue(form[i]);//form[i].value;
        }
    }
    _self.post_data = para;
    var ret = _self.before_submit();
    if(false == ret)return;
    var data = {};
    for(var k in _self.post_data){
        data[k.replace(/\./,"|")] = _self.post_data[k];
    }
    var alert_obj = $(form).find(".alert-hint");
    myAjax($(form), $(form).find(".panel-body").data('url'), {data:data}, function(data){
        //操作成功，刷新页面，给出提示
        var url = $(form).data('url');
        if(!$(form).data('modal') && url){
            //跳转回列表页面
            window.location.href = url;
            return;
        }
        //modal打开，刷新页面
        _self.getListWithPage();
        _self.show_hint(data);
//                    $(_self.div_modal).modal('hide');
        $(".modal").modal('hide');

    }, function(data){
        //操作失败，给出提示
        alert_obj.find("strong").text("操作失败!");
        alert_obj.find("span").text(data.msg);
        alert_obj.addClass('alert-danger').removeClass('alert-success').removeClass('sr-only');
    });
}

MyTable.prototype.validator_init = function(){
    var _self = this;
    /* jQuery.validatora自定义函数 */
    if(jQuery.validator){
        // 中文字两个字节
        jQuery.validator.addMethod("byteRangeLength", function(value, element, param) {
            var length = value.length;
            for(var i = 0; i < value.length; i++){
                if(value.charCodeAt(i) > 127){
                    length++;
                }
            }
          return this.optional(element) || ( length >= param[0] && length <= param[1] );   
        }, $.validator.format("请确保输入的值在{0}-{1}个字节之间(一个中文字算2个字节)"));

        // 邮政编码验证   
        jQuery.validator.addMethod("isZipCode", function(value, element) {
            var tel = /^[0-9]{6}$/;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的邮政编码");

        // 手机号码验证   
        jQuery.validator.addMethod("isPhone", function(value, element) {
            var tel = /^1[0-9]{10}$/;
            return this.optional(element) || (tel.test(value));
        }, "请正确填写您的手机号码");

        $.validator.setDefaults({
            submitHandler: function(form) {
                _self.submitHandler(form);
            }
        });
        _self.validator = $("#form, #myModal").validate({
            errorPlacement:function(error, element){
                $(error).addClass('col-sm-9 col-sm-push-3');
                $(element).closest(".form-group").append(error);
            }
        });
    }

    //关闭原本的表单错误提示显示
//    $(".form-control-static").addClass("sr-only").removeClass('form-control-static');
}

function alert_hint(title, content){
    var alert_obj = $(".alert-hint");
    alert_obj.find("strong").text(title);
    alert_obj.find("span").text(content);
    alert_obj.addClass('alert-danger').removeClass('alert-success').removeClass('sr-only');
}

$(function(){
    $('[data-toggle="tooltip"]').tooltip();
})

$("#fastNavBtn").on("click", function(){
    var gp = $(this).find(".glyphicon");
    var sw = 0;
    if(gp.hasClass("glyphicon-eye-close")){
        //打开
        gp.removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
        $("#fast-nav").collapse("show");
        sw = 1;
    }else{
        //关闭
        gp.addClass("glyphicon-eye-close").removeClass("glyphicon-eye-open");
        $("#fast-nav").collapse("hide");
    }
    myAjax($(this), '/admin/admin/set_fast_nav/'+sw, null, function(){
        //do nothing
    });
});