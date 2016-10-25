<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>水乡金湖-管理后台</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=ASSETS;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=ADMIN_ASSERTS;?>css/base.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?=ASSETS;?>bootstrap/relate-js/html5shiv.min.js"></script>
      <script src="<?=ASSETS;?>bootstrap/relate-js/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

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
          <h1 class="sr-only">水乡金湖网</h1>
          <a class="navbar-brand" href="#">
            <img src="<?=ADMIN_ASSERTS;?>img/logo.png">
          </a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">分类信息</a></li>
            <li><a href="#about">地方行业</a></li>
            <li><a href="#contact">特色产品</a></li>
            <li><a href="#contact">团购生活</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">系统管理 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/admin/user">用户管理</a></li>
                <li><a href="#">地区管理</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/admin/help">帮助</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  wolin
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">您的身份是：代理商</li>
                <li class="divider"></li>
                <li class="active"><a href="/admin/admin/to_update">
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
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <?=$_content;?>

    <div class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="<?=ASSETS;?>jquery/jquery.min.js"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=ASSETS;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=ASSETS;?>bootstrap/relate-js/ie10-viewport-bug-workaround.js"></script>
    
    <script src="<?=ASSETS;?>jquery/jquery.pagination.js"></script>
    <script src="<?=ASSETS;?>select2/js/select2.min.js"></script>
    <script src="<?=ASSETS;?>select2/js/i18n/zh-CN.js"></script>
    <script src="<?=ASSETS;?>jquery/validation/jquery.validate.min.js"></script>
    <script src="<?=ASSETS;?>jquery/validation/localization/messages_zh.js"></script>
    <script src="<?=ASSETS;?>My97Date/WdatePicker.js"></script>
    
    <script src="<?=ADMIN_ASSERTS;?>js/common.js"></script>
    <script src="<?=ADMIN_ASSERTS;?>js/main.js"></script>
    <?php if(file_exists('.' . ADMIN_ASSERTS . 'js/' . $_class . '.js')):?>
    <script src="<?=ADMIN_ASSERTS . 'js/' . $_class . '.js';?>"></script>
    <?php endif;?>
  </body>
</html>
