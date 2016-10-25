<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Ssid管理
class Ssid extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->action_add = 'wlan_add';
        $this->action_edit = 'wlan_update';
        $this->action_del = 'wlan_del';
        $this->action_get = 'wlan_list';
//        $this->pk = 'authStrategy.id';
        
        $this->controller = 'wlanconf';
    }
    
    public function beforeSubmit($data, $pk) {
        
        if(!isset($data[$pk]) || empty($data[$pk])){
            //添加
            $data['suppress'] = 0;  //ssid不隐藏
        }else{
            //编辑
        }
        
        return $data;
    }
    
    public function beforeGet(&$data) {
        if(isset($data['name'])){
            $data['key_name'] = $data['name'];
            unset($data['name']);
        }
    }
    
    public function newWlanSimple() {
        $controller = $this->controller;
        $action = 'new_wlan_simple';
        $data = $this->buildQueryData();
        $this->beforeGet($data);
        $jsonStr = $this->post_url($controller, $action, $data);
        echo $jsonStr;
    }
}
