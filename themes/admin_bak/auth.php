<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">认证列表</span>
          
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
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/auth/show_form' data-modal='1'>添加</button>
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/auth/batch_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <form class="panel-body collapse" id="search-div">
        <div class="form-inline clearfix">
            <div class="form-group">
              <label for="q_name">策略名称</label>
              <input type="text" class="form-control" id='q_name' data-like="1" placeholder="项目名称">
            </div>
            <div class="form-group my-serach-btn">
                <button type="button" id="search-btn" class="btn btn-default">搜索</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
    
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead data-get='/admin/auth/get' data-add='/admin/auth/add' data-edit='/admin/auth/edit' data-del='/admin/auth/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th data-sort='name' class="sort">策略名</th>
                <th>认证时长</th>
                <th>广告时长</th>
                <th>手机认证</th>
                <th>微信认证</th>
                <th>一键认证</th>
                <th>免费体验</th>
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
