<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表 - 登录数统计
class St_log_time extends St_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->Model('stat/St_log_time_model', 'statistics');
    }
    
    protected function getFlushData(&$resp){
        $resp['sum'] = $this->statistics->getLogTimeSumByDay($resp['para']);
        $resp['yesterday'] = $this->statistics->getLogTimeYesterdayByDay($resp['para']);
        $resp['hisTotal'] = $this->statistics->history_total_sta($resp['para']);

        #获取ssid下在线终端数
//        $cache_online_sta = 'cache_online_sta_';
//        if (! $onlineStaNums = $this->cache->get($cache_online_sta . $resp['para']['curr_ssid_id']))
//        {
//            $jsonStr = $this->post_url(107, array("ssid_id"=>$resp['para']['curr_ssid_id']));
//            $onlineStaNums = json_decode($jsonStr, true);
//            log_message('error', 'TEST WOLIN NO CACHE');
//            if(is_array($onlineStaNums) && 0 == $onlineStaNums['code'])
//                $this->cache->save($cache_online_sta . $resp['para']['curr_ssid_id'], $onlineStaNums, 30);
//        }
//        $resp['hisTotal']['now_ol_nums'] = $onlineStaNums['data'];
        $resp['hisTotal']['now_ol_nums'] = "等待接口";
    }

    //上线次数
    public function olTimeCnt_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimeOlTimeCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //上线人数 - 半小时
    public function olManCnt_half_hour() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimeOlManCntByHalfHour($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //上线人数
    public function olManCnt_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimeOlManCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //portal弹出次数
    public function portalPopCnt_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimePortalPopCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //portal弹出人数
    public function portalPopManCnt_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimePortalPopManCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //登录次数
    public function timeCnt_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimeTimeCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //登录人数
    public function manCnt_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimeManCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    //新老用户对比
    public function oldAndNew_day() {
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getLogTimeOldAndNewByDay($resp['para']);
        
        exit(json_encode($resp));
    }
}
