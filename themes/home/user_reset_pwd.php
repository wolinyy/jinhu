<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info" id="reg_form">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">
            <?php if(!isset($email) || empty($email)):?>
                修改密码
            <?php else:?>
                重置密码
            <?php endif;?>
          </span>
      </h3>
    </div>
    
    <form class="form-horizontal" id='form' method="post" action="<?=  site_url('/user/do_reset_pwd');?>">
        <div class="panel-body">
            <input type="hidden" id="id" name="id" value="<?=$id;?>">
            <?php if(!isset($email) || empty($email)):?>
            <div class="form-group require"> 
                <label for="passwd" class="col-sm-3 control-label">原始密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="oldpasswd" name="oldpasswd" maxlength="32" placeholder="原始密码">
                </div>
            </div>
            <?php else:?>
            <input type="hidden" id="code" name="code" value="<?=$code;?>">
            <?php endif;?>
            <div class="form-group require">
                <label for="passwd" class="col-sm-3 control-label">新密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="passwd" name="passwd" maxlength="32" placeholder="新密码" required rangelength='[6,18]'>
                </div>
            </div>
            <div class="form-group require"> 
                <label for="repasswd" class="col-sm-3 control-label">确认密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="repasswd" name="repasswd" maxlength="32" placeholder="确认密码" required equalTo="#passwd">
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
<script>
    $("#form, #myModal").validate({
        errorPlacement:function(error, element){
            $(element).after(error);
        },
    });
</script>