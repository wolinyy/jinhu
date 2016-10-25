<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Auth管理
class Auth extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->action_add = 'auth_add';
        $this->action_edit = 'auth_update';
        $this->action_del = 'auth_del';
        $this->action_get = 'auth_list';
        $this->pk = 'authStrategy.id';
        $this->sortkey = 'a.id';
        
        $this->controller = 'authConfig';
    }

    public function beforeSubmit($data, $pk='authStrategy.id') {
        //数据key值转换
        $retData = array();
        foreach ($data as $key => $value) {
            $retData[str_replace('|', '.', $key)] = $value;
        }
        
        $ret['code'] = 0;
        //参数校验
        if(!isset($retData['authStrategy.name']) || empty($retData['authStrategy.name'])){
            $ret = array(
                'code' => -1,
                'msg' => '策略名不能为空'
            );
            
        }
        if(!is_numeric($retData['authAcctWay.station_bind_max_num']) || $retData['authAcctWay.station_bind_max_num'] < -1){
            $retData['authAcctWay.station_bind_max_num'] = -1;
        }
        if(!is_numeric($retData['authAcctWay.station_auth_max_num']) || $retData['authAcctWay.station_auth_max_num'] < -1){
            $retData['authAcctWay.station_auth_max_num'] = -1;
        }
        if(!empty ($retData['wechat_enable']) && 2 == $retData['authWechatWay.wechat_type']){
            if(empty($retData['authWechatWay.wechat_appid']) || empty($retData['authWechatWay.wechat_shopid'])
                    ||empty($retData['authWechatWay.wechat_secretkey'])){
                $ret = array(
                    'code' => -1,
                    'msg' => '微信配置缺少参数'
                );
            }
        }else if(!empty ($retData['wechat_enable']) && 1 == $retData['authWechatWay.wechat_type']){
            if(empty($retData['authWechatWay.wechat_service_id_name']) || empty($retData['authWechatWay.wechat_service_id'])){
                $ret = array(
                    'code' => -1,
                    'msg' => '微信配置缺少参数'
                );
            }
        }
        if(!empty ($retData['free_enable'])){
            if(!is_numeric($retData['authStrategy.free_time']) 
                    || 5>$retData['authStrategy.free_time'] || 120 < $retData['authStrategy.free_time']){
                $retData['authStrategy.free_time'] = 30;
            }
        }
        if('0' == $retData['phone_enable'] && '0' == $retData['wechat_enable']
                && '0' == $retData['onekey_enable'] && '0' == $retData['free_enable']){
            $ret = array(
                'code' => -1,
                'msg' => '至少开启一种认证策略'
            );
        }
        if(0 != $ret['code']){
            echo json_encode($ret);
            exit;
        }
        
        //数据转化处理
        $retData['authWechatWay.name'] = $retData['authStrategy.name'];
        $retData['authAcctWay.name'] = $retData['authStrategy.name'];
        $retData['authStrategy.auth_switchs'] = 
                bindec($retData['phone_enable'] + $retData['wechat_enable'] + $retData['free_enable'] + $retData['onekey_enable']);
        $retData['authStrategy.reauth_time'] = $retData['auth_day'] * 24 * 60 + $retData['auth_hour'] * 60 + $retData['auth_minute'];
        $retData['authStrategy.repush_time'] = $retData['ad_day'] * 24 * 60 + $retData['ad_hour'] * 60 + $retData['ad_minute'];
        $retData['authAcctWay.sms_content'] = '您的验证码是：$password。请不要把验证码泄露给其他人。';
        
        if(!isset($retData[$pk]) || empty($retData[$pk])){
            //添加
            if(!isset($retData['authStrategy.account_id']) || empty($retData['authStrategy.account_id'])){
                $retData['authStrategy.account_id'] = $this->user_id;
                $retData['authAcctWay.account_id'] = $this->user_id;
                $retData['authWechatWay.account_id'] = $this->user_id;
            }
        }else{
            //编辑
            if(!isset($retData['authStrategy.account_id']) || empty($retData['authStrategy.account_id'])){
                unset($retData['authStrategy.account_id']);
                unset($retData['authAcctWay.account_id']);
                unset($retData['authWechatWay.account_id']);
            }
        }
//        $retData['authStrategy.id'] = 20;
//        $retData['authStrategy.acct_auth_id'] = 24;
//        $retData['authStrategy.wechat_auth_id'] = 271;
//        $retData['authWechatWay.wechat_dc_id'] = 228;
        return $retData;
    }
    
    public function test() {
        $data1 = "10";
        $data2 = "100";
        
        echo $data1 + $data2 . ' - ' . bindec($data1 + $data2);
    }
}
