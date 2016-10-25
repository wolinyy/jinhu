<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="row panel-title">
          <span class="col-xs-6">添加</span>
          <div class="col-xs-6 text-right">
              <button type="button" class="btn btn-primary" onclick="window.history.back()">返回</button>
          </div>
      </h3>
    </div>
    
    <form class="form-horizontal" id="form">
        <div class="panel-body" data-url='/admin/auth/submit'>
            
            <div class="col-md-10 col-md-offset-1">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                  <li class="active"><a href="#basic_conf" id="basic-tab" data-toggle="tab">基本配置</a></li>
                  <li><a href="#phone_conf" id="phone-tab" data-toggle="tab">手机认证</a></li>
                  <li><a href="#wechat_conf" id="wechat-tab" data-toggle="tab">微信认证</a></li>
                  <li><a href="#onekey_conf" id="onekey-tab" data-toggle="tab">一键认证</a></li>
                  <li><a href="#free_conf" id="free-tab" data-toggle="tab">免费体验</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="basic_conf">
                        <div class="form-group require"> 
                            <label for="company" class="col-sm-3 control-label">策略名</label>
                            <div class="col-sm-6">
                                <input type="hidden" id="authStrategy.id" name="authStrategy.id" value="">
                                <input type="hidden" id="authStrategy.acct_auth_id" name="authStrategy.acct_auth_id" value="">
                                <input type="hidden" id="authStrategy.wechat_auth_id" name="authStrategy.wechat_auth_id" value="">
                                <input class="form-control" id="name" name="authStrategy.name" value='' maxlength=32>
                            </div>
                        </div>
                        <div class="form-group sr-only"> 
                            <label for="company" class="col-sm-3 control-label">认证有效时长</label>
                            <div class="col-sm-6">
                                <div class="checkbox">
                                  <label>
                                      <input id="authStrategy.reauth_time_enable" name="authStrategy.reauth_time_enable" type="checkbox" checked=""> 认证超时立即断网
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group region"> 
                            <label for="company" class="col-sm-3 control-label">认证有效时长</label>
                            <div class="col-sm-2">
                                <select id="auth_day" name="auth_day" class="form-control day" data-val='0'>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="auth_hour" name="auth_hour" class="form-control hour" data-val='18'>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="auth_minute" name="auth_minute" class="form-control minute" data-val='0'>
                                </select>
                            </div>
                            <em class="col-sm-3 form-control-static">0 为永久有效</em>
                        </div>
                        <div class="form-group region"> 
                            <label for="company" class="col-sm-3 control-label">广告推送周期</label>
                            <div class="col-sm-2">
                                <select id="ad_day" name="ad_day" class="form-control day" data-val='0'>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="ad_hour" name="ad_hour" class="form-control hour" data-val='5'>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="ad_minute" name="ad_minute" class="form-control minute" data-val='0'>
                                </select>
                            </div>
                            <em class="col-sm-3 form-control-static">0 为关闭广告推送</em>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="phone_conf">
                        <div class="form-group"> 
                            <label for="company" class="col-sm-3 control-label">手机认证开关</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" name="phone_enable" id="phone_enable" value="10" checked=""> 打开
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="phone_enable" value="0"> 关闭
                                </label>
                            </div>
                        </div>
                        <div class="collapse in" id="phone_open">
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">默认portal展示</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="authStrategy.auth_primary" id="authStrategy.auth_primary" value="10" checked=""> 优先展示短信认证
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">短信注册开关</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="authAcctWay.enable" id="enable" value="1" checked=""> 打开
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="authAcctWay.enable" value="0"> 关闭
                                    </label>
                                </div>
                            </div>
                            <div class="form-group"> 
                              <label for="contact" class="col-sm-9 control-label">
                                  <button class="btn btn-primary" type="button" 
                                          data-toggle="collapse" data-target="#collapseExample1">
                                      更多
                                  </button>
                              </label>
                            </div>
                            <div class="collapse" id="collapseExample1">
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">最大绑定终端数</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="authAcctWay.station_bind_max_num" name="authAcctWay.station_bind_max_num" value='-1' data-val="-1"  maxlength=3>
                                    </div>
                                    <em class="col-sm-4 form-control-static">-1 为不限制,0 为不绑定</em>
                                </div>
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">同时上网最大数</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="authAcctWay.station_auth_max_num" name="authAcctWay.station_auth_max_num" value='-1' data-val="-1"  maxlength=3>
                                    </div>
                                    <em class="col-sm-4 form-control-static">-1 为不限制</em>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class="tab-pane fade" id="wechat_conf">
                        <div class="form-group"> 
                            <label for="company" class="col-sm-3 control-label">微信认证开关</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" name="wechat_enable" id="wechat_enable" value="100"> 打开
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="wechat_enable" value="0" checked> 关闭
                                </label>
                            </div>
                        </div>
                        <div class="collapse" id="wechat_open">
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">默认portal展示</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="authStrategy.auth_primary" value="100"> 优先展示微信认证
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">认证方式选择</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="authWechatWay.wechat_type" id="authWechatWay.wechat_type" value="2" checked=""> 微信连WiFi
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="authWechatWay.wechat_type" value="1"> 打开微信查找关注
                                    </label>
                                </div>
                            </div>
                            <div class="collapse in" id="wechat_type_2">
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">appID</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="authWechatWay.wechat_appid" name="authWechatWay.wechat_appid" placeholder="appID(应用ID)" maxlength=32>
                                    </div>
                                </div>
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">shopId</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="authWechatWay.wechat_shopid" name="authWechatWay.wechat_shopid" placeholder="shopId(门店ID)" maxlength=32>
                                    </div>
                                </div>
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">secretKey</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="authWechatWay.wechat_secretkey" name="authWechatWay.wechat_secretkey" placeholder="secretKey(门店密钥)" maxlength=32>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="wechat_type_1">
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">公众号名称</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="authWechatWay.wechat_service_id_name" name="authWechatWay.wechat_service_id_name" placeholder="公众号名称" maxlength=32>
                                    </div>
                                </div>
                                <div class="form-group require"> 
                                    <label for="company" class="col-sm-3 control-label">公众号原始ID</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="authWechatWay.wechat_service_id" name="authWechatWay.wechat_service_id" placeholder="公众号原始ID" maxlength=32>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company" class="col-sm-3 control-label">微信开发服务器</label>
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="authWechatWay.wechat_url_type" id="authWechatWay.wechat_type" value="1" checked=""> 使用敦崇内部服务器
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="authWechatWay.wechat_url_type" value="2"> 已有微信服务器
                                        </label>
                                    </div>
                                </div>
                                <div class="collapse in" id="wechat_url_type_1">
                                    <div class="form-group"> 
                                        <label for="company" class="col-sm-3 control-label">门户网站</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="authWechatWay.wechat_service_id_portal_url" name="authWechatWay.wechat_service_id_portal_url" placeholder="例如：http://www.dunchongnet.com" maxlength=64>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label class="col-sm-3 control-label">微信服务器url</label>
                                        <p class="col-sm-6 form-control-static" id="wechat_weixin_url">添加后自动生成，需要配置到微信公众平台 </p>
                                    </div>
                                    <div class="form-group"> 
                                        <label class="col-sm-3 control-label">微信服务器token</label>
                                        <p class="col-sm-6 form-control-static" id="wechat_token">添加后自动生成，需要配置到微信公众平台 </p>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label for="company" class="col-sm-3 control-label">认证图片链接</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" id="authWechatWay.wechat_service_id_auth_url" name="authWechatWay.wechat_service_id_auth_url" placeholder="使用内部服务器时自动生成" maxlength=64>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                  </div>
                  <div class="tab-pane fade" id="onekey_conf">
                        <div class="form-group"> 
                            <label for="company" class="col-sm-3 control-label">一键上网开关</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" name="onekey_enable" id="onekey_enable" value="1"> 打开
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="onekey_enable" value="0" checked> 关闭
                                </label>
                            </div>
                        </div>
                        <div class="collapse" id="onekey_open">
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">默认portal展示</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="authStrategy.auth_primary" id="authStrategy.auth_primary" value="1"> 优先展示一键认证
                                    </label>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="tab-pane fade" id="free_conf">
                        <div class="form-group"> 
                            <label for="company" class="col-sm-3 control-label">免费体验开关</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" name="free_enable" id="free_enable" value="1000"> 打开
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="free_enable" value="0" checked=""> 关闭
                                </label>
                            </div>
                        </div>
                        <div class="collapse" id="free_open">
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">默认portal展示</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="authStrategy.auth_primary" id="authStrategy.auth_primary" value="1000"> 优先展示免费体验
                                    </label>
                                </div>
                            </div>
                            <div class="form-group require"> 
                                <label for="company" class="col-sm-3 control-label">免费体验时长</label>
                                <div class="col-sm-2">
                                    <input class="form-control" id="authStrategy.free_time" name="authStrategy.free_time" value='30' data-val="30"  maxlength=3 required="">
                                </div>
                                <em class="col-sm-4 form-control-static">5-120分钟</em>
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
            
        </div><!-- panel-body -->
    
        <div class="panel-footer row">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="reset" class="btn btn-danger">重置</button>
            </div>
        </div>
    </form>
</div>