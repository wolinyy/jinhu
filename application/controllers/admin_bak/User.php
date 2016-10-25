<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//用户控制器
class User extends Admin_Controller {

    //用户
    public function index()
    {
        #$this->load->view('index');
        $this->render('index');
    }

    //用户信息修改
    public function update(){
        
    }
}
