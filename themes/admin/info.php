<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">信息列表</span>
          
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
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/info/show_form' data-modal='0' data-pk='id' >添加</button>
                <button type="button" id="batch_edit_review" class="btn btn-default">批量审核</button>
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/info/batch_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <form class="panel-body collapse" id="search-div">
        <div class="form-inline clearfix">
            <div class="form-group">
              <label for="q_name">用户名</label>
              <input type="text" class="form-control" id='q_name' data-like="1" placeholder="用户名">
            </div>
            <div class="form-group">
              <label for="q_phone">联系电话</label>
              <input type="text" class="form-control" id="q_phone" data-like="1" placeholder="联系电话">
            </div>
            <div class="form-group">
              <label for="q_email">联系邮箱</label>
              <input type="text" class="form-control" id='q_email' data-like="1" placeholder="联系邮箱">
            </div>
            <div class="form-group">
              <label>状态</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_status">
                      <option value="">全部</option>
                      <option value="0">未审核</option>
                      <option value="1">可信用户，自动通过</option>
                      <option value="2">人工审核-通过</option>
                      <option value="3">人工审核-失败</option>
                      <option value="4">被多人举报，不可见</option>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label>是否删除</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_is_delete">
                      <option value="">全部</option>
                      <option value="0">未删除</option>
                      <option value="1">已删除</option>
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
        <thead data-get='/admin/info/get'
               data-add='/admin/info/add' data-edit='/admin/info/edit' data-del='/admin/info/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th>信息类型</th>
                <th>区域</th>
                <th>标题</th>
                <th>内容</th>
                <th data-sort='name' class="sort">联系人</th>
                <th data-sort='phone' class="sort">联系电话</th>
                <th>状态</th>
                <th>是否删除</th>
                <th data-sort='create_at' class="sort">创建时间</th>
                <th data-sort='update_at' class="sort">更新时间</th>
                <th>有效时长</th>
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

<!--模态框-->
<div id="StatusModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">批量审核状态</h4>
      </div>
      <div class="modal-body form-horizontal text-center">
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">状态</label>
                <div class="col-sm-6">
                    <select class="form-control select-base" id="status" name="status">
                        <option value="0">未审核</option>
                        <option value="1">可信用户，自动通过</option>
                        <option value="2">人工审核-通过</option>
                        <option value="3">人工审核-失败</option>
                        <option value="4">被多人举报，不可见</option>
                    </select>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="btnStatusSure" data-url='/admin/info/batch_edit_review'>提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->