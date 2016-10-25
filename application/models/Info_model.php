<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Info_model extends Yun_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    protected function getCacheName($para, $funcName=''){
        return $funcName . '_' .md5(serialize($para));
    }
    
    protected function CacheCheck($para, $funcName=''){
        return $this->GetCache($this->getCacheName($para, $funcName));
    }
    
    function getInfoWithCategory($para='') {
        
        $cnt = 0;
        $attr_where = ' ';
        if(isset($para['attr']) && !empty($para['attr'])){
            foreach ($para['attr'] as $key => $value) {
                if($value){
                    if(0 == $cnt){
                        $attr_where .= ' AND (' . ' (a.attr_id='. $key .' AND a.attr_value_text= '. $value . ')';
                    }else{
                        $attr_where .= ' OR' . ' (a.attr_id='. $key .' AND a.attr_value_text= '. $value . ')';
                    }
                    $cnt++;
                }
            }
        }
        if(0!=$cnt && 0!=strlen($attr_where)){
            $attr_where .= ') ';
        }
        
        $region_where = '';
        if(!empty($para['region_pid'])){
            $region_where .= ' and addr_one_id=' . $para['region_pid'] . ' ';
        }
        if(!empty($para['region_sid'])){
            $region_where .= ' and addr_two_id=' . $para['region_sid'] . ' ';
        }
        
        if (! $res = $this->CacheCheck($para, __FUNCTION__))
        {
            $sql_common = 'SELECT
                        i.`id`,
                        `title`,
                        `content`,
                        `update_at`,
                        `t1_name`,
                        `t2_name`,
                        `r1_name`,
                        `r2_name`,
                        `addr_two_id`,
                        type_one_id,
                        type_two_id,
                        a.attr_id,
                        a.attr_value_float,
                        a.attr_value_text
                        ,count(*) cnt
                    FROM
                        `yy_info_view` i
                    LEFT JOIN yy_infoAttrs a ON i.id=a.info_id
                    WHERE
                        (`status` = 1 OR `status` = 2)
                        AND `is_delete` = 0 ' . $para['sub_where'] . (0!=$cnt?$attr_where:'') . $region_where .
                    ' GROUP BY i.id ' . (0!=$cnt?'HAVING cnt=' . $cnt:'');
            $sql = $sql_common . ' ORDER BY `update_at` DESC
                    LIMIT ' . ($para['pageNow']-1)*$para['pageSize'] . ' , ' . $para['pageSize'];
            
            $res['data'] = $this->db->query($sql)->result_array();
            
            $sql_count = 'SELECT count(*) cnt FROM ('.$sql_common .') a';
            
            
            $tmp = $this->db->query($sql_count)->row_array();
            $total = $tmp['cnt'];

            $page_now = !empty($para['pageNow'])?$para['pageNow']:1;
            $page_size = !empty($para['pageSize'])?$para['pageSize']:10;
            $page_offset = ($page_now-1)*$page_size;
            $page_nums = ceil($total/$page_size);
            
            $res['pageinfo'] = [
                    'total'=>$total,
                    'now'=>$page_now,
                    'pageCount'=>$page_nums,
                    'size'=>$page_size
                ];
            if(is_array($res['data']) && !empty($res['data']))
                $this->cache->save($this->cache_name, $res, $this->cache_min);
        }
        return $res;
        
    }
}

?>
