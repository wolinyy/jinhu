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
        <div class="panel-body" data-url='/admin/info_attr/submit'>
            <input type="hidden" name='id' id="id" value="<?=isset($form['id'])?$form['id']:"";?>">
            <div class="form-group require"> 
                <label for="name" class="col-sm-3 control-label">名称</label>
                <div class="col-sm-6">
                    <input class="form-control" name="name" id="name" value="<?=isset($form['name'])?$form['name']:"";?>" placeholder="用户名" required>
                </div>
            </div>
            <div class="form-group region require"> 
                <label class="col-sm-3 control-label">分类名称</label>
                <div class="col-sm-2 ">
                    <select id="type_id" name="type_id" class="select-base form-control"
                            data-val ="<?=isset($form['type_id'])?$form['type_id']:"";?>"
                            data-url="/admin/info_type/getT1Name" data-def_text='一级分类'>
                        <option value="">一级分类</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select id="type2_id" name="type2_id" class="select-base form-control"
                            data-val ="<?=isset($form['type2_id'])?$form['type2_id']:"";?>"
                            data-def_text='二级分类'>
                        <option value="">二级分类</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">类型</label>
                <div class="col-sm-6">
                    <select class="form-control select-base" id="type" name="type">
                        <option value="1">字符行文本</option>
                        <option value="2">单选</option>
                        <option value="3">多选</option>
                        <option value="4">文本域</option>
                        <option value="5">数值行文本</option>
                    </select>
                </div>
            </div>
            <div class="form-group"> 
                <label for="value" class="col-sm-3 control-label">属性值</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="value" name="value" rows="10" placeholder="属性值" value="<?=isset($form['value'])?$form['value']:"";?>"></textarea>
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