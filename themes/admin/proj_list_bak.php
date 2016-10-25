<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- 先保留列表显示的内容后期修改 -->
<div class="panel panel-info sr-only">
    <div class="panel-heading">
      <h3 class="panel-title">列表名称</h3>
    </div>
    <div class="panel-body">
      Panel content
    </div>
    
    <div class="row list-group ">
        <?php for($i=0; $i<12;$i++):?>
        <a href="#" class="list-group-item col-sm-6 col-md-4">
            <h5 class="list-group-item-heading">
                <span class="badge"><?=$i+1;?></span>&nbsp;
                <label>
                  <input type="checkbox" value="">&nbsp;项目名称<?=$i+1;?>
                </label>
                
                <div class="btn-group btn-group-xs pull-right" role="group" aria-label="...">
                    <button type="button" class="btn btn-primary">编辑</button>
                    <button type="button" class="btn btn-danger">删除</button>
                </div>
            </h5>
            <ul class="list-inline row " style="padding-top: 6px;">
                <li class="col-xs-4 col-sm-3">项目地址</li>
                <li class="col-xs-4 col-sm-3">项目地址</li>
                <li class="col-xs-4 col-sm-3">项目地址</li>
                <li class="col-xs-4 col-sm-3">项目地址</li>
                <li class="col-xs-4 col-sm-3">项目地址</li>
                <li class="col-xs-4 col-sm-3">项目地址</li>
                <li class="col-xs-4 col-sm-3">项目地址</li>
            </ul>
        </a>
        
        <div class="panel panel-default sr-only">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
        </div>
        <?php endfor;?>
    </div>
    
    <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">列表名称</h3>
    </div>
    <div class="panel-body">
      Panel content
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Table heading</th>
            <th>Table heading</th>
            <th>Table heading</th>
            <th>Table heading</th>
            <th>Table heading</th>
            <th>Table heading</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
            <td>Table cell</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <div class="panel-footer">Panel footer</div>
</div>
