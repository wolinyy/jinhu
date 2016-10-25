<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title text-right">
          <span class=" pull-left">AP列表</span>
          
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
                <?php if(! in_array($role_id, array(22))):?>
                <button id='batch_update_proj' type="button" class="btn btn-default" data-url='/admin/ap/update_proj' data-modal="1">批量划分项目</button>
                <?php if(! in_array($role_id, array(21,22))):?>
                <button id='batch_update_user' type="button" class="btn btn-default" data-url='/admin/ap/update_user' data-modal="1">批量划分用户</button>
                <?php endif;?>
                <button id='batch_update_group' type="button" class="btn btn-default" data-url='/admin/ap/update_group' data-modal="1">批量配置分组</button>
                <?php endif;?>
            </div>
            <div class="btn-group btn-group-sm sr-only">
                <button id='show_add' type="button" class="btn btn-default" data-url='/admin/ap/show_form' data-modal="1">添加</button>
                <button type="button" id="batch_del" class="btn btn-default" data-url='/admin/ap/batch_del'>批量删除</button>
            </div>
          </div>
      </h3>
    </div>
    
    <form class="panel-body collapse" id="search-div">
        <div class="form-inline clearfix">
            <div class="form-group">
              <label for="q_mac">MAC</label>
              <input type="text" class="form-control" id="q_mac" data-like="1" placeholder="MAC">
            </div>
            <div class="form-group">
              <label for="q_description">标识名</label>
              <input type="text" class="form-control" id='q_description' data-like="1" placeholder="标识名">
            </div>
            <div class="form-group my-serach-btn">
                <button type="button" id="search-btn" class="btn btn-default">搜索</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
        <thead data-get='/admin/ap/get' data-add='/admin/ap/add' data-edit='/admin/ap/edit' data-del='/admin/ap/del'>
            <tr>
                <th><label class="checkbox-inline">&nbsp;<input type="checkbox" id="check-all" value="option1"> 序号</label></th>
                <th data-sort='mac' class="sort">MAC</th>
                <th data-sort='description' class="sort">标识名</th>
                <th data-sort='proj_id' class="sort">所属项目</th>
                <th data-sort='account_id' class="sort">归属用户</th>
                <th data-sort='group_id' class="sort">网络分组</th>
                <th data-sort='model' class="sort">型号</th>
                <th data-sort='serial_num' class="sort">序列号</th>
                <th data-sort='sw_ver' class="sort">版本号</th>
                <th data-sort='position_desc' class="sort">位置</th>
                <th data-sort='status' class="sort">状态</th>
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
        <h4 class="modal-title">批量划分用户</h4>
      </div>
      <div class="modal-body form-horizontal">
        <div class="panel-body" data-url="/admin/ap/update_user">
            <div class="form-group">
                  <label for="owner_id" class="col-sm-3 control-label">用户</label>
                  <div class="col-sm-6">
                      <select class="select-ajax form-control" id="owner_id" name="owner_id" data-name="company" data-ajax--url="/admin/sysuser/getSimple">
                          <option value="">请选择用户</option>
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

<!--模态框-->
<form id="update_proj_modal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">批量划分项目</h4>
      </div>
      <div class="modal-body form-horizontal">
        <div class="panel-body" data-url="/admin/ap/update_proj">
            <div class="form-group">
                  <label for="proj_id" class="col-sm-3 control-label">项目</label>
                  <div class="col-sm-6">
                      <select class="select-ajax form-control" id="proj_id" name="proj_id" data-ajax--url="/admin/proj/get">
                          <option value="">请选择项目</option>
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

<!--模态框-->
<form id="update_group_modal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">批量配置分组</h4>
      </div>
      <div class="modal-body form-horizontal">
        <div class="panel-body" data-url="/admin/ap/update_group">
            <div class="form-group">
                  <label for="group_id" class="col-sm-3 control-label">网络分组</label>
                  <div class="col-sm-6">
                      <select class="select-ajax form-control" id="group_id" name="group_id" data-ajax--url="/admin/group/getSimple">
                          <option value="">请选择分组</option>
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
