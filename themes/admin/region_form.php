<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6"><?=isset($form)?"编辑":"用户添加";?></span>
          <?php if(!isset($update_flag)):?>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
          <?php endif;?>
      </h3>
    </div>
    
    <form class="form-horizontal" id='form'>
        <div class="panel-body" data-url='/admin/region/submit'>
            <input type="hidden" name='id' id="id" value="<?=isset($form['id'])?$form['id']:"";?>">
            <div class="form-group require"> 
                <label for="name" class="col-sm-3 control-label">区域名称</label>
                <div class="col-sm-6">
                    <input class="form-control" name="name" id="name" value="<?=isset($form['name'])?$form['name']:"";?>" placeholder="用户名" required>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="pid" class="col-sm-3 control-label">父级区域名称</label>
                <div class="col-sm-6">
                    <select id="pid" name="pid" class="select-base form-control"
                            data-val ="<?=isset($form['pid'])?$form['pid']:"";?>"
                            data-url="/admin/region/getName" data-val_key="id" data-text_key="name">
                        <option value="">选择父级区域</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">类型</label>
                <div class="col-sm-6">
                    <select class="form-control select-base" id="type" name="type">
                        <option value="1">镇</option>
                        <option value="2">乡村</option>
                    </select>
                </div>
            </div>
            <div class="form-group"> 
                <label for="order" class="col-sm-3 control-label">排序</label>
                <div class="col-sm-6">
                    <input class="form-control" id="order" name="order" placeholder="排序" value="<?=isset($form['order'])?$form['order']:"100";?>">
                </div>
            </div>
            <div class="form-group"> 
                <label for="" class="col-sm-3 control-label"></label>
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