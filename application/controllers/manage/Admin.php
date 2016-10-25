<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//后台管理控制器
class Admin extends Admin_Controller {

    //后台首页展示
    public function index()
    {
        $this->load->view('index');
//        $this->render('index');
    }
    
    //用户退出
    public function logout(){
        $this->session->sess_destroy();
        $this->input->set_cookie(self::COOKIE_ADMIN_NAME, NULL);
        $this->input->set_cookie(self::COOKIE_ADMIN_PWD, NULL);
        
        //接口同步
        $this->post_url('logout');
        
        redirect('/');
    }
    
    //站点管理相关等
}
