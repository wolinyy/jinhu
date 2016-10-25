<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class St_ap_model extends St_Model {
    
    /*************************************************************************************
     * 热点统计
     *************************************************************************************/
    function getApRunStatByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("online_cnt, offline_cnt, date");
            $this->db->where('proj_id', $para['proj_id'])
                    ->where('date BETWEEN "' . $para['st'] . '" AND "' . $para['et'] . ' 23:59:59"')
                    ->from($this->statistics_ap_day);
            $res = $this->db->get()->result_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
    
    function getAPSumByDay($para) {
        $res = $this->CacheCheck($para, __FUNCTION__);
        if ( empty($res['online_cnt']) )
        {
            $this->load_db();
            $res = $this->db->select("sum(online_cnt) online_cnt, sum(offline_cnt) offline_cnt")
                ->where('proj_id', $para['proj_id'])
                ->where('date BETWEEN "' . $para['st'] . '" AND "' . $para['et'] . ' 23:59:59"')
                ->from($this->statistics_ap_day)
                ->get()->row_array();
            if(is_array($res) && !empty($res['online_cnt'])){
                $this->cache->save($this->cache_name, $res, $this->cache_hour);
            }
        }
        return $res;
    }
    
    function getAPYesterdayByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $res = $this->db->select("online_cnt, offline_cnt")
                ->where('proj_id', $para['proj_id'])
                ->where('date', $this->yseter_date)
                ->from($this->statistics_ap_day)
                ->get()->row_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_hour);
        }
        
        return $res;
    }
}

?>
