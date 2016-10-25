<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?=ADMIN_ASSERTS;?>css/timeline.css" rel="stylesheet">

<div class="row row-offcanvas row-offcanvas-right">
    
    <div class="col-xs-6 col-sm-3">
        <div class="list-group">
            <a href="/admin/help" class="list-group-item active">配置向导</a>
            <a href="/admin/help/wechatLinkWiFi" class="list-group-item">微信连WiFi</a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-9">
        <div class="panel panel-info">
            <div class="panel-heading sr-only">
              <h3 class="panel-title">配置向导</h3>
            </div>
            <div class="panel-body">
                <ul class="timeline">
                    
                    <li>
                        <div class="timeline-badge warning"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">无线管理</h4>
                                <p><small class="text-muted">添加无线相关策略</small></p>
                            </div>
                            <div class="timeline-body">
                                <p>添加Portal策略，然后在该策略中定制portal页面的展示内容</p>
                                <a class="btn btn-warning btn-xs" name="ad" href="/admin/ad" role="button">立即添加</a><hr>
                            </div>
                            <div class="timeline-body">
                                <p>添加一条认证策略，用户连上无线网络后，完成了相关的认证才能上网</p>
                                <a class="btn btn-warning btn-xs" name="auth" href="/admin/auth" role="button">立即添加</a><hr>
                            </div>
                            <div class="timeline-body">
                                <p>添加一条SSID无线热点策略，并配置好上面添加的Portal策略、认证策略</p>
                                <a class="btn btn-warning btn-xs" name="ssid" href="/admin/ssid" role="button">立即添加</a><hr>
                            </div>
                            <div class="timeline-body">
                                <p>添加一条网络分组策略，里面可以包含多个ssid策略。</p>
                                <a class="btn btn-warning btn-xs" name="ssid" href="/admin/group" role="button">立即添加</a>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge danger"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">区域管理</h4>
                            </div>
                            <div class="timeline-body">
                                <p>添加用户，用于分配项目，管理或查看项目信息</p>
                                <a class="btn btn-danger btn-xs" name="ad" href="/admin/sysuser" role="button">立即添加</a><hr>
                            </div>
                            <div class="timeline-body">
                                <p>添加项目，为即将运营的设备添加运营场所的描述信息，方便后期对设备的管理与维护</p>
                                <p>项目中可以绑定用户信息、网络分组、射频策略和AP高级配置，当AP设备切换项目的时候，这些策略会一并下发</p>
                                <a class="btn btn-danger btn-xs" name="auth" href="/admin/proj" role="button">立即添加</a>
                            </div>
                            
                        </div>
                    </li>
                    <li>
                        <div class="timeline-badge success"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">设备管理</h4>
                            </div>
                            <div class="timeline-body">
                                <h5 class="label label-default">基于项目配置AP设备</h5>
                                <p>进入AP管理列表，勾选AP设备，批量划分项目。此时会将项目中绑定的用户、分组、射频等策略一并下发配置到AP上。</p>
                                <hr>
                            </div>
                            <div class="timeline-body">
                                <h5 class="label label-default">基于分组配置AP设备</h5>
                                <p>当同一个项目下的设备想使用不同的SSID策略时，可以勾选设备，进行批量切换分组的操作。</p>
                            </div>
                            <div class="timeline-body">
                                <hr>
                                <a class="btn btn-success btn-xs" name="auth" href="/admin/ap" role="button">立即配置</a>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted sr-only">
                        <div class="timeline-badge info"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">基于项目的无线策略配置</h4>
                            </div>
                            <div class="timeline-body">
                                <p>AP划分完项目后，就可以基于项目添加无线配置：<br />进入项目列表，勾选项目设备， 批量配置SSID策略</p>
                                <a class="btn btn-info btn-xs" name="ssid" href="/admin/proj" role="button">立即配置</a>
                            </div>
                        </div>
                    </li>
                    <li class="sr-only">
                        <div class="timeline-badge primary"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">AP-SSID配置关系表</h4>
                            </div>
                            <div class="timeline-body">
                                <p>进入AP-SSID配置关系表，可以查看AP上运行的SSID信息，也可以基于AP进行删除</p>
                                <a class="btn btn-primary btn-xs" name="ssid" href="/admin/ap_ssid" role="button">立即查看</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="panel-footer sr-only">Panel footer</div>
        </div>
    </div>

</div><!--/row-->