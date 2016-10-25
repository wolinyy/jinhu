<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class St_ad_click_model extends St_Model {
    
    /*************************************************************************************
     * 广告点击
     *************************************************************************************/
    function getAdClickSumByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("SUM(auth_ok_count) total_cpm,
                                SUM(portal_click_count) total_cpc,
                                SUM(portal_click_ratio) total_click_ratio");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res[0];
    }
    
    function getAdClickYesterdayByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $res = $this->db->select("auth_ok_count cpm, portal_click_count cpc, portal_click_ratio")
                ->where('siteid', $para['curr_ssid_id'])
                ->where('date', $this->yseter_date)
                ->from($this->statistics_table)
                ->get()->row_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_hour);
        }
        
        return $res;
    }
    
    function getAdClickTimeTop($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $sql = 'SELECT a.url,a.cnt,COUNT(b.url) yester_cnt FROM
                    (SELECT siteid, url, COUNT(url) cnt
                    FROM portal_statistics_link_click
                    WHERE siteid = '.$para['curr_ssid_id'].' AND create_at BETWEEN "'.$para['st'].' 00:00:00" AND "'.$para['et'].' 23:59:59"
                    GROUP BY url LIMIT 10 ) a
                    LEFT JOIN
                    portal_statistics_link_click b ON b.url=a.url AND b.siteid=a.siteid AND create_at BETWEEN "'.$this->yseter_date.' 00:00:00" AND "'.$this->yseter_date.' 23:59:59"
                    GROUP BY url ORDER BY cnt DESC';
            $res = $this->db->query($sql)->result_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    function getAdClickHisTop($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("url,COUNT(url) cnt")
                ->where('siteid', $para['curr_ssid_id'])
                ->group_by('url')
                ->order_by("cnt", "desc")
                ->limit(10)
                ->from($this->portal_statistics_link_click);
            $res = $this->db->get()->result_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_hour);
        }
        return $res;
    }
    
    //登陆次数按日统计
    function getLogTimeTimeCntByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_ok_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
    function getAdClickAdCPMByDay($para) {
        $res = $this->getLogTimeTimeCntByDay($para);
        return $res;
    }
    
    function getAdClickAdClickCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, portal_click_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    function getAdClickAdClickRatioByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, portal_click_ratio as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
}

?>
