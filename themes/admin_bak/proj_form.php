<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">项目<?=isset($form['id'])?"编辑":"添加";?></span>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
      </h3>
    </div>
    
    <form class="form-horizontal" data-url='/admin/proj'>
        <div class="panel-body" data-url='/admin/proj/submit'>
            
            <div class="col-md-10 col-md-offset-1">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                  <li class="active"><a href="#basic_conf" id="basic-tab" data-toggle="tab">基本配置</a></li>
                  <li><a href="#bind_conf" id="phone-tab" data-toggle="tab">绑定策略</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="basic_conf">
                        <div class="form-group require">
                            <label for="name" class="col-sm-3 control-label">项目名称</label>
                            <div class="col-sm-6">
                                <input id="id" name="id" value="<?=isset($form['id'])?$form['id']:"";?>" type="hidden">
                                <input id="zoom" name="zoom" value="<?=isset($form['zoom'])?$form['zoom']:"";?>" type="hidden">
                                <input class="form-control" id="name" name="name" value="<?=isset($form['name'])?$form['name']:"";?>" placeholder="项目名称" required="">
                            </div>
                        </div>
                        <div class="form-group"> 
                            <label for="contact" class="col-sm-3 control-label">联系人</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="contact" name="contact" value="<?=isset($form['contact'])?$form['contact']:"";?>" placeholder="若绑定用户，不必填写">
                            </div>
                        </div>
                        <div class="form-group"> 
                            <label for="phone" class="col-sm-3 control-label">联系电话</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="phone" name="phone" value="<?=isset($form['phone'])?$form['phone']:"";?>" placeholder="若绑定用户，不必填写" isPhone="true">
                            </div>
                        </div>
                        <div class="form-group require"> 
                            <label for="name" class="col-sm-3 control-label">行业类别</label>
                            <div class="col-sm-6">
                                <select id="industry" name="industry" class="select-base form-control"
                                        data-val ="<?=isset($form['industry'])?$form['industry']:"";?>"
                                        data-url="/admin/proj/getIndustry" data-val_key="id" data-text_key="name">
                                    <option value="">选择行业</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group region require"> 
                            <label for="name" class="col-sm-3 control-label">所在区域</label>
                            <div class="col-sm-2 ">
                                <select id="province" name="province" class="select-base form-control"
                                        data-val ="<?=isset($form['province'])?$form['province']:"";?>"
                                        data-url="/admin/proj/getProvince" data-def_text='省'>
                                    <option value="">省</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="city" name="city" class="select-base form-control"
                                        data-val ="<?=isset($form['city'])?$form['city']:"";?>"
                                        data-def_text='市'>
                                    <option value="">市</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="area" name="area" class="select-base form-control"
                                        data-val ="<?=isset($form['area'])?$form['area']:"";?>"
                                        data-def_text='区'>
                                    <option value="">区</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group require">
                            <label for="name" class="col-sm-3 control-label">详细地址</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input name="address" id="address" value="<?=isset($form['address'])?$form['address']:"";?>" class="form-control" placeholder="详细地址" type="text" required>
                                    <span class="input-group-btn">
                                        <button id="search_address" class="btn btn-default" type="button">定位</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group require">
                            <label for="name" class="col-sm-3 control-label">坐标定位</label>
                            <div class="col-sm-6 form-inline">
                                <div class="input-group col-sm-12">
                                    <div class="input-group-addon">经度</div>
                                    <input id="lng" name="lng" value="<?=isset($form['lng'])?$form['lng']:"";?>" class="form-control" required placeholder="经度" type="text">
                                    <div class="input-group-addon">纬度</div>
                                    <input id="lat" name="lat" value="<?=isset($form['lat'])?$form['lat']:"";?>" class="form-control" required placeholder="纬度" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">地图显示</label>
                            <div class="col-sm-6">
                                <div class="img-responsive" style="height:200px;border:1px solid #000" id="map_canvas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bind_conf">
                        <div class="form-group">
                            <label for="account_id" class="col-sm-3 control-label">绑定用户</label>
                            <div class="col-sm-6">
                                <select class="select-ajax form-control" id="account_id" name="account_id" data-ajax--url="/admin/sysuser/getSimple">
                                    <option value="">请选择</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-3 control-label">绑定网络分组</label>
                            <div class="col-sm-6">
                                <select class="select-ajax form-control" id="group_id" name="group_id" data-ajax--url="/admin/group/getSimple">
                                    <option value="">请选择分组</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">绑定策略作用</label><div class="col-sm-6">
                                <div class="alert alert-info">
                                    <strong>AP上切换项目时</strong><p>&nbsp;&nbsp;绑定策略会一同下发，配置到AP设备上</p>
                                    <strong>项目上修改绑定策略时</strong><p>&nbsp;&nbsp;AP设备上的绑定策略<strong>不会</strong>发生改变</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <div class="alert alert-danger alert-hint sr-only">
                            <strong></strong> <span></span>
                        </div>
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

<script type="text/javascript" src="<?=BAIDU_MAP_JS;?>"></script>