<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表
class Help extends Admin_Controller {
    
    //微信连WIFI帮助提示
    public function wechatLinkWiFi() {
        $this->render('help_wechat');
    }
}