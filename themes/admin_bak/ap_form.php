<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">设备编辑</span>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
      </h3>
    </div>
    
    <form class="form-horizontal">
        <div class="panel-body" data-url='/admin/ap/submit'>
            <div class="form-group">
                <label for="description" class="col-sm-3 control-label">标识名</label>
                <div class="col-sm-6">
                    <input type="hidden" name="mac" id="mac">
                    <input class="form-control" name="description" id="description" placeholder="标识名">
                </div>
            </div>
            <div class="form-group">
                <label for="position_desc" class="col-sm-3 control-label">位置</label>
                <div class="col-sm-6">
                    <input class="form-control" name="position_desc" id="position_desc" placeholder="位置">
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
        <div class="panel-footer row">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
</div>