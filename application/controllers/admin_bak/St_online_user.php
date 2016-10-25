<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表
class St_online_user extends St_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->Model('stat/St_online_user_model', 'statistics');
    }
    
    protected function getFlushData(&$resp){
        $resp['sum'] = $this->statistics->getOnlineUserSumByDay($resp['para']);
        $resp['yesterday'] = $this->statistics->getOnlineUserYesterdayByDay($resp['para']);
    }
    
    /*************************************************************************************
     * 上网用户构成
     *************************************************************************************/
    #
    function smsCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserSmsCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    function wechatCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserWechatCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    function oneKeyCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserOneKeyCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function freeCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserFreeCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function appCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserAppCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function noAuthCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserNoAuthCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    function AuthAllCnt_day(){
        $resp = $this->getResp();
         $resp['chart'] = $this->statistics->getOnlineUserSumByDay($resp['para']);
        exit(json_encode($resp));
    }
     
    function sysAppleCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserSysAppleCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function sysAndroidCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserSysAndroidCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function sysPCCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserSysPCCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function sysOtherCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getOnlineUserSysOtherCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    function AuthSysCnt_day(){
        $resp = $this->getResp();
         $resp['chart'] = $this->statistics->getOnlineUserSumByDay($resp['para']);
        exit(json_encode($resp));
    }
}
