<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">SSID<?=isset($form)?"编辑":"添加";?></span>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
      </h3>
    </div>
    
    <form class="form-horizontal" id="form" data-url="/admin/ssid/">
        <div class="panel-body" data-url="/admin/ssid/submit">
            <div class="form-group require"> <!-- has-success has-feedback -->
                <label for="key_name" class="col-sm-3 control-label">策略名称</label>
                <div class="col-sm-6">
                    <input id="id" name="id" value="<?=isset($form['id'])?$form['id']:"";?>" type="hidden">
                    <input class="form-control" id="key_name" name="key_name" value="<?=isset($form['key_name'])?$form['key_name']:"";?>" placeholder="策略名称" required="" maxlength="32">
                    <span class="glyphicon glyphicon-remove form-control-feedback sr-only"></span>
                </div>
            </div>
            <div class="form-group require"> <!-- has-success has-feedback -->
                <label for="ssid" class="col-sm-3 control-label">SSID名称</label>
                <div class="col-sm-6">
                    <input class="form-control" id="ssid" name="ssid" value="<?=isset($form['ssid'])?$form['ssid']:"";?>" placeholder="SSID名称" required="" maxlength="32">
                    <span class="glyphicon glyphicon-remove form-control-feedback sr-only"></span>
                </div>
            </div>
            <div class="form-group"> 
                <label for="role" class="col-sm-3 control-label">编码方式</label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        <input type="radio" name="ssid_enctype" id="ssid_enctype" value="0" <?=!isset($form['ssid_enctype']) || 0==$form['ssid_enctype']?"checked":"";?>> UTF-8
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="ssid_enctype" value="1" <?=isset($form['ssid_enctype']) && 1==$form['ssid_enctype']?"checked":"";?>> GB2312
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="ssid_enctype" value="2" <?=isset($form['ssid_enctype']) && 2==$form['ssid_enctype']?"checked":"";?>> Both（UTF-8 和 GB2312）
                    </label>
                </div>
            </div>
            <div class="form-group"> 
                <label for="role" class="col-sm-3 control-label">是否加密</label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        <input type="radio" name="auth_type" id="auth_type" value="0" <?=!isset($form['auth_type']) || 0==$form['auth_type']?"checked":"";?>> 不加密
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="auth_type" value="3" <?=isset($form['auth_type']) && 3==$form['auth_type']?"checked":"";?>> 加密
                    </label>
                </div>
            </div>
            <div class="collapse in" id="auth_key_open">
                <div class="form-group require"> 
                    <label for="auth_key" class="col-sm-3 control-label">加密密钥</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="auth_key" id="auth_key" value="<?=isset($form['auth_key'])?$form['auth_key']:"";?>" placeholder="加密密钥" required  maxlength="64" minlength="8">
                    </div>
                </div>
            </div>
            
            <div class="form-group"> 
                <label for="portal_auth_enable" class="col-sm-3 control-label">是否认证</label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        <input type="radio" name="portal_auth_enable" id="portal_auth_enable" value="1" <?=!isset($form['portal_auth_enable']) || 1==$form['portal_auth_enable']?"checked":"";?>> 打开
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="portal_auth_enable" value="0" <?=isset($form['portal_auth_enable']) && 0==$form['portal_auth_enable']?"checked":"";?>> 关闭
                    </label>
                </div>
            </div>
            <div class="form-group"> 
                <label for="vlan_id" class="col-sm-3 control-label">VLAN ID</label>
                <div class="col-sm-6">
                    <input class="form-control" name="vlan_id" id="vlan_id" value="<?=isset($form['vlan_id'])?$form['vlan_id']:"0";?>" placeholder="VLAN ID" required min="0" max="4095">
                </div>
            </div>
            <div class="form-group"> <!-- has-success has-feedback -->
                <label for="auth_id" class="col-sm-3 control-label">认证策略</label>
                <div class="col-sm-6">
                    <select class="select-ajax form-control" id="auth_id" name="auth_id" data-ajax--url="/admin/auth/get">
                        <?php if(isset($form['auth_id'])):?>
                        <option value="<?=$form['auth_id'];?>"><?=$form['authstrategy']['name'];?></option>
                        <?php else:?>
                            <option value="">请选择认证策略</option>
                        <?php endif;?>
                    </select>
                </div>
                <!--<button type="button" class="btn btn-link show_select_add" data-url='/admin/auth/show_form' data-modal="1" data-debug="1">添加新策略</button>-->
            </div>
            <div class="form-group"> <!-- has-success has-feedback -->
                <label for="portal_id" class="col-sm-3 control-label">广告策略</label>
                <div class="col-sm-6">
                    <select class="select-ajax form-control" id="portal_id" name="portal_id" data-ajax--url="/admin/ad/get">
                        <?php if(isset($form['portal_id'])):?>
                        <option value="<?=$form['portal_id'];?>"><?=$form['portalstrategy']['name'];?></option>
                        <?php else:?>
                            <option value="">请选择广告策略</option>
                        <?php endif;?>
                    </select>
                </div>
                <!--<button type="button" class="btn btn-link show_select_add" data-url='/admin/ad/show_form' data-modal="1" data-debug="1">添加新策略</button>-->
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