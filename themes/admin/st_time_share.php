<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">选择SSID策略</h3>
    </div>
    <div class="panel-body my-chart" id='chart' data-url="/admin/st_time_share/">
        <div class="row">
            <div class="col-sm-4">
                <span class="myChart sr-only" data-what="time_share"><span class="glyphicon glyphicon-signal text-primary" aria-hidden="true"></span>&nbsp;&nbsp;分时统计</span>
                <table class="table table-condensed">
                    <thead><tr><th>时段</th><th>累计人数</th><th>昨日人数</th></tr></thead>
                    <tbody id="tb_time_share"></tbody>
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