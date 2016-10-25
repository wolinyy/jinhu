<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends Test_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
    }
    
    public function index()
    {
        $this->load->library('email');

        $this->email->from('wl1989yy@126.com', WEB_SITE);
        $this->email->to('545876197@qq.com'); 

        $this->email->subject(WEB_SITE . '账号激活');
        $this->email->message(
                '您已经注册成为了' .WEB_SITE . '的用户，验证激活后即可立即使用.'
                .'<strong><a href="' . site_url('user/email_active/11') . '?code=12321321321">立即激活</a></strong>'
                .'<p>如果您没有注册，请忽略这封邮件</p>'
        ); 

        if ( ! $this->email->send())
        {
            echo '发送失败';
        }

        echo $this->email->print_debugger();
    }
}
