<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row form-group form-horizontal" id="selectDiv">
            <h3 class="col-sm-2 panel-title control-label">选择SSID策略</h3>
            <div class="col-sm-3">
                <select class="select-ajax form-control" id="ssid_id" name="ssid_id" data-ajax--url="/admin/ssid/get">
                    <option value="">请选择SSID</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
    <div class="panel-body my-chart" id='chart' data-url="/admin/st_user/">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <caption class="text-left hide" style="padding-bottom: 10px;"><input class="btn btn-default" type="button" id="" value="导出所有用户"></caption>
              <thead>
                <tr>
                  <th>MAC地址</th>
                  <!--<th>姓名</th>-->
                  <!--<th>手机号</th>-->
                  <th>首次登录时间</th>
                  <th>最近连接AP</th>
                  <th>最近登录时间</th>
                  <th>最近登录方式</th>
                  <th>登录次数</th>
                  <th>登录天数</th>
                  <th>终端类型</th>
                  <!--<th>总上线时长(mins)</th>-->
                  <!--<th></th>-->
                </tr>
              </thead>
              <tbody id='staList'>
              </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">
        <div class="dataTables_pagination">
            <div class="dataTables_info"></div>
            <ul id="Pagination" class="pagination"></ul>
        </div>
    </div>
</div>
