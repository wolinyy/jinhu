<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//站点相关控制器 不用登录就可以访问
class Site extends BASE_Controller {

    public function __construct() {
        parent::__construct();
        
        //切换主题
        $this->load->switch_themes_admin();
    }
    
    //用户登录
    public function login(){
        //登录提交
        if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_SERVER['HTTP_REFERER'])
                && site_url('admin/site/login') == $_SERVER['HTTP_REFERER']){
            $success = false;
            $name = $this->input->post('username', true);
            $pwd = $this->input->post('password', true);
            $code = $this->input->post('verifyCode', true);
            $remember = $this->input->post('remember', true);
            $sess_code = $this->session->userdata(self::SESSION_ADMIN_CODE);
            
            if(strtolower($sess_code) != strtolower($code)){
                $this->session->set_flashdata(self::FLASH_ERR_MSG, '验证码错误');
            }else {
                $success = $this->do_admin_login(array('username'=>$name, 'password'=>$pwd));
            }
            #登录成功,其他相关处理
            if($success === TRUE){
                #下次自动登录
                if('on' == $remember){
                    //记住用户名密码,自己提交
                    $this->load->library('encrypt');
                    $this->input->set_cookie(self::COOKIE_ADMIN_NAME, $this->encrypt->encode($name), 24*60*60);
                    $this->input->set_cookie(self::COOKIE_ADMIN_PWD, $this->encrypt->encode($pwd), 24*60*60);
                }
                redirect('admin/info');
            }else{
                redirect('admin/site/login');
            }
        }
        
        //非登录提交 显示页面
        $data['errMsg'] = $this->session->userdata(self::FLASH_ERR_MSG);
        $this->load->view('login', $data);
    }
    
    //用户注册
    public function register() {
        echo __FUNCTION__;
    }
    
    //找回密码
    public function pwd_find() {
        echo __FUNCTION__;
    }
    
    //验证码
    public function verify_code() {
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => '104',
            'img_height' => 34,
            'expiration' => 7200,
            'font_size' => 16,
            'font_path' => ASSERTS_DIR . 'font/VerifyCode.ttf',
            'colors'	=> array(
                'background'	=> array(185,230,236),
                'border'	=> array(222,244,254),
                'text'		=> array(51,122,183),
                'grid'		=> array(178,162,82)
            )
        );
        $cap = create_captcha($vals);
        #保存到session
        $this->session->set_userdata(self::SESSION_ADMIN_CODE, $cap);
    }
}
