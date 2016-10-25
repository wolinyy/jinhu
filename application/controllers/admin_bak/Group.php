<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//分组管理
class Group extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->action_add = 'group_add';
        $this->action_edit = 'group_update';
        $this->action_del = 'group_del';
        $this->action_get = 'group_list';
        
        $this->action_wlan_add = 'group_wlan_add';
        $this->action_wlan_del = 'group_wlan_del';
        
        $this->controller = 'group';
    }
    
    public function beforeSubmit($data, $pk) {
        
        $radio_type_2g = $this->input->post('data[radio_type_2g]', TRUE); // 0 - 2G和5G / 1 - 只配置2G
        $radio_type_5g = $this->input->post('data[radio_type_5g]', TRUE); // 0 - 5G关闭 / 1 - 5G打开
        $ssid_id_2gs = $this->input->post('data[ssid_id_2gs]', TRUE);
        $ssid_id_5gs = $this->input->post('data[ssid_id_5gs]', TRUE);

        unset($data['radio_type_2g']);
        unset($data['radio_type_5g']);
        unset($data['ssid_id_2gs']);
        unset($data['ssid_id_5gs']);
//        if($this->action == $this->action_add) unset ($data[$this->pk]);
        
        //2G和5G一起配
        if(0 == $radio_type_2g){
            $ssid_id_5gs = $ssid_id_2gs;
        }else{
            //5G无配置
            if(0 == $radio_type_5g){
                $ssid_id_5gs = array();
            }
        }

        $paramStr = http_build_query($data);
        if(!empty($ssid_id_2gs)){
            $paramStr .= '&ssid_id_2gs=' . implode('&ssid_id_2gs=', $ssid_id_2gs);
        }
        if(!empty($ssid_id_5gs)){
            $paramStr .= '&ssid_id_5gs=' . implode('&ssid_id_5gs=', $ssid_id_5gs);
        }
        
        //把传输的参数组装成字符串
        return $paramStr;
    }
    
    public function getSimple() {
        $controller = $this->controller;
        $action = 'group_simple';
        $data = $this->buildQueryData();
        $this->beforeGet($data);
        $jsonStr = $this->post_url($controller, $action, $data);
        echo $jsonStr;
    }
}
