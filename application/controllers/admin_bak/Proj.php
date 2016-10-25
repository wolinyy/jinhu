<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//项目管理
class Proj extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->action_add = 'proj_add';
        $this->action_edit = 'proj_update';
        $this->action_del = 'proj_del';
        $this->action_get = 'proj_list';
        
        $this->action_update_user = 'proj_change_mer';
        
        $this->controller = 'project';
    }
    
    function getIndustry() {
        $this->load->model('Base');
        $this->Base->setTable('industry');
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "name, name id";
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    public function getProvince() {
        $this->load->model('Base');
        $this->Base->setTable('region');
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "region_name name, region_id id";
        $mix['where'] = array('region_type' => 1);
        
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    public function getCity($Province_id) {
        $this->load->model('Base');
        $this->Base->setTable('region');
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "region_name text, region_id id";
        $mix['where'] = array('region_type' => 2, 'parent_id'=>$Province_id);
        
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    public function getArea($City_id) {
        $this->load->model('Base');
        $this->Base->setTable('region');
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "region_name text, region_id id";
        $mix['where'] = array('region_type' => 3, 'parent_id'=>$City_id);
        
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    public function beforeSubmit($data, $pk) {
        $user_id = $this->session->userdata('user_id');
        if(!isset($data[$pk]) || empty($data[$pk])){
            if(!isset($data['account_id']) || empty($data['account_id']))
                $data['account_id'] = $user_id;
            if(!isset($data['creator_id']) || empty($data['creator_id']))
                $data['creator_id'] = $user_id;
        }else{
            if(isset($data['account_id']) && empty($data['account_id']))
                unset($data['account_id']);
            if(isset($data['creator_id']) && empty($data['creator_id']))
                unset($data['creator_id']);
        }
        return $data;
    }
    
    public function customSort(&$data) {
        $data['sort'] = 2;
        $data['sortkey'] = 'id';
    }
    
    public function show_form_data_handler(&$data) {
        //location转化为省市区 经纬度 缩放
        if(isset($data['form']['location']) && !empty($data['form']['location'])){
            $tmpArr = explode('#', $data['form']['location']);
            $tmpArr1 = explode(':', $tmpArr[0]);
            $tmpArr2 = explode(':', $tmpArr[1]);
            $data['form']['province'] = $tmpArr1[0];
            $data['form']['city'] = $tmpArr1[1];
            $data['form']['area'] = $tmpArr1[2];
            $data['form']['lng'] = $tmpArr2[0];
            $data['form']['lat'] = $tmpArr2[1];
            $data['form']['zoom'] = $tmpArr2[2];
        }
//        print_r($data);
    }
    
    public function update_user() {
        $controller = $this->controller;
        $action = $this->action_update_user;
        
        $account_id = $this->input->post('data[owner_id]', TRUE);
        $idArr = $this->input->post('data[id]', TRUE);
        
        if(empty($idArr) || 0 == count($idArr)){
            echo json_encode(array('code'=>-1, 'msg'=>'参数错误'));
            exit;
        }
        $idstr = 'ids=' . implode('&ids=', $idArr) . '&owner_id=' . $account_id;
        
        $jsonStr = $this->post_url($controller, $action, $idstr);
        echo $jsonStr;
    }
}
