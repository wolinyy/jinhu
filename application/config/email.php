<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//$config['service_email'] = 'postmaster@topofree.com';
//$config['service_username'] = '依洛网络科技';
$config = array(
    "useragent" => 'CodeIgniter',
    "protocol" => 'smtp',                       //mail, sendmail, or smtp
    "mailpath" => '/usr/sbin/sendmail',         //服务器上 Sendmail 的实际路径。protocol 为 sendmail 时使用。
    "smtp_host" => 'smtp.126.com',
    "smtp_user" => 'wl1989yy@126.com',
    "smtp_pass" => 'YY1314520!',
    "smtp_port" => '25',
    "smtp_timeout" => '5',
    "wordwrap" => TRUE,
    "wrapchars" => '76',
    "mailtype" => 'html',                       //text 或 html
    "charset" => 'utf-8',
    "validate" => 'FALSE',
    "priority" => '3',
    "crlf" => '\n',
    "newline" => '\n',
    "bcc_batch_mode" => FALSE,
    "bcc_batch_size" => '200',
);
