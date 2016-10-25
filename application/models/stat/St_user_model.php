<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class St_user_model extends St_Model {
    
    
    /*************************************************************************************
     * 个人用户
     *************************************************************************************/
    function getIndividualUserStaCount($para, $where=array()){
        if (! $cnt = $this->CacheCheck($para, __FUNCTION__))
        {
            if(!empty($where))
                $this->db->where($where);
            $this->db->where($this->siteid, $para['curr_ssid_id']);
            $cnt = $this->db->get($this->statistics_action_sta)->num_rows();
            $this->cache->save($this->cache_name, $cnt, $this->cache_min);
        }
        return $cnt;
    }
    function getIndividualUserStaList($limit,$offset,$para, $where=array()) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__ . '-' . $limit . '-'.$offset))
        {
            if(!empty($where))
                $this->db->where($where);
            $this->db->where($this->siteid, $para['curr_ssid_id']);
            $res = $this->db->limit($limit,$offset)->get($this->statistics_action_sta)->result_array();
            $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    function getIndividualUserStaInfo($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__ . '-' . str_replace(':', '', $para['mac'])))
        {
            $res = $this->db
                ->where($this->siteid, $para['curr_ssid_id'])
                ->where('sta_mac', $para['mac'])
                ->from($this->statistics_action_sta)
                ->get()->row_array();
            if(!empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
}

?>
