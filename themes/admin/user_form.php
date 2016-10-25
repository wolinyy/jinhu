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
        <div class="panel-body" data-url='/admin/user/submit'>
            <input type="hidden" name='id' id="id" value="<?=isset($form['id'])?$form['id']:"";?>">
            <div class="form-group require"> 
                <label for="name" class="col-sm-3 control-label">用户名</label>
                <div class="col-sm-6">
                    <input class="form-control" name="name" id="name" value="<?=isset($form['name'])?$form['name']:"";?>" placeholder="用户名" required>
                </div>
            </div>
            <?php if(!isset($update_flag)):?>
            <div class="form-group">
                <label for="role_id" class="col-sm-3 control-label">用户类型</label>
                <div class="col-sm-6">
                    
                    <select class="form-control select-base" id="role_id" name="role_id">
                        <option value="0">普通用户</option>
                        <option value="10">分类信息管理员</option>
                        <option value="100">超级管理员</option>
                    </select>
                </div>
            </div>
            <?php else:?>
            <input type="hidden" name='update_self' value="1">
            <?php endif;?>
            <div class="form-group require"> 
                <label for="phone" class="col-sm-3 control-label">联系电话</label>
                <div class="col-sm-6">
                    <input class="form-control" id="phone" name="phone" placeholder="联系电话" value="<?=isset($form['phone'])?$form['phone']:"";?>" required isPhone="true">
                </div>
            </div>
            <div class="form-group require"> 
                <label for="email" class="col-sm-3 control-label">联系邮箱</label>
                <div class="col-sm-6">
                    <input class="form-control" type="email" id="email" name="email" placeholder="联系邮箱" value="<?=isset($form['phone'])?$form['phone']:"";?>" required >
                </div>
            </div>
            <div class="form-group require"> 
                <label for="passwd" class="col-sm-3 control-label">密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="密码" required rangelength='[6,18]'>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="repasswd" class="col-sm-3 control-label">确认密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="repasswd" name="repasswd" placeholder="确认密码" required equalTo="#passwd">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-3 control-label">账号状态</label>
                <div class="col-sm-6">
                    
                    <select class="form-control select-base" id="status" name="status">
                        <option value="0">添加未激活</option>
                        <option value="1">已经激活</option>
                        <option value="2">黑名单</option>
                    </select>
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