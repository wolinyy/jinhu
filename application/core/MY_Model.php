<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 作者:王林
 * 邮箱：545876197@qq.com
 * 说明：扩展Model类，为父类添加通用方法
 */
class MY_Model extends CI_Model {
    
    // 数据库相关
    protected $db_group = '';
    protected $table = '';
    protected $database;
    protected $dbprefix = null;

    // 缓存相关
    protected $cache_save = true;
    protected $cache_sec = 1;               // 1秒钟
    protected $cache_min = 60;              // 1分钟
    protected $cache_hour = 3600;           // 1小时
    protected $cache_day = 86400;           // 1天
    protected $cache_name;
    protected $cache_keys_name;              // 保存查询缓存变量名的缓存key
    protected $cache_time;
    //
    // 实例化子类名
    protected $class_name;
    

    public function __construct($tb='', $db_group='', $lazy_load=TRUE) {
        parent::__construct();
        
        $this->class_name = get_class($this);
        
        if(!empty($tb)) $this->table = $tb;
        if(!empty($db_group)) $this->db_group = $db_group;
        
        //是否直接连接数据库 不建议直接连接
        if(false === $lazy_load) $this->load_db();
    }
    
    //数据库连接唯一函数
    public function load_db(){
        if(empty($this->db)) {
            $this->load->database($this->db_group);
            //设置数据库
            if(!empty($this->database))
                $this->db->db_select($this->database);
            //设置前缀
            if(NULL !== $this->dbprefix)
                $this->db->dbprefix=$this->dbprefix;
        }
    }
    
    /***************************************************************************
    * 事务相关函数
    ***************************************************************************/
    public function TransBegin() {
        $this->load_db();
        $this->db->trans_begin();
    }

