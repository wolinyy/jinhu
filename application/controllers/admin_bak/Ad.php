<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//广告管理
class Ad extends Admin_Controller {
    private $sync_id;
    public function __construct() {
        parent::__construct();
        
        $this->action_add = 'portalConf_add';
        $this->action_edit = 'portalConf_update';
        $this->action_del = 'portalConf_del';
        $this->action_get = 'portalConf_list';
//        $this->pk = 'authStrategy.id';
        
        $this->controller = 'portalConf';
    }
    
    private function sync_data(){
        //同步时的校验 与参数
        $data['auth_url'] = DC_YUN_URL;
        $data['user_id'] = $this->user_id;
        $data['user_name'] = $this->user_name;
        $data['sign'] = md5(serialize($data));
        return $data;
    }

    private function sync_add(){
        $data = $this->sync_data();
        $json_arr = $this->curl(PORTAL_ADMIN_URL . 'site/sync_add', array('data'=>$data));
        $retArr = json_decode($json_arr, true);
//        print_r($retArr);exit;
        if(empty($retArr) || !isset($retArr['result'])){
            log_message('error', __FUNCTION__ . ' ' . $json_arr);
            $retArr = array('result'=>false, 'msg'=>'portal添加同步失败');
        }
        return $retArr;
    }
    
    private function sync_del($del_ids){
        $data = $this->sync_data();
        $json_arr = $this->curl(PORTAL_ADMIN_URL . 'site/sync_del', array('data'=>$data, 'del_ids'=>$del_ids));
        $retArr = json_decode($json_arr, true);
//        print_r($retArr);exit;
        if(empty($retArr) || !isset($retArr['result'])){
            log_message('error', __FUNCTION__ . ' ' . $json_arr);
            $retArr = array('result'=>false, 'msg'=>'portal删除同步失败');
        }
        return $retArr;
    }

    public function beforeSubmit($data, $pk) {
        
        if(1 == $data['portal_from'] && 0 == $data['portal_sync_id']){
            //内部portal 需要同步
            $retArr = $this->sync_add();
//                print_r($retArr);exit;
            if(isset($retArr['result']) && TRUE == $retArr['result']){
                $this->sync_id = $retArr['sync_id'];
                $data['portal_sync_id'] = $retArr['sync_id'];
                $data['portal_url'] = PORTAL_ADMIN_URL . 'site/index/' . $retArr['sync_id'];
            }else{
                echo json_encode($retArr);
                exit;
            }
        }

        return $data;
    }
    
    public function submit() {
        $ret = parent::submit();
        //sleep(5);
        log_message('error', $ret);
        
        $retArr = json_decode($ret, true);
        
        if(0 != $retArr['code'] && !empty($this->sync_id)){
            //失败 portal定制还原
            $del_ids = array();
            $del_ids[] = $this->sync_id;
            $this->sync_del($del_ids);
        }
    }
    
    public function del() {
//        print_r($_POST);exit;
        $ret = parent::del();
        
        $retArr = json_decode($ret, true);
        //如果返回成功 同步删除默认portal页
        if(0 == $retArr['code']){
            //同步删除portal
            $del_ids = array();
            $del_ids[] = $this->input->post('portal_sync_id', true);
            $this->sync_del($del_ids);
        }
    }
    
    public function batch_del() {
        $ret = parent::batch_del();
        
        $retArr = json_decode($ret, true);
        //如果返回成功 同步删除默认portal页
        if(0 == $retArr['code']){
            //同步删除portal
            $del_ids = $this->input->post('portal_sync_id', true);
            $this->sync_del($del_ids);
        }
    }
    
    public function setPortal(){
        $id = $this->input->get_post('id', true);
        if(empty($id)){
            redirect('/');
        }
        
        $data['username'] = $this->user_name;
        $data['user_id'] = $this->user_id;
        $data['role_id'] = $this->role;
        $data['ssid_id'] = $id;
        $data['status'] = 1;
        $data['redirecturl'] = '/';
        $data['token'] = $this->session->userdata('token');
        
        $str='';
        foreach ($data as $key => $value) {
            $str .= $key . '=' . $value . '&';
        }
        redirect(PORTAL_ADMIN_URL . 'user/synlogin?' . rtrim($str, '&'));
    }
}

