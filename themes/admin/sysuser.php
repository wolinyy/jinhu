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
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/sysuser/show_form' data-modal='1' data-pk='id' >添加</button>
                <!--<button type="button" id="batch_edit" class="btn btn-default" data-url='/admin/sysuser/batch_edit'>批量编辑</button>-->
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/sysuser/batch_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <form class="panel-body collapse" id="search-div">
        <div class="form-inline clearfix">
            <div class="form-group">
              <label for="q_company">用户名称</label>
              <input type="text" class="form-control" id='q_company' data-like="1" placeholder="用户名称">
            </div>
            <div class="form-group">
              <label for="q_contact">联系人</label>
              <input type="text" class="form-control" id='q_contact' data-like="1" placeholder="联系人">
            </div>
            <div class="form-group">
              <label>用户类型</label>
              <div class="form-control my-form-control">
                  <select class="form-control select-base" id="q_role">
                      <option value="">全部</option>
                        <?php if(in_array($role_id, array(1,11,12,13))):?>
                        <option value="100">代理商</option>
                        <?php endif;?>
                        <?php if(in_array($role_id, array(1,11,12,13,14))):?>
                        <option value="21">客户</option>
                        <option value="22">只读客户</option>
                        <?php endif;?>
                        <?php if(in_array($role_id, array(11,12,13,14))):?>
                        <option value="31">代理商资源可读账号</option>
                        <?php endif;?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label for="q_phone">联系电话</label>
              <input type="text" class="form-control" id="q_phone" data-like="1" placeholder="联系电话">
            </div>
            <div class="form-group">
              <label for="q_username">登录名</label>
              <input type="text" class="form-control" id="q_username" data-like="1" placeholder="登录名称">
            </div>
            <div class="form-group my-serach-btn">
                <button type="button" id="search-btn" class="btn btn-default">搜索</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
    
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead data-get='/admin/sysuser/get'
               data-add='/admin/sysuser/add' data-edit='/admin/sysuser/edit' data-del='/admin/sysuser/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th data-sort='username' class="sort">用户名称</th>
                <th data-sort='role' class="sort">用户类型</th>
                <th data-sort='contact' class="sort">联系人</th>
                <th data-sort='phone' class="sort">联系电话</th>
                <th>登录名称</th>
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