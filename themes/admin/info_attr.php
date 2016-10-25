<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">属性列表</span>
          
          <div class="btn-toolbar">
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#search-div">
                    <span class="glyphicon glyphicon-search"></span> 搜索
                </button>
                <button type="button" class="btn btn-default refresh">
                    <span class="glyphicon glyphicon-refresh"></span> 刷新
                </button>
            </div>
            <div class="btn-group btn-group-sm">
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/info_attr/show_form' data-modal='1' data-pk='id' >添加</button>
                <!--<button type="button" id="batch_edit" class="btn btn-default" data-url='/admin/info_attr/batch_edit'>批量编辑</button>-->
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/info_attr/batch_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <form class="panel-body collapse" id="search-div">
        <div class="form-inline clearfix">
            <div class="form-group">
              <label for="q_name">属性名称</label>
              <input type="text" class="form-control" id='q_name' data-like="1" placeholder="属性名称">
            </div>
            <div class="form-group">
              <label>一级分类</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_type_id" data-url="/admin/info_type/getT1Name"
                    data-val_key="id" data-text_key="name">
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label>二级分类</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_type2_id" data-url="/admin/info_type/getT2Name"
                    data-val_key="id" data-text_key="name">
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label>类型</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_level">
                      <option value="">全部</option>
                      <option value="1">行文本</option>
                        <option value="2">单选</option>
                        <option value="3">多选</option>
                        <option value="4">文本域</option>
                  </select>
              </div>
            </div>
            <div class="form-group my-serach-btn">
                <button type="button" id="search-btn" class="btn btn-default">搜索</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
    
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead data-get='/admin/info_attr/get'
               data-add='/admin/info_attr/add' data-edit='/admin/info_attr/edit' data-del='/admin/info_attr/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th data-sort='name' class="sort">名称</th>
                <th data-sort='type_id' class="sort">一级分类</th>
                <th data-sort='type2_id' class="sort">二级分类</th>
                <th data-sort='type' class="sort">类型</th>
                <th data-sort='value' class="sort">属性值</th>
                <th data-sort='order' class="sort">排序</th>
                <th class="operation" style="min-width:50px;">操作</th>
            </tr>
        </thead><tbody></tbody>
      </table>
    </div>
    <div class="panel-footer">
        <div class="dataTables_pagination">
            <div class="dataTables_info"></div>
            <ul id="Pagination" class="pagination"></ul>
        </div>
    </div>
</div>