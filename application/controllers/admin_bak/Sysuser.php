<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//商家管理
class Sysuser extends Admin_Controller {
    
    private $role_agent = 100;
    private $role_agentRelated = 31;

    public function __construct() {
        parent::__construct();
        $this->table = 'merchant';
        $this->action_add = 'sysUser_add';
        $this->action_edit = 'sysUser_update';
        $this->action_del = 'sysUser_del';
        $this->action_get = 'sysUser_list';
        $this->controller = 'sysUser';
    }

    public function beforeSubmit($data, $pk='id') {
        if(isset($data['password']) && empty($data['password'])){
            unset($data['password']);
        }
        
        if(!isset($data['role']) && isset($data['update_self'])){
            return $data;
            exit;
        }
        
        if(!in_array($this->role, array(1,11,12,13)) && $this->role_agent == $data['role']){
            echo json_encode(array(
                'code'=>-1,
                'msg'=>'您没有权限创建下级代理商'
            ));
            exit;
        }
        if(!in_array($this->role, array(1,11,12,13,14)) && $this->role_agent != $data['role']){
            echo json_encode(array(
                'code'=>-1,
                'msg'=>'您没有权限创建客户'
            ));
            exit;
        }
        
        if($this->role_agent == $data['role']){
            #下级代理商
            if(1 == $this->role){
                #管理员创建
                $data['role'] = 11;
            }else{
                $data['role'] = 1 + (int)$this->role;
            }
        }
        if($this->role_agentRelated == $data['role']){
            $data['associate_id'] = $this->user_id;
        }else{
            $data['associate_id'] = -1;
        }
        
        return $data;
    }
    
    public function getSimple() {
        $controller = $this->controller;
        $action = 'sysUser_simple';
        $data = $this->buildQueryData();
        $this->beforeGet($data);
        $jsonStr = $this->post_url($controller, $action, $data);
        echo $jsonStr;
    }
    
    public function show_form_data_handler(&$data) {
        $data['role_id'] = $this->role;
        print_r($data);
    }
    
    public function beforeGet(&$data) {
        if(isset($data['role']) && $this->role_agent == $data['role']){
            unset($data['role']);
            $data = http_build_query($data);
            $data .= '&role=11&role=12&role=13&role=14';
        }
    }
}
