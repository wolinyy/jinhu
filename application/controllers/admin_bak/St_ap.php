<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表
class St_ap extends St_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->Model('stat/St_ap_model', 'statistics');
    }
    
    protected function getFlushData(&$resp){
        #获取proj_id下在线终端数
        $proj_id = $this->session->userdata('siteid');
        $proj_id = 4517;
        $resp['para']['proj_id'] = $proj_id;
//        $cache_online_ap = 'cache_online_ap_';
//        if (! $nowApStatus = $this->cache->get($cache_online_ap . $proj_id))
//        {
//            $jsonStr = $this->post_url(108, array("proj_id"=>$proj_id));
//            $nowApStatus = json_decode($jsonStr, true);
//
//            log_message('error', 'TEST WOLIN NO CACHE');
//            if(is_array($nowApStatus) && 0 == $nowApStatus['code'])
//                $this->cache->save($cache_online_ap . $proj_id, $nowApStatus, 60);
//        }
//        $resp['now_ol_nums'] = $nowApStatus['data'][0];
        $resp['now_ol_nums'] = array('online_num'=>"等待接口",'total_num'=>"等待接口");
        $resp['sum'] = $this->statistics->getAPSumByDay($resp['para']);
        $resp['yesterday'] = $this->statistics->getAPYesterdayByDay($resp['para']);
    }
    
    /*************************************************************************************
     * 热点统计
     *************************************************************************************/
    function run_stat_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getApRunStatByDay($resp['para']);
        
        exit(json_encode($resp));
    }
}
