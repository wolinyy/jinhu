<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?=$title;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=ASSETS;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?=ASSETS;?>select2/css/select2.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="<?=ADMIN_ASSERTS;?>css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?=ASSETS;?>bootstrap/relate-js/html5shiv.min.js"></script>
      <script src="<?=ASSETS;?>bootstrap/relate-js/respond.min.js"></script>
    <![endif]-->
    
    <script src="<?=ASSETS;?>jquery/jquery.min.js"></script>
  </head>

  <body data-baidu_map_js='<?=BAIDU_MAP_JS;?>' data-role="<?=$role_id;?>">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            
            <a class="navbar-brand" href="/admin" title="首页">
              <img class='hidden-xs' src="<?=ASSETS;?>img/logo-lg.png">
              <img class='visible-xs-block' src="<?=ASSETS;?>img/logo-sm.png">
              <h1 class="sr-only"><?=$site_name;?></h1>
          </a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><button type="button" class="btn btn-primary btn-xs navbar-btn" id="clearCache">清除缓存</button></li>
            <li <?=('help'==$class?"class='active'":'')?>><a href="/admin/help">帮助</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?=$_username;?>
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">您的身份是：代理商</li>
                <li class="divider"></li>
                <li class="active"><a href="#">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    个人信息修改</a>
                </li>
                <li class="divider"></li>
                <!--<li class="dropdown-header">Nav header</li>-->
                <li><a href="<?=site_url('admin/admin/logout');?>">
                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 
                    退出</a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav">
            <?php foreach ($_nav as $value) : ?>
                <li <?=$value['active']?"class='active'":''?> >
                    <a href="<?=site_url($value['url']);?>"><?=$value['name'];?><span class="hidden-sm"><?=$value['hide_name'];?></span></a>
                </li>
            <?php endforeach;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div id="fast-nav" class="container collapse <?=(1==$_fastNavSw?'in':'');?>">
        <ul class="nav nav-justified">
            <?php foreach ($_fastNav as $value) : ?>
                <li <?=$value['active']?"class='active'":''?>><a href="<?=site_url($value['url']);?>"><?=$value['name'];?></a></li>
            <?php endforeach;?>
        </ul>
        <div class="col-sm-1 text-right sr-only">
            <ul class="nav nav-justified">
              <li><a href="/admin/ap_ssid"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
            </ul>
        </div>
    </div>
    
    <!-- Begin page content -->
    <div id="container" class="container">
        <p class="pull-right" id="fastNavTagP">
            <!--<button type="button" class="btn btn-primary btn-xs" id="fastNavBtn" data-original-title="核心配置 快速导航栏 的显示" data-toggle="tooltip" data-placement="top">-->
            <button type="button" class="btn btn-primary btn-xs" id="fastNavBtn" title="核心配置 快速导航栏 的显示">
                <span class="glyphicon glyphicon-eye-<?=(1==$_fastNavSw?'open':'close');?>" aria-hidden="true"> </span>
                <span class="hidden-xs">快速导航</span>
            </button>
        </p>
          
        <?php if(isset($_menu) && !empty($_menu)) : ?>
        <!-- 二级子菜单 -->
        <ul class="nav nav-tabs" id="sub_nav">
            <?php foreach ($_menu as $value) : ?>
            <li role="presentation" <?=$value['active']?"class='active'":''?> ><a href="<?=site_url($value['url']);?>"><?=$value['name'];?></a></li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
        
        <div id="alert-hint" class="alert sr-only">
            <strong>Well done!</strong> <span>You successfully read this important alert message.</span>
        </div>
        
        <?=$_content;?>
    </div>

    <div class="footer">
      <div class="container">
          <p>
              页面加载耗时 <strong>{elapsed_time}</strong> 秒. &nbsp;&nbsp; 
              内存使用 <strong>{memory_usage}</strong>.
          </p>
      </div>
    </div>

    <!--模态框-->
    <form id="myModal" class="modal fade">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">添加或编辑模态框</h4>
          </div>
          <div class="modal-body form-horizontal">
              <!--<form class="form-horizontal"></form>-->
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">提交</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </form><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="<?=ASSETS;?>jquery/jquery.min.js"></script>-->
    <script src="<?=ASSETS;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=ASSETS;?>jquery/jquery.pagination.js"></script>
    <script src="<?=ASSETS;?>select2/js/select2.min.js"></script>
    <script src="<?=ASSETS;?>select2/js/i18n/zh-CN.js"></script>
    <script src="<?=ASSETS;?>jquery/validation/jquery.validate.min.js"></script>
    <script src="<?=ASSETS;?>jquery/validation/localization/messages_zh.js"></script>
    <!--<script src="<?=ASSETS;?>My97Date/WdatePicker.js"></script>-->
    <script src="<?=ASSETS;?>artTemplate/template.js"></script>
    <script src="<?=ADMIN_ASSERTS;?>js/common.js"></script>
    <script src="<?=ADMIN_ASSERTS;?>js/main.js"></script>
    <?php if(file_exists('.' . ADMIN_ASSERTS . 'js/' . $class . '.js')):?>
    <script src="<?=ADMIN_ASSERTS . 'js/' . $class . '.js';?>"></script>
    <?php endif;?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=ASSETS;?>bootstrap/relate-js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
