<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class St_time_share_model extends St_Model {
    
    
    /*************************************************************************************
     * 分时统计
     *************************************************************************************/
    function getTimeShareChartByDay($para){
        $res = $this->CacheCheck($para, __FUNCTION__);
        if (! $res)
        {
            $this->db->select("hour, sum(all_number-new_number) keep_number, sum(new_number) new_number");
            $this->db->where($this->ssid_id, $para['curr_ssid_id']);
            $this->db->where('date BETWEEN "' . $para['st'] . '" AND "' . $para['et'] . ' 23:59:59"');
            $this->db->group_by("hour");
            $this->db->order_by("hour", "asc");
            $res['one'] = $this->db->from($this->statistics_time_sharing)->get()->result_array();
            
            $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    function getTimeShareSumByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("hour, sum(all_number) total")
                ->where($this->ssid_id, $para['curr_ssid_id'])
                ->group_by("hour")
                ->order_by("hour", "asc")
                ->limit(24, 0);
            $res = $this->db->from($this->statistics_time_sharing)->get()->result_array();
            
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
    
    function getTimeShareYesterdayByDay($para){
        #$this->yseter_date = '2015-12-02';
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("hour, all_number total")
                ->where($this->ssid_id, $para['curr_ssid_id'])
                ->where('date BETWEEN "' . $this->yseter_date . '" AND "' . $this->yseter_date . ' 23:59:59"')
                ->order_by("hour", "asc")
                ->limit(24, 0);
            $res = $this->db->from($this->statistics_time_sharing)->get()->result_array();
            
            if(is_array($res) && !empty($res)){
                $this->cache->save($this->cache_name, $res, $this->cache_hour);
            }
        }
        
        return $res;
    }
}

?>
