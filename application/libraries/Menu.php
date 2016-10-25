<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 返回页面菜单相关
 */
class Menu {
    private $merchart = 21;
    private $readOnlyMerchart = 22;
    
    private $role;
    public function __construct($param) {
        $this->role = $param['role'];
    }
    
    private $nav = array(
        'info' => array('name'=>'分类信息', 'hide_name'=>'', 'url'=>'admin/info', 'active'=>false),
        'industry'   => array('name'=>'地方行业', 'hide_name'=>'', 'url'=>'admin/ad', 'active'=>false),
        'product'  => array('name'=>'特色产品', 'hide_name'=>'', 'url'=>'admin/sysuser', 'active'=>false),
        'groupon'    => array('name'=>'团购生活', 'hide_name'=>'', 'url'=>'admin/ap', 'active'=>false),
        'system'    => array('name'=>'系统管理', 'hide_name'=>'', 'url'=>'admin/user', 'active'=>false),
    );
    
    //核心配置快速导航菜单
    private $fast_nav = array(
        'ad'    => array('name'=>'portal管理', 'url'=>'admin/ad', 'active'=>false), 
        'auth'  => array('name'=>'认证管理', 'url'=>'admin/auth', 'active'=>false),  
        'ssid'  => array('name'=>'SSID管理', 'url'=>'admin/ssid', 'active'=>false),  
        'group'  => array('name'=>'网络分组', 'url'=>'admin/group', 'active'=>false),  
        'sysuser'  => array('name'=>'用户管理', 'url'=>'admin/sysuser', 'active'=>false),  
        'proj'  => array('name'=>'项目管理', 'url'=>'admin/proj', 'active'=>false),  
        'ap'  => array('name'=>'AP管理', 'url'=>'admin/ap', 'active'=>false), 
//        'ap_ssid'  => array('name'=>'AP-SSID', 'url'=>'admin/ap_ssid', 'active'=>false)
    );
    
    //找到活跃的主菜单
    private $nav_active = array(
        /*统计图表*/
        'welcome'           => 'index',  
        'st_log_time'       => 'index',  
        'st_online_user'    => 'index',
        'st_ap'             => 'index',
        'st_time_share'     => 'index',
        'st_ad_click'       => 'index',
        'st_user'           => 'index',

        /*网络管理*/  
        'ssid'  => 'net',
        'auth'  => 'net',
        'ad'    => 'net',
        'group'    => 'net',

        /*用户管理*/
        'sysuser'     => 'user',
        'proj'      => 'user',
        'privilege' => 'user',
        
        /*设备管理*/
        'ap' => 'ap',
        'ap_ssid' => 'ap',
        
        /*分类信息*/
        'info'     => 'info',
        'info_type'      => 'info',
        'info_attr' => 'info',
        
        /*系统管理*/
        'user'     => 'system',
        'region'      => 'system',
    );

    private $menu = array(
        
        /*分类信息二级菜单*/  
        'info'   => array('type'=>'info', 'name'=>'信息管理', 'url'=>'admin/info', 'active'=>false),  
        'info_type'=> array('type'=>'info', 'name'=>'分类管理', 'url'=>'admin/info_type', 'active'=>false),  
        'info_attr'         => array('type'=>'info', 'name'=>'属性管理', 'url'=>'admin/info_attr', 'active'=>false), 
        
        /*系统管理二级菜单*/  
        'user'   => array('type'=>'system', 'name'=>'用户管理', 'url'=>'admin/user', 'active'=>false),  
        'region'=> array('type'=>'system', 'name'=>'地区管理', 'url'=>'admin/region', 'active'=>false),  
    );
    
    public function get_menu($class_name)
    {
        $arr = array();
        if(!empty($this->menu[$class_name])){
            $type = $this->menu[$class_name]['type'];
            
            foreach ($this->menu as $key => $value) {
                if($value['type'] == $type){
                    $arr[$key] = $value;
                }
            }
            $arr[$class_name]['active'] = true;
        }
        if($this->merchart == $this->role){
            unset($arr['sysuser']);
        }
        return $arr;
    }
    
    public function get_nav($class_name){
        $arr = $this->nav;
        
        if(!empty($this->nav_active[$class_name]) && isset($this->nav_active[$class_name])){
            $arr[$this->nav_active[$class_name]]['active'] = true; 
        }
        if($this->readOnlyMerchart == $this->role){
            unset($arr['net']);
            unset($arr['user']);
        }
        return $arr;
    }
    
    public function get_fastNav($class_name) {
        $arr = $this->fast_nav;
        
        if(!empty($class_name) && isset($arr[$class_name])){
            $arr[$class_name]['active'] = true; 
        }
        if($this->merchart == $this->role){
            unset($arr['sysuser']);
        }else if($this->readOnlyMerchart == $this->role){
            unset($arr['ad']);
            unset($arr['auth']);
            unset($arr['ssid']);
            unset($arr['group']);
            unset($arr['sysuser']);
            unset($arr['proj']);
        }
        return $arr;
    }
}
