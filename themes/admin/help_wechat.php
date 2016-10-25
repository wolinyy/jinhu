<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=ADMIN_ASSERTS;?>css/timeline.css" rel="stylesheet">
<!--<link rel="stylesheet" href="<?=ADMIN_ASSERTS;?>css/weixinLinkWiFi.css?ver=1">-->

<div class="row row-offcanvas row-offcanvas-right">
    
    <div class="col-xs-6 col-sm-3">
        <div class="list-group">
            <a href="/admin/help" class="list-group-item">配置向导</a>
            <a href="/admin/help/wechatLinkWiFi" class="list-group-item active">微信连WiFi</a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-info">
            <div class="panel-heading sr-only">
              <h3 class="panel-title">配置向导</h3>
            </div>
            <div class="panel-body">
                
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1、登陆微信开发平台
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <p class="text-center"><a href="http://mp.weixin.qq.com" target="_blank">1、点击 登陆微信开发平台</a></p>
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/1_login.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2、选择"添加功能插件"，开通微信连WiFi插件
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/2_addPlug.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3、选择"门店管理"，新建门店
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/3_shopList.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading4">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                              4、添加门店
                              <small class="text-muted">&nbsp;定位的门店可以立即生效；标注新门店需要几天的审核时间</small>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/4_shopAdd.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading5">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            5、选择"微信连WiFi"，设备管理 -> 添加设备
                          </a>
                        </h4>
                      </div>
                      <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/5_deviceShow.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading6">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            6、选择 portal型设备 -> 设备改造后接入
                            <small class="text-muted">&nbsp;保持ssid与代理商配置的一致</small>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/6_deviceAdd.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading7">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            7、选择"微信连WiFi"，设备管理 -> 查看详情
                            <small class="text-muted">&nbsp;点击"查看开发凭证"，参数填写到代理商平台</small>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/7_lookInfo_1.jpg" />
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/7_lookInfo_2.jpg" />
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/7_lookInfo_3.jpg" />
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="heading8">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            8、商家主页配置
                            <small class="text-muted">&nbsp;选择"微信连WiFi"，商家主页管理</small>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                        <div class="panel-body">
                          <img src="<?=ADMIN_ASSERTS;?>img/weixin/8_homePage.jpg" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="panel-footer sr-only">Panel footer</div>
        </div>
    </div>

</div><!--/row-->