<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表
class St_time_share extends St_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->Model('stat/St_time_share_model', 'statistics');
    }
    
    protected function getFlushData(&$resp){
        $resp['sum'] = $this->statistics->getTimeShareSumByDay($resp['para']);
        $resp['yesterday'] = $this->statistics->getTimeShareYesterdayByDay($resp['para']);
    }
    
    /*************************************************************************************
     * 分时统计
     *************************************************************************************/
    function time_share_day(){
        $resp = $this->getResp();
        $resp['chart'] = $this->statistics->getTimeShareChartByDay($resp['para']);
        
        exit(json_encode($resp));
    }
}
