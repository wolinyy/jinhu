<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="Description" content="金湖生活网，是淮安金湖本地的分类信息生活网站！为你提供金湖本地的房屋租售、求职招聘、二手物品、车辆买卖、生活黄页等海量生活信息，充分满足您免费查看/发布信息的需求。金湖生活网-为生活服务 jinhu.live！">
    <meta name="Keywords" content="金湖,金湖生活,分类信息,金湖生活网" />
    <link rel="icon" href="/favicon.ico">

    <title><?=$title;?>-金湖本地的生活信息网|免费发布信息<?=isset($typeInfo['name'])?' - ' . $typeInfo['name']:'';?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=ASSETS;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="<?=HOME_ASSERTS;?>css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?=ASSETS;?>bootstrap/relate-js/html5shiv.min.js"></script>
      <script src="<?=ASSETS;?>bootstrap/relate-js/respond.min.js"></script>
    <![endif]-->
   
    <script>
	var _hmt = _hmt || [];
	(function() {
  	    var hm = document.createElement("script");
  	    hm.src = "//hm.baidu.com/hm.js?822637ffe776b5459a3cd78fdcf71bab";
  	    var s = document.getElementsByTagName("script")[0]; 
  	    s.parentNode.insertBefore(hm, s);
	})();
    </script>

 
    <script src="<?=ASSETS;?>jquery/jquery.min.js"></script>
    <script src="<?=ASSETS;?>bootstrap/dist/js/bootstrap.min.js"></script>
  </head>

  <body data-baidu_map_js='<?=BAIDU_MAP_JS;?>' data-role="<?=!isset($role_id)?0:$role_id;?>">

      <div>
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
            
            <a class="navbar-brand" href="/" title="首页">
              <img class='hidden-xs' src="<?=ASSETS;?>img/logo-lg.png">
              <img class='visible-xs-block' src="<?=ASSETS;?>img/logo-sm.png">
              <h1 class="sr-only"><?=$site_name;?></h1>
          </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class='<?=($class=='info')?'active':'';?>' >
                    <a href="<?=site_url('info');?>"><span class="hidden-sm">分类</span>信息</a>
                </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_username)):?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?=$_username;?>
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <!--<li class="dropdown-header">欢迎登录</li>-->
                <li class="divider"></li>
                <li><a href="<?=site_url('/user/user_reset_pwd');?>">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    密码修改</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?=site_url('/info/mng');?>">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    分类信息管理</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?=site_url('user/logout');?>">
                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 
                    退出</a>
                </li>
              </ul>
            </li>
            <?php else:?>
            <li><a href="<?=site_url('user/user_reg');?>">注册</a></li>
            <li><a href="<?=site_url('user/user_login');?>">登录</a></li>
            <?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    </div>
      
    <!-- Begin page content -->
    <div id="container" class="container">
        <div id="alert-hint" class="alert sr-only">
            <strong></strong> <span></span>
        </div>
        
        <?=$_content;?>
    </div>

    <div class="footer">
      <div class="container">
          <p>
              &copy;<?=WEB_SITE;?> &nbsp;&nbsp;淮安金湖县免费的分类信息发布查询平台
              <?=WEB_BEIAN;?>
          </p>
      </div>
    </div>

    <script src="<?=ASSETS;?>bootstrap/relate-js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