    public function TransCommit() {
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    /***************************************************************************
    * 缓存相关函数
    ***************************************************************************/
    public function get_cache_save(){
        return $this->cache_save;
    }

    public function set_cache_save($bool){
        $this->cache_save = $bool;
    }
    
    public function set_cache_time($cache_time){
        $this->cache_time = $cache_time;
    }

    protected function GetCacheKeysName() {
        //后期需要修改，分登录用户 TODO
        $this->cache_keys_name = $this->table . '_';
        
        return $this->cache_keys_name;
    }
    
    protected function GetCache($cacheName, $hav_prefix = true) {
        if($hav_prefix)
            $this->cache_name = $this->GetCacheKeysName() . $cacheName;
        else
            $this->cache_name = $cacheName;
        
        $res = $this->cache->get($this->cache_name);
        if(false === $res){
            //没有缓存时，载入数据库查询
            $this->load_db();
        }
        
        return $res;
    }
    
    protected function SaveCache($cacheVal, $cacheTime, $empty_save = true) {
        if(! $this->cache_save) return;
        if(false === $cacheVal) return;
        if(empty($cacheVal) && FALSE === $empty_save) return;
        
        //缓存该变量
        $this->cache->save($this->cache_name, $cacheVal, $cacheTime);
        
        //更新变量列表缓存
        $cacheKeysName = $this->GetCacheKeysName();
        $cacheKeysVal = $this->cache->get($cacheKeysName);
        if(false === $cacheKeysVal){
            $cacheKeysVal = [$this->cache_name];
        }else{
            $cacheKeysVal[] = $this->cache_name;
            array_unique($cacheKeysVal);
        }
        $this->cache->save($cacheKeysName, $cacheKeysVal, $this->cache_hour);
    }
    
    public function DeleteCache() {
        $cacheKeysName = $this->GetCacheKeysName();
//        print_r($cacheKeysName);exit;
        $cacheVal = $this->cache->get($cacheKeysName);
        if(false !== $cacheVal){
            foreach ($cacheVal as $cache_name) {
//                echo $cache_name . ' - <br >/';
                $this->cache->delete($cache_name);
            }
        }
        $this->cache->delete($cacheKeysName);
    }
    
    private function mixDb($mix, $get_cnt = false) {
        if(!empty($mix['where'])) $this->db->where($mix['where']);
        if(!empty($mix['join'])) $this->db->join($mix['join'][0], $mix['join'][1], $mix['join'][2]);
        if(!empty($mix['like'])) $this->db->like($mix['like']);
        if(!empty($mix['field'])) $this->db->select($mix['field']);
        if(!empty($mix['order_by']) && false === $get_cnt) {
            if(is_array($mix['order_by'])){
                foreach ($mix['order_by'] as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }else{
                $this->db->order_by($mix['order_by']);
            }
        }
        if(!empty($mix['group_by'])) $this->db->group_by($mix['group_by']);
    }
    public function selectByPk($pkey, $field = 'id', $empty_save = true) {
        $result = $this->GetCache(__FUNCTION__ . '_' . $pkey);
        if (false === $result)
        {
            echo 'no cahce<br />';
            $this->db->where($field, $pkey)
                    ->from($this->table)->limit(1);
            $result = $this->db->get()->row_array();;
            $this->SaveCache($result, $this->cache_hour, $empty_save);
        }
        return $result;
    }
    
    public function selectOne($mix='', $empty_save=true) {
        if(empty($mix))return;
        $result = $this->GetCache(__FUNCTION__ . '_' . md5(serialize($mix)));
        if (false === $result)
        {
            if(is_array($mix)){
                $this->mixDb($mix);
            }else{
                $this->db->where($mix);
            }
            
            $this->db->from($this->table)->limit(1);
            $result = $this->db->get()->row_array();;
            $this->SaveCache($result, $this->cache_hour, $empty_save);
        }
        return $result;
    }
    
    public function selectPage($mix=array(), $empty_save = true) {
        #if(empty($mix))return;
        $result = $this->GetCache(__FUNCTION__ . '_' . md5(serialize($mix)));
        if (false === $result)
        {
            $this->mixDb($mix, true);
            $total = $this->db->from($this->table)->count_all_results();
            
            //TODO
            $page_now = !empty($mix['pageNow'])?$mix['pageNow']:1;
            $page_size = !empty($mix['pageSize'])?$mix['pageSize']:10;
            $page_offset = ($page_now-1)*$page_size;
            $page_nums = ceil($total/$page_size);
            
            $this->mixDb($mix);
            $this->db->from($this->table)->limit($page_size, $page_offset);
            $list = $this->db->get()->result_array();
//            $result = [
//                'list'=>$list,
//                'pagination'=>[
//                    'page_total'=>$total,
//                    'page_now'=>$page_now,
//                    'page_nums'=>$page_nums,
//                    'page_size'=>$page_size
//                ]
//            ];
            $result = [
                'data'=>$list,
                'pageinfo'=>[
                    'total'=>$total,
                    'now'=>$page_now,
                    'pageCount'=>$page_nums,
                    'size'=>$page_size
                ]
            ];
            
            $this->SaveCache($result, $this->cache_hour, $empty_save);
        }
        return empty($result)?false:$result;
    }
    
    public function selectPageWithSql($sql, $empty_save = true) {
        $result = $this->GetCache(__FUNCTION__ . '_' . md5(serialize($sql)));
        if (false === $result)
        {
            $this->mixDb($mix, true);
            $total = $this->db->from($this->table)->count_all_results();
            
            //TODO
            $page_now = !empty($mix['pageNow'])?$mix['pageNow']:1;
            $page_size = !empty($mix['pageSize'])?$mix['pageSize']:10;
            $page_offset = ($page_now-1)*$page_size;
            $page_nums = ceil($total/$page_size);
            
            $this->mixDb($mix);
            $this->db->from($this->table)->limit($page_size, $page_offset);
            $list = $this->db->get()->result_array();
//            $result = [
//                'list'=>$list,
//                'pagination'=>[
//                    'page_total'=>$total,
//                    'page_now'=>$page_now,
//                    'page_nums'=>$page_nums,
//                    'page_size'=>$page_size
//                ]
//            ];
            $result = [
                'data'=>$list,
                'pageinfo'=>[
                    'total'=>$total,
                    'now'=>$page_now,
                    'pageCount'=>$page_nums,
                    'size'=>$page_size
                ]
            ];
            
            $this->SaveCache($result, $this->cache_hour, $empty_save);
        }
        return empty($result)?false:$result;
    }
    
    public function selectAll($mix=array(), $empty_save = false) {
        $result = $this->GetCache(__FUNCTION__ . '_' . md5(serialize($mix)));
        if (false === $result)
        {
            $this->mixDb($mix);
            if(!empty($mix['limit'])) $this->db->limit($mix['limit']);
            $this->db->from($this->table);
            $result = $this->db->get()->result_array();
            
            $this->SaveCache($result, $this->cache_hour, $empty_save);
        }
        return $result;
    }
    
    function selectCount($where=[], $empty_save = true){
        $result = $this->GetCache(__FUNCTION__ . '_' . md5(serialize($where)));
        if (false === $result)
        {
            $this->load_db();
            $this->db->where($where);
            $this->db->from($this->table);
            $result = $this->db->count_all_results();
            #$result = $this->db->get()->num_rows();
            
            $this->SaveCache($result, $this->cache_hour, $empty_save);
        }
        return $result;
    }
    
    /**
     * @param type $data 单条记录
     * @return 成功时返回插入的id，失败时返回 false
     */
    public function insert($data){
        $this->load_db();
        $this->db->insert($this->table, $data);
        
        // 是否插入成功
        if($ret = (1 == $this->db->affected_rows())){
            $ret = $this->db->insert_id();
            //更新缓存
            $this->DeleteCache();
        }else{
            log_message('error',  __FUNCTION__ . ' ' . $this->table . 'error, data is : ' . json_encode($data));
        }
        
        return $ret;
    }

    /**
     * @param type $data 多条记录，二维数组
     * @return 返回影响的条数
     */
    public function insert_batch($data) {
        $this->load_db();
        $this->db->insert_batch($this->table, $data);
        
        $ret = $this->db->affected_rows();
        
        if($ret != count($data)){
            log_message('error', __FUNCTION__ . ' ' . $this->table . 'error, data is : ' . json_encode($data));
        }
        if($ret>0) $this->DeleteCache();
        
        return $ret;
    }

    public function update($where, $data) {
        if(is_array($where) && !empty($where)){
            $this->load_db();
            $this->db->where($where)->update($this->table, $data);
            $rows = $this->db->affected_rows();
            if($rows>0) $this->DeleteCache();
            return $rows;
        }
        return false;
    }
    
    public function update_batch($data, $field) {
        $this->load_db();
        $this->db->update_batch($this->table, $data, $field);
        $rows = $this->db->affected_rows();
        log_message('error', __FUNCTION__ . ' : rows=' . $rows);
        if($rows>0) $this->DeleteCache();
        return $rows;
    }
    
    public function deleteByPk($mix, $field='id') {
        $this->load_db();
        if(is_array($mix))
            $this->db->where_in($field, $mix);
        else
            $this->db->where($field, $mix);
        $this->db->delete($this->table);
        $rows = $this->db->affected_rows();
        if($rows>0) $this->DeleteCache();
        return $rows;
    }
    public function delete($where) {
        $this->load_db();
        $this->db->where($where)->delete($this->table);
        $rows = $this->db->affected_rows();
        if($rows>0) $this->DeleteCache();
        return $rows;
    }
    
}

#代理商数据库中的模型
class Admin_Model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
}

#代理商数据库中的模型
class Yun_Model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        $this->database = 'jh';
        $this->dbprefix = 'yy_';
    }
}

