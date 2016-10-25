<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">用户列表</span>
          
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
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/user/show_form' data-modal='1' data-pk='id' >添加</button>
                <!--<button type="button" id="batch_edit" class="btn btn-default" data-url='/admin/user/batch_edit'>批量编辑</button>-->
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/user/batch_del'>批量删除</button>
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
              <label>用户类型</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_role_id">
                      <option value="">全部</option>
                      <option value="0">普通用户</option>
                        <option value="10">分类信息管理员</option>
                        <option value="100">超级管理员</option>
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
        <thead data-get='/admin/user/get'
               data-add='/admin/user/add' data-edit='/admin/user/edit' data-del='/admin/user/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th data-sort='name' class="sort">用户名</th>
                <th data-sort='role_id' class="sort">用户角色</th>
                <th data-sort='phone' class="sort">联系电话</th>
                <th data-sort='email' class="sort">联系邮箱</th>
                <th data-sort='status' class="sort">状态</th>
                <th data-sort='create_at' class="sort">创建时间</th>
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