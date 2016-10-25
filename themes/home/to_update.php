<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info" id="reg_form">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">用户注册</span>
      </h3>
    </div>
    
    <form class="form-horizontal" id='form' data-url="<?=site_url('/user/user_reg_succ');?>">
        <div class="panel-body" data-url='<?=site_url('/user/do_reg');?>'>
            <div class="form-group require"> 
                <label for="name" class="col-sm-3 control-label">用户名</label>
                <div class="col-sm-6">
                    <input class="form-control" name="name" id="name" maxlength="32" value="" placeholder="用户名" required>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="phone" class="col-sm-3 control-label">联系电话</label>
                <div class="col-sm-6">
                    <input class="form-control" id="phone" name="phone" maxlength="32" placeholder="联系电话" value="" required isPhone="true">
                </div>
            </div>
            <div class="form-group require"> 
                <label for="email" class="col-sm-3 control-label">联系邮箱</label>
                <div class="col-sm-6">
                    <input class="form-control" type="email" id="email" name="email" maxlength="64" placeholder="需要邮箱验证激活" value="" required >
                </div>
            </div>
            <div class="form-group require"> 
                <label for="passwd" class="col-sm-3 control-label">密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="passwd" name="passwd" maxlength="32" placeholder="密码" required rangelength='[6,18]'>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="repasswd" class="col-sm-3 control-label">确认密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="repasswd" name="repasswd" maxlength="32" placeholder="确认密码" required equalTo="#passwd">
                </div>
            </div>
            <div class="form-group require"> 
                <label for="vCode" class="col-xs-12 col-sm-3 control-label">验证码</label>
                <div class="col-xs-6 col-sm-3">
                    <input class="form-control" name="vCode" id="vCode" maxlength="8" placeholder="验证码" required>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <img id="code" onclick="document.getElementById('code').src='<?=site_url('user/reg_code?tm=');?>'+Math.random()" src="<?=site_url('user/reg_code');?>" class="img-responsive img-rounded">
                </div>
            </div>
            
            <div class="form-group hide" id="hint">
                <label for="" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <div class="alert alert-hint sr-only">
                        <strong></strong> <span></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group"> 
                <label for="" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary">提交</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="reset" class="btn btn-danger">重置</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="<?=ASSETS;?>jquery/validation/jquery.validate.min.js"></script>
<script src="<?=ASSETS;?>jquery/validation/localization/messages_zh.js"></script>
    
<script src="<?=HOME_ASSERTS;?>js/common.js"></script>
<script src="<?=HOME_ASSERTS;?>js/user_reg.js"></script>