#代理商统计图表数据库的模型
class St_Model extends MY_Model{
    
    protected $yseter_date;
    
    protected $statistics_table = 'statistics_action_day';
//    private $statistics_day_portal_pop = 'statistics_action_day';
    protected $portal_statistics_link_click = 'portal_statistics_link_click';
    protected $statistics_action_day_sta = 'statistics_action_day_sta';
    protected $statistics_action_sta = 'statistics_action_day_sta_new';
    protected $statistics_time_sharing = 'statistics_time_sharing';
    protected $statistics_ap_day = 'statistics_ap_day';
    protected $statistics_sta_half_hour = 'time_half_hour';
    protected $statistics_sta_month = 'time_month';

    protected $siteid = 'siteid';
    protected $ssid_id = 'ssid_id';
    
    public function __construct() {
        parent::__construct();
        $this->db_group = 'stat';
        $this->database = 'zstatistic';
        $this->dbprefix = '';
        
        $this->cache_min = $this->cache_min * 5;
        $this->yseter_date = date("Y-m-d",strtotime("-1 day"));
    }
    
    protected function queryDay($para, $table = '') {
        return $this->db->where('siteid', $para['curr_ssid_id'])
                ->where('date BETWEEN "' . $para['st'] . '" AND "' . $para['et'] . ' 23:59:59"')
                ->from(empty($table)?$this->statistics_table:$table)
                ->get()->result_array();
    }
    
    protected function getCacheName($para, $funcName=''){
        if(!empty($funcName))
            $para['funcName'] = $funcName;
        
        $cache_name = $para['funcName'];
        if(!empty($para['st'])){
            $cache_name .= '-' . $para['st'];
            if(!empty($para['et']))
                $cache_name .= '-' . $para['et'];
        }
        $cache_name .= '-' . $para['curr_ssid_id'];
        
        return $cache_name;
    }
    
    protected function CacheCheck($para, $funcName=''){
        return $this->GetCache($this->getCacheName($para, $funcName));
    }
}

#测试用
class Z_TEST_Model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        $this->database = 'z_test';
        $this->dbprefix = 'test_';
    }
}

?>
