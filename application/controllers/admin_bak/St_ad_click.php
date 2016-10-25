<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表
class St_ad_click extends St_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->Model('stat/St_ad_click_model', 'statistics');
    }
    
    protected function getFlushData(&$resp){
        $resp['sum'] = $this->statistics->getAdClickSumByDay($resp['para']);
        $resp['yesterday'] = $this->statistics->getAdClickYesterdayByDay($resp['para']);
        $resp['timeTop'] = $this->statistics->getAdClickTimeTop($resp['para']);
        $resp['hisTop'] = $this->statistics->getAdClickHisTop($resp['para']);
    }
    
    /*************************************************************************************
     * 广告点击
     *************************************************************************************/
    function adCPM_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getAdClickAdCPMByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    function adClickCnt_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getAdClickAdClickCntByDay($resp['para']);
        
        exit(json_encode($resp));
    }
    
    function adClickRatio_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getAdClickAdClickRatioByDay($resp['para']);
        
        exit(json_encode($resp));
    }
}
