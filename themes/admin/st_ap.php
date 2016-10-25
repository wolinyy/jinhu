<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">选择项目</h3>
    </div>
    <div class="panel-body my-chart" id='chart' data-url="/admin/st_ap/">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" align="center">当前在线数<h4><span class="hisTotal"></span></h4></div>
                    </div>
                </div>
                <table class="table table-condensed">
                    <caption>基础数据</caption>
                    <thead>
                      <tr><th></th><th>日均</th><th>昨日</th></tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><span class="myChart" data-what="run_stat"><span class="glyphicon glyphicon-signal text-primary" aria-hidden="true"></span>&nbsp;&nbsp;状态统计</span></td>
                        <td><span class="avg_apStat"></span></td><td><span class="yester_apStat"></span></td>
                      </tr>
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