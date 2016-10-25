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
    
    <form class="form-horizontal" id="form" data-url="/admin/group/">
        <div class="panel-body" data-url="/admin/group/submit">
            <div class="form-group require"> <!-- has-success has-feedback -->
                <label for="name" class="col-sm-3 control-label">策略名称</label>
                <div class="col-sm-6">
                    <input id="id" name="id" value="<?=isset($form['id'])?$form['id']:"";?>" type="hidden">
                    <input class="form-control" id="name" name="name" value="<?=isset($form['name'])?$form['name']:"";?>" placeholder="策略名称" required="" maxlength="32">
                    <span class="glyphicon glyphicon-remove form-control-feedback sr-only"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="ssids_enable" class="col-sm-3 control-label">SSID策略开关</label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        <input type="radio" name="ssids_enable" id="ssids_enable" value="1" checked="" data-checked> 打开
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="ssids_enable" value="0"> 关闭
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="company" class="col-sm-3 control-label">射频选择</label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        <input type="radio" name="radio_type_2g" id="radio_type_2g" value="1" > 只配置到2G射频上
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="radio_type_2g" value="0" checked="" data-checked> 2G 和 5G都配置
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="ssid_id_2gs" class="col-sm-3 control-label">SSID策略</label>
                <div class="col-sm-6">
                    <select class="select-ajax form-control" id="ssid_id_2gs" name="ssid_id_2gs" data-ajax--url="/admin/ssid/newWlanSimple" multiple="multiple">
                        <option value="" selected="">请选择SSID</option>
                        <option value="1" selected>请选择SSID</option>
                        <option value="2" selected>请选择SSID</option>
                    </select>
                </div>
            </div>
            <div class="collapse" id="radio_5g_open">
                <div class="form-group">
                    <label for="company" class="col-sm-3 control-label">5G射频配置开关</label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="radio_type_5g" id="radio_type_5g" value="1" checked="" data-checked> 打开
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="radio_type_5g" value="0"> 关闭
                        </label>
                    </div>
                </div>
                <div class="collapse" id="radio_5g_enable">
                    <div class="form-group">
                        <label for="ssid_id_5gs" class="col-sm-3 control-label">SSID策略</label>
                        <div class="col-sm-6">
                            <select class="select-ajax form-control" id="ssid_id_5gs" name="ssid_id_5gs" data-ajax--url="/admin/ssid/newWlanSimple" multiple="multiple">
                                <option value="">请选择SSID</option>
                            </select>
                        </div>
                    </div>
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