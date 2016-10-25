<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">选择SSID策略</h3>
    </div>
    <div class="panel-body my-chart" id='chart' data-url="/admin/st_online_user/">
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-condensed">
                    <caption>认证方式</caption>
                    <thead><tr><th></th><th>累计</th><th>比例</th><th>昨日</th></tr></thead>
                    <tbody>
                      <tr>
                        <td><span class="myChart" data-what="smsCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;短信</span></td>
                        <td><span class="sum_smsCnt"></span></td><td><span class="ratio_smsCnt"></span></td><td><span class="yester_smsCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="wechatCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;微信</span></td>
                        <td><span class="sum_wechatCnt"></span></td><td><span class="ratio_wechatCnt"></span></td><td><span class="yester_wechatCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="oneKeyCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;一键登录</span></td>
                        <td><span class="sum_oneKeyCnt"></span></td><td><span class="ratio_oneKeyCnt"></span></td><td><span class="yester_oneKeyCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="freeCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;免费体验</span></td>
                        <td><span class="sum_freeCnt"></span></td><td><span class="ratio_freeCnt"></span></td><td><span class="yester_freeCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="appCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;APP</span></td>
                        <td><span class="sum_appCnt"></span></td><td><span class="ratio_appCnt"></span></td><td><span class="yester_appCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="noAuthCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;免认证</span></td>
                        <td><span class="sum_noAuthCnt"></span></td><td><span class="ratio_noAuthCnt"></span></td><td><span class="yester_noAuthCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="AuthAllCnt"><span class="glyphicon glyphicon-signal text-primary" aria-hidden="true"></span>&nbsp;&nbsp;全部</span></td>
                        <td><span class="sum_AuthAllCnt"></span></td><td><span class="ratio_AuthAllCnt"></span></td><td><span class="yester_AuthAllCnt"></span></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-condensed">
                    <caption>设备系统构成</caption>
                    <thead><tr><th></th><th>累计</th><th>比例</th><th>昨日</th></tr></thead>
                    <tbody>
                      <tr>
                        <td><span class="myChart" data-what="sysAppleCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;IOS系统</span></td>
                        <td><span class="sum_sysAppleCnt"></span></td><td><span class="ratio_sysAppleCnt"></span></td><td><span class="yester_sysAppleCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="sysAndroidCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;安卓系统</span></td>
                        <td><span class="sum_sysAndroidCnt"></span></td><td><span class="ratio_sysAndroidCnt"></span></td><td><span class="yester_sysAndroidCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="sysOtherCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;其它手机</span></td>
                        <td><span class="sum_sysOtherCnt"></span></td><td><span class="ratio_sysOtherCnt"></span></td><td><span class="yester_sysOtherCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="sysPCCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;PC</span></td>
                        <td><span class="sum_sysPCCnt"></span></td><td><span class="ratio_sysPCCnt"></span></td><td><span class="yester_sysPCCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="AuthSysCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;全部</span></td>
                        <td><span class="sum_AuthAllCnt"></span></td><td><span class="ratio_AuthAllCnt"></span></td><td><span class="yester_AuthAllCnt"></span></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            
            <div class="col-sm-8">
                <div class="form-inline text-right myDate clearfix">
                    <input id="st" class="Wdate" value="<?=date('Y-m-d', strtotime("-1 month"));?>" onfocus="WdatePicker({readOnly:true,isShowWeek:true,maxDate:'#F{$dp.$D(\'et\')}',minDate:'%y-{%M-6}-01'})" type="text">
                    <span>~</span>
                    <input id="et" class="Wdate" value="<?=date('Y-m-d', strtotime("-1 day"));?>" onfocus="WdatePicker({maxDate:'%y-%M-{%d-1}',minDate:'#F{$dp.$D(\'st\')}'})" type="text">
                    <button type="submit" class="btn btn-sm btn-primary sure">确定</button>
                    &nbsp;
                    <ul class="nav nav-tabs pull-right hide" id="type">
                        <li><a data-toggle="tab" href="#half_hour">按半小时</a></li>
                        <li class="active"><a data-toggle="tab" href="#day">按日</a></li>
                        <li class="hide"><a data-toggle="tab" href="#week">按周</a></li>
                        <li class="hide"><a data-toggle="tab" href="#month">按月</a></li>
                    </ul>
                </div>
                <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
                <div id="graphic" style="height:400px;"></div>
            </div>
            
        </div>
    </div>
    <div class="panel-footer sr-only">Panel footer</div>
</div>

<!--<script src="<?=ASSETS;?>echarts/echarts-all.js"></script>-->
<script src="<?=ASSETS;?>echarts3/echarts.common.min.js"></script>
<script src="<?=ADMIN_ASSERTS;?>js/stat.js"></script>