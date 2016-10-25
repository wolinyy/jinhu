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

    <title>登录</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=ASSETS;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=ADMIN_ASSERTS;?>css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?=ASSETS;?>bootstrap/relate-js/html5shiv.min.js"></script>
      <script src="<?=ASSETS;?>bootstrap/relate-js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      
    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand"><img src="<?=ASSETS;?>img/logo-lg.png"></h3>
              <ul class="nav masthead-nav sr-only">
                <li class="active hide"><a href="#">首页</a></li>
                <li><a href="product_one" target="_blank">产品中心</a></li>
                <li><a href="/about/contact" target="_blank">联系我们</a></li>
              </ul>
            </div>
          </div>

          <div class="inner cover">
              <form class="form-signin" name="form1" method="post" action="<?=  site_url('admin/site/login');?>" role="form">
                <div class="my-from-top">
                  <h3 class="form-signin-heading">欢迎登录</h3>
                </div>
                
                <div class="my-from-middle">
                    <div class="form-group has-feedback">
                        <label class="control-label sr-only" for="username">用户名</label>
                        <input class="form-control" name="username" id="username" placeholder="请输入用户名" required="" autofocus="" type="text">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label sr-only" for="password">密码</label>
                        <input class="form-control" name="password" id="password" placeholder="请输入密码" required="" type="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="form-group has-feedback ">
                                <label class="control-label sr-only" for="verifyCode">验证码</label>
                                <input class="form-control" name="verifyCode" id="verifyCode" maxlength="4" placeholder="请输入验证码" required="" type="text">
                                 <span class="glyphicon glyphicon-sound-5-1 form-control-feedback"></span> 
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <!-- <a href="#" onclick="document.getElementById('code').src='/cgi-bin/VerifyCode.cgi?tm='+Math.random()"><img id="code" src="/cgi-bin/VerifyCode.cgi" class="img-responsive img-rounded"></a> -->
                            <img id="code" onclick="document.getElementById('code').src='<?=site_url('admin/site/verify_code?tm=');?>'+Math.random()" src="<?=site_url('admin/site/verify_code');?>" class="img-responsive img-rounded">
                        </div>
                    </div>
                </div>
                  
                <div class="my-from-bottom">
                    <span class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" checked="checked" > 下次自动登录
                        </label>
                        <a class="pull-right" href="<?=site_url('admin/site/pwd_find');?>">忘记登录密码</a>
                      </span>
                    <button class="btn btn-danger btn-block" type="submit">登&nbsp;&nbsp;录</button>
                    <p class="text-right register" >
                        <span class="pull-left text-danger"><?=isset($errMsg)?$errMsg:'';?></span>
                        <a href="<?=site_url('admin/site/register');?>">立即注册</a>
                    </p>
                </div>
              </form>
          </div>

          <div class="mastfoot">
            <div class="inner">
                <p><?=WEB_SITE;?></p>
                <p>页面加载耗时 <strong>{elapsed_time}</strong> 秒. &nbsp;内存使用 <strong>{memory_usage}</strong>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
      
      
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=ASSETS;?>jquery/jquery.min.js"></script>
    <script src="<?=ASSETS;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=ASSETS;?>bootstrap/relate-js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
