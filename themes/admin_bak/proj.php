<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">项目列表</span>
          
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
                <button type="button" id="batch_update_user" class="btn btn-default" data-url='/admin/proj/batch_update_user'>批量切换客户</button>
            </div>
            <div class="btn-group btn-group-sm">
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/proj/show_form' data-modal='1'>添加</button>
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/proj/batch_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <form class="panel-body collapse" id="search-div">
        <div class="form-inline clearfix">
            <div class="form-group">
              <label for="q_name">项目名称</label>
              <input type="text" class="form-control" id='q_name' data-like="1" placeholder="项目名称">
            </div>
            <div class="form-group">
              <label>所属行业</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_industry" data-url="/admin/proj/getIndustry"
                          data-val_key="id" data-text_key="name">
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
        <thead data-get='/admin/proj/get' data-add='/admin/proj/add' data-edit='/admin/proj/edit' data-del='/admin/proj/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th data-sort='name' class="sort">项目名称</th>
                <th data-sort='account_id' class="sort">所属客户</th>
                <th>网络分组</th>
                <th data-sort='contact' class="sort">联系人</th>
                <th data-sort='phone' class="sort">联系电话</th>
                <th data-sort='industry' class="sort">所属行业</th>
                <th>所在区域</th>
                <th><span data-toggle="tooltip" data-placement="top" title="显示AP 在线数 / 总数">设备统计</span></th>
                <?php if(! in_array($role_id, $role_readonly)):?>
                <th class="operation" style="min-width:50px;">操作</th>
                <?php endif;?>
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

<!--模态框-->
<form id="update_user_modal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">批量切换客户</h4>
      </div>
      <div class="modal-body form-horizontal">
        <div class="panel-body" data-url="/admin/proj/update_user">
            <div class="form-group">
                  <label for="owner_id" class="col-sm-3 control-label">所属客户</label>
                  <div class="col-sm-6">
                      <select class="select-ajax form-control" id="owner_id" name="owner_id" data-ajax--url="/admin/sysuser/getSimple">
                          <option value="">请选择</option>
                      </select>
                  </div>
              </div>
            <div class="form-group"> 
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <div class="alert alert-hint sr-only">
                        <strong></strong> <span></span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form><!-- /.modal -->