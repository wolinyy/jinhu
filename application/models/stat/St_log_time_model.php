<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class St_log_time_model extends St_Model {
    
    /*************************************************************************************
     * 登录数统计页
     *************************************************************************************/
    
    #历史登录人数 上线人数 
    function history_total_sta($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->load_db();
            $res['total_ol_nums'] = $this->db->select()
                ->from($this->statistics_action_day_sta)
                ->where('siteid', $para['curr_ssid_id'])
                ->where('sta_count >', '0')
                ->group_by('sta_mac')
                ->get()->num_rows();
                
            $res['total_auth_nums'] = $this->db->select()
                ->from($this->statistics_action_day_sta)
                ->where('siteid', $para['curr_ssid_id'])
                ->where('auth_ok_count >', '0')
                ->group_by('sta_mac')
                ->get()->num_rows();
            
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }

    function getLogTimeSumByDay($para){
        //时段内 总登录次数 总登录人数 总WiFi使用比例 总首次登录比例 总广告点击率
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("SUM(sta_connect_count) total_ol_cnt,
                                SUM(sta_peo_count) total_ol_nums,
                                SUM(portal_pop_count) total_pop_cnt,
                                SUM(portal_pop_peo_count) total_pop_nums,
                                SUM(auth_ok_count) total_authed_cnt,
                                SUM(auth_ok_peo_count) total_authed_nums,
                                SUM(portal_click_ratio) total_click_ratio,
                                SUM(auth_ok_peo_count - sta_new_count) total_old_nums,
                                SUM(sta_new_count) total_new_nums,
                                SUM(sta_new_ratio) total_sta_new_ratio");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res[0];
    }
    
    function getLogTimeYesterdayByDay($para){
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $res = $this->db->select("sta_connect_count, sta_peo_count,
                                portal_pop_count, portal_pop_peo_count,
                                auth_ok_count, auth_ok_peo_count,
                                (auth_ok_peo_count - sta_new_count) sta_old_count,
                                sta_new_count,
                                portal_click_ratio, sta_new_ratio")
                ->where('siteid', $para['curr_ssid_id'])
                ->where('date', $this->yseter_date)
                ->from($this->statistics_table)
                ->get()->row_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_hour);
        }
        
        return $res;
    }

    //上线次数按日统计
    function getLogTimeOlTimeCntByDay($para){
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, sta_connect_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
    
    //上线人数按日统计
    function getLogTimeOlManCntByDay($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, sta_peo_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //上线人数按半小时统计
    function getLogTimeOlManCntByHalfHour($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("half_hour, SUM(count) as cnt")
                ->from($this->statistics_sta_half_hour)
                ->where('ssid_id', $para['curr_ssid_id'])
                ->where('date BETWEEN "' . $para['st'] . '" AND "' . $para['et'] . ' 23:59:59"')
                ->group_by('half_hour');
            $res = $this->db->get()->result_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    //上线人数按周统计
    function getLogTimeOlManCntByWeek($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, sta_peo_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    //上线人数按月统计
    function getLogTimeOlManCntByMonth($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, sta_peo_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    function getLogTimePortalPopCntByDay($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, portal_pop_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    function getLogTimePortalPopManCntByDay($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, portal_pop_peo_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }

    //登陆次数按日统计
    function getLogTimeTimeCntByDay($para){
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, auth_ok_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
    
    //登陆人数按日统计
    function getLogTimeManCntByDay($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, auth_ok_peo_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //新老用户对比统计
    function getLogTimeOldAndNewByDay($para) {
        if (! $res = $this->GetCache($this->getCacheName($para, __FUNCTION__)))
        {
            $this->db->select("date, sta_new_count as new_cnt, (auth_ok_peo_count - sta_new_count) as old_cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
}

?>
