<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="alert alert-success" role="alert">
    <h4><strong>账号已经注册成功!</strong></h4>
    <p>激活邮件已经发送到注册的邮箱，请登录激活。激活成功后，请点击此处&nbsp;<a href="<?=site_url('user/user_login');?>" class="alert-link">立即登录</a>.</p>
    <p>若仍未收到邮件，请尝试&nbsp;<a href="<?=site_url('user/user_resend');?>" class="alert-link">重新发送</a>.</p>
</div>
