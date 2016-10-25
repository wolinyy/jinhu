<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">用户添加</span>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
      </h3>
    </div>
    
    <form class="form-horizontal">
        <div class="panel-body" data-url='/admin/ad/submit'>
            <input type="hidden" name="id">
            <input type="hidden" name="portal_sync_id" value="0">
            <div class="form-group require">
                <label for="company" class="col-sm-3 control-label">策略名</label>
                <div class="col-sm-6">
                    <input class="form-control" name="name" id="name" placeholder="策略名" required>
                </div>
            </div>
            <div class="form-group"> 
                <label for="role" class="col-sm-3 control-label">portal类型</label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        <input type="radio" name="portal_from" id="portal_from" value="1" checked=""> 内部portal
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="portal_from" value="2"> 外部portal
                    </label>
                </div>
            </div>
            <div class="collapse in" id="portal_url_open">
                <div class="form-group require"> 
                    <label for="company" class="col-sm-3 control-label">portal Url</label>
                    <div class="col-sm-6">
                        <input type="url" class="form-control" name="portal_url" id="portal_url" placeholder="portal Url" required >
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <label for="repassword" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <div class="alert alert-hint sr-only">
                        <strong></strong> <span></span>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="panel-footer row">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
</div>