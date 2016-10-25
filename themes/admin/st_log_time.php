<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">选择SSID策略</h3>
    </div>
    <div class="panel-body my-chart" id='chart' data-url="/admin/st_log_time/">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-info" align="center">历史上线人数<h4><span class="total_ol_nums">20</span></h4></div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-info" align="center">历史登录人数<h4><span class="total_auth_nums">0</span></h4></div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-danger p8" align="center">当前在线人数<h4><span class="now_ol_nums">5</span></h4></div>
                    </div>
                  </div>
                <table class="table table-condensed">
                    <caption>基础数据</caption>
                    <thead>
                      <tr><th></th><th>累计</th><th>日均</th><th>昨日</th></tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><span class="myChart" data-what="olTimeCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;上线次数</span></td>
                        <td><span class="sum_oltimeCnt"></span></td>
                        <td><span class="avg_oltimeCnt"></span></td>
                        <td><span class="yester_olTimeCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="olManCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;上线人数</span></td>
                        <td><span class="sum_olmanCnt"></span></td>
                        <td><span class="avg_olmanCnt"></span></td>
                        <td><span class="yester_olManCnt"></span></td>
                      </tr>
                      <tr>
                          <td><span class="myChart" data-what="portalPopCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;portal弹出次数</span></td>
                          <td><span class="sum_PopCnt"></span></td>
                          <td><span class="avg_PopCnt"></span></td>
                          <td><span class="yester_PopCnt"></span></td>
                      </tr>
                      <tr>
                          <td><span class="myChart" data-what="portalPopManCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;portal弹出人数</span></td>
                          <td><span class="sum_PopManCnt"></span></td>
                          <td><span class="avg_PopManCnt"></span></td>
                          <td><span class="yester_PopManCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="timeCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;登录次数</span></td>
                        <td><span class="sum_timeCnt"></span></td>
                        <td><span class="avg_timeCnt"></span></td>
                        <td><span class="yester_timeCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="manCnt"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span>&nbsp;&nbsp;登录人数</span></td>
                        <td><span class="sum_manCnt"></span></td>
                        <td><span class="avg_manCnt"></span></td>
                        <td><span class="yester_manCnt"></span></td>
                      </tr>
                      <tr>
                        <td><span class="myChart" data-what="oldAndNew" title="新增用户 - 留存用户"><span class="glyphicon glyphicon-signal text-primary" aria-hidden="true"></span>&nbsp;&nbsp;新老用户对比</span></td>
                        <td><span class="sum_oldAndNew"></span></td>
                        <td><span class="avg_oldAndNew"></span></td>
                        <td><span class="yester_oldAndNew"></span></td>
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