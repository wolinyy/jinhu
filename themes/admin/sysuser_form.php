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
        <div class="panel-body" data-url='/admin/sysuser/submit'>
            <input type="hidden" name='id' id="id" value="<?=isset($form['id'])?$form['id']:"";?>">
            <?php if(!isset($update_flag)):?>
            <div class="form-group">
                <label for="role" class="col-sm-3 control-label">用户类型</label>
                <div class="col-sm-6">
                    
                    <select class="form-control select-base" id="role" name="role">
                        <?php if(in_array($role_id, array(1,11,12,13))):?>
                        <option value="100">下级代理商</option>
                        <?php endif;?>
                        <?php if(in_array($role_id, array(1,11,12,13,14))):?>
                        <option value="21">客户</option>
                        <option value="22">只读客户</option>
                        <?php endif;?>
                        <?php if(in_array($role_id, array(11,12,13,14))):?>
                        <option value="31">代理商资源可读账号</option>
                        <?php endif;?>
                    </select>
                    
<!--                    <label class="radio-inline">
                        <input type="radio" name="role" id="role" value="2" <?=isset($form)&&2==$form['role']?"checked":"";?> > 下级代理商
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="role" value="3" <?=!isset($form)||3==$form['role']?"checked":"";?> > 商家/用户
                    </label>-->
                </div>
            </div>
            <?php else:?>
            <input type="hidden" name='update_self' value="1">
            <?php endif;?>
            <div class="form-group require"> 
                <label for="company" class="col-sm-3 control-label">企业名称</label>
                <div class="col-sm-6">
                    <input class="form-control" name="company" id="company" value="<?=isset($form['company'])?$form['company']:"";?>" placeholder="企业名称" required>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="contact" class="col-sm-3 control-label">联系人</label>
                <div class="col-sm-6">
                    <input class="form-control" id="contact" name="contact" value="<?=isset($form['contact'])?$form['contact']:"";?>" placeholder="联系人" required>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="phone" class="col-sm-3 control-label">联系电话</label>
                <div class="col-sm-6">
                    <input class="form-control" id="phone" name="phone" placeholder="联系电话" value="<?=isset($form['phone'])?$form['phone']:"";?>" required isPhone="true">
                </div>
            </div>
            <div class="form-group require"> 
                <label for="username" class="col-sm-3 control-label">登录名称</label>
                <div class="col-sm-6">
                    <input class="form-control" id="username" name="username" placeholder="登录名称" value="<?=isset($form['username'])?$form['username']:"";?>" required rangelength='[5,18]'>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="password" class="col-sm-3 control-label">密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="密码" required rangelength='[6,18]'>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="repassword" class="col-sm-3 control-label">确认密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="确认密码" required equalTo="#password">
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