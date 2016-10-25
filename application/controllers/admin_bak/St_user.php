<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//统计图表
class St_user extends St_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->Model('stat/St_user_model', 'statistics');
    }
    
    /*************************************************************************************
     * 个人用户
     *************************************************************************************/
    function individual_user($offset = '') {
        $resp = $this->getResp();
        
        $per_page = $this->input->post('per_page', true);
        if(empty($per_page)) $per_page = 10;
        
        #载入分页类
        $this->load->library('pagination');
        #配置分页信息
        $config['base_url'] = site_url('index_statistics/individual_user/');
        $total_rows = $this->statistics->getIndividualUserStaCount($resp['para']);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        #初始化分页类
        $this->pagination->initialize($config);
        #生成分页信息
        $this->pagination->create_links();
        $limit = $this->pagination->per_page;
        $resp['sta_list'] = $this->statistics->getIndividualUserStaList($limit, $offset, $resp['para']);
        
        #$resp['pagination'] = $this->pagination;
        $resp['pagination']['total_rows'] = $total_rows;
        $resp['pagination']['per_page'] = $this->pagination->per_page;
        $resp['pagination']['cur_page'] = $this->pagination->cur_page;
        exit(json_encode($resp));
    }
    
    /*************************************************************************************
     * 个人用户详情
     *************************************************************************************/
     function individual_user_detail() {
         $resp = $this->getResp();
         $resp['sta_info'] = $this->statistics->getIndividualUserStaInfo($resp['para']);
         exit(json_encode($resp));
     }
}
