<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//AP管理
class Ap extends Admin_Controller {

    private $action_update_proj;
    private $action_wlan_add;
    
    public function __construct() {
        parent::__construct();
        
//        $this->action_add = 'wtp_add';
        $this->action_edit = 'wtp_update';
//        $this->action_del = 'wtp_del';
        $this->action_get = 'wtp_list';
        
        $this->action_update_proj = 'wtp_update_proj';
        $this->action_update_group = 'wtp_update_group';
        $this->action_update_user = 'wtp_change_owner';
        
        $this->controller = 'wtp';
        
        $this->pk = "mac";
        $this->sortkey = "";
    }
    
    public function del() {
        // 接口不存在
    }
    
    public function batch_del() {
        // 接口不存在
    }
    
    public function beforeSubmit($data, $pk) {
        // 只做编译
        if(!isset($data[$pk]) ||empty($data[$pk])){
            //非编辑不传数据处理
            return array();
        }
        return $data;
    }
    
    public function update_proj() {
        $controller = $this->controller;
        $action = $this->action_update_proj;
        
        $proj_id = $this->input->post('data[proj_id]', TRUE);
        $idArr = $this->input->post('data[id]', TRUE);
        
        if(empty($idArr) || 0 == count($idArr)){
            echo json_encode(array('code'=>-1, 'msg'=>'参数错误'));
            exit;
        }
        $idstr = 'macs=' . implode('&macs=', $idArr) . '&proj_id=' . $proj_id;
        
        $jsonStr = $this->post_url($controller, $action, $idstr);
        echo $jsonStr;
    }
    
    public function update_group() {
        $controller = $this->controller;
        $action = $this->action_update_group;
        
        $proj_id = $this->input->post('data[group_id]', TRUE);
        $idArr = $this->input->post('data[id]', TRUE);
        
        if(empty($idArr) || 0 == count($idArr)){
            echo json_encode(array('code'=>-1, 'msg'=>'参数错误'));
            exit;
        }
        $idstr = 'macs=' . implode('&macs=', $idArr) . '&group_id=' . $proj_id;
        
        $jsonStr = $this->post_url($controller, $action, $idstr);
        echo $jsonStr;
    }
    
    public function update_ssid() {
        $controller = $this->controller;
        $action = $this->action_wlan_add;
        
        $radio_type_2g = $this->input->post('data[radio_type_2g]', TRUE); // 0 - 2G和5G / 1 - 只配置2G
        $radio_type_5g = $this->input->post('data[radio_type_5g]', TRUE); // 0 - 5G关闭 / 1 - 5G打开
        $ssid_id_2gs = $this->input->post('data[ssid_id_2gs]', TRUE);
        $ssid_id_5gs = $this->input->post('data[ssid_id_5gs]', TRUE);
        $idArr = $this->input->post('data[id]', TRUE);
        
        if(0 == $radio_type_5g){
            if(0 == $radio_type_2g){
                //2G和5G一起配
                $ssid_id_5gs = $ssid_id_2gs;
            }else{
                //5G无配置
                $ssid_id_5gs = array();
            }
        }
        
        if(empty($idArr) || 0 == count($idArr)){
            echo json_encode(array('code'=>-1, 'msg'=>'参数错误'));
            exit;
        }
        
        $paramStr = 'macs=' . implode('&macs=', $idArr);
        if(!empty($ssid_id_2gs)){
            $paramStr .= '&ssid_id_2gs=' . implode('&ssid_id_2gs=', $ssid_id_2gs);
        }
        if(!empty($ssid_id_5gs)){
            $paramStr .= '&ssid_id_5gs=' . implode('&ssid_id_5gs=', $ssid_id_5gs);
        }

        $jsonStr = $this->post_url($controller, $action, $paramStr);
        echo $jsonStr;
    }
    
    public function update_user() {
        $controller = $this->controller;
        $action = $this->action_update_user;
        
        $proj_id = $this->input->post('data[owner_id]', TRUE);
        $idArr = $this->input->post('data[id]', TRUE);
        
        if(empty($idArr) || 0 == count($idArr)){
            echo json_encode(array('code'=>-1, 'msg'=>'参数错误'));
            exit;
        }
        $idstr = 'macs=' . implode('&macs=', $idArr) . '&owner_id=' . $proj_id;
        
        $jsonStr = $this->post_url($controller, $action, $idstr);
        echo $jsonStr;
    }
}
