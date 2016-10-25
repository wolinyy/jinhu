<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//用户管理
class User extends Admin_Controller {

    //后台首页展示
    public function index()
    {
        $this->render(strtolower($this->class));
    }
    
    function get() {
        $data = $this->buildQueryData();
        $this->beforeGet($data);
        
        $this->load->model('Base');
        $this->Base->setTable('user');
        $this->Base->set_cache_save(false);
        $res = $this->Base->selectPage($data);
        
        if($res){
            $res['code'] = 0;
        }else{
            $res['code'] = -1;
        }
        echo json_encode($res);
    }
}
