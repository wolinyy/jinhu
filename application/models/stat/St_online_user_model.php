<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class St_online_user_model extends St_Model {
    
    /*************************************************************************************
     * 上网用户构成
     *************************************************************************************/
    function getOnlineUserSumByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("SUM(auth_account_ok_count) total_account,
                SUM(auth_wechat1_ok_count + auth_wechat2_ok_count) total_wechat,
                SUM(auth_onekey_ok_count) total_onekey,
                SUM(auth_free_count) total_free,
                SUM(auth_app_ok_count) total_app,
                SUM(auth_noauth_count) total_noauth,
                SUM(auth_ok_count) total_auth_all,
                SUM(system_apple) total_sys_apple,
                SUM(system_android) total_sys_android,
                SUM(system_pc) total_sys_pc,
                SUM(system_other_mobile) total_sys_other");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res[0];
    }
    
    function getOnlineUserYesterdayByDay($para){
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $res = $this->db->select("auth_account_ok_count, (auth_wechat1_ok_count + auth_wechat2_ok_count) as auth_wechat_ok_count,
                               auth_onekey_ok_count, auth_free_count, auth_app_ok_count, auth_noauth_count, auth_ok_count,
                               system_apple, system_android, system_other_mobile system_other, system_pc")
                ->where('siteid', $para['curr_ssid_id'])
                ->where('date', $this->yseter_date)
                ->from($this->statistics_table)
                ->get()->row_array();
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        
        return $res;
    }
    
    //短信认证
    function getOnlineUserSmsCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_account_ok_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //微信认证
    function getOnlineUserWechatCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, (auth_wechat1_ok_count + auth_wechat2_ok_count) as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //一键登录
    function getOnlineUserOneKeyCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_onekey_ok_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //免费体验
    function getOnlineUserFreeCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_free_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //APP
    function getOnlineUserAppCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_app_ok_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //免认证
    function getOnlineUserNoAuthCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_noauth_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //全部认证数
    function getOnlineUserAuthAllCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, auth_ok_count as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //IOS系统
    function getOnlineUserSysAppleCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, system_apple as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //Android系统
    function getOnlineUserSysAndroidCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, system_android as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //PC系统
    function getOnlineUserSysPCCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, system_pc as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
    //其他系统
    function getOnlineUserSysOtherCntByDay($para) {
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $this->db->select("date, system_other_mobile as cnt");
            $res = $this->queryDay($para);
            if(is_array($res) && !empty($res))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
    }
    
}

?>
