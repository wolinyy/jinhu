<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BASE_Controller extends CI_Controller {
    
    protected $content = [];
    //后台登录标识
    const SESSION_ADMIN = 'admin';
    const SESSION_ADMIN_USERID = 'user_id';
    const SESSION_ADMIN_USERNAME = 'username';
    const SESSION_ADMIN_ROLE = 'role_id';
    const SESSION_ADMIN_ASSOCIATE = 'associate_id';
    //后台验证码字段
    const SESSION_ADMIN_CODE = 'admin_code';
    //后台COOKIE 用户名密码
    const COOKIE_ADMIN_NAME = 'username';
    const COOKIE_ADMIN_PWD = 'password';
    //后台错误保存
    const FLASH_ERR_MSG = 'admin_err_msg';
    
    //后台 快速导航开关
    const SESSION_ADMIN_FAST_NAV = 'fast_nav';
    
    protected $class;
    protected $method;

    public function __construct() {
        parent::__construct();
        
        $this->class = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
        
        $this->load->library('session');
        $this->load->helper('url');
        
        //开启缓存驱动
        $this->load->driver('cache', ['adapter' => 'file']);
        #$this->load->driver('cache', ['adapter' => 'memcached', 'backup' => 'file']);
    }
    
    public function render($view, $data=array(), $content=array()){
//        print_r($data);exit;
        $this->content = array_merge($this->content, $content);
        $this->content['_content'] = $this->load->view($view, $data, true);
        $this->load->view('layout', $this->content);
    }
    
    protected function curl($url, $data='', $debug = false) {
        
//        $debug = true;
        if(true === $debug){
        /* DEBUG */
            $retJson = array(
                'code' => 0,
                self::SESSION_ADMIN_USERID  => 1,
                self::SESSION_ADMIN_USERNAME  => 'wolin',
                self::SESSION_ADMIN_ROLE  => 2,
                self::SESSION_ADMIN_ASSOCIATE  => -1,
                'parent_id'     => '',
                'token'  => md5('token'),
            );
            return json_encode($retJson);
        }
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        //curl_setopt($curl, CURLOPT_USERAGENT, $GLOBALS['agent']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        if(empty($data)){
            $data = file_get_contents("php://input");
        }
        if(is_array($data) || is_object($data)) $data = http_build_query ($data);
        
        log_message('error', 'POST_URL : ' . $url);
        log_message('error', 'POST_URL data : ' . json_encode($data));
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data); // Post提交的数据包
        //curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
//            echo __LINE__.'Errno' . curl_error($curl);
            $tmpInfo = curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $tmpInfo; // 返回数据
    }
    
    protected function do_admin_login($param) {
        $success = false;
        $msg = '用户名密码错误';
        
        $this->load->model('Base');
        $this->Base->setTable('user');
        
        $this->Base->set_cache_save(false);
        $mix['field'] = 'id,role_id,name,passwd,salt';
        $mix['where'] = [
            'name'=>$param['username'],
            'role_id'=>100
        ];
        $res = $this->Base->selectOne($mix);
//        echo md5($param['password'].$res['salt']) . '<br />';
//        print_r($res);exit;
        if($res && $res['name']===$param['username'] && $res['passwd']===  md5($param['password'].$res['salt'])){
            $success = true;
            $sessData = array(
                self::SESSION_ADMIN  => $res['name'],
                self::SESSION_ADMIN_USERID  => $res['id'],
                self::SESSION_ADMIN_USERNAME  => $res['name'],
                self::SESSION_ADMIN_ROLE     => $res['role_id'],
            );
            $this->session->set_userdata($sessData);
        }else{
            $this->session->set_flashdata(self::FLASH_ERR_MSG, $msg);
        }
        return $success;
    }
    
    protected function post_url($controller, $action='', $data=''){
        if(empty($action))
            return;
        $url = DC_YUN_URL . $controller;
        $user_id = $this->session->userdata(self::SESSION_ADMIN_USERID);
        $token = $this->session->userdata('token');
        $role = $this->session->userdata(self::SESSION_ADMIN_ROLE);
        $associate_id = $this->session->userdata(self::SESSION_ADMIN_ASSOCIATE);
        if(self::ROLE_AGENT_RELATED == $role && !empty($associate_id)){
            $user_id = $associate_id;
        }
        $sign = md5($user_id . $token . $action);
        $url .= '?user_id='.$user_id.'&token='.$token.'&action='.$action.'&sign='.$sign.'&role_id='.$role;
//        print_r($url);
//        echo '<br />';
//        print_r($data);
//        exit;
        $retStr = $this->curl($url, $data);
        return $retStr;
    }
}

// 前台父控制器
class Home_Controller extends BASE_Controller {

    const SESSION_INFO_SUBMIT = 'info_submit';
    //前台登录标识
    const SESSION_USERID = 'home_user_id';
    const SESSION_USERNAME = 'home_username';
    const SESSION_ROLE = 'home_role_id';
    //前台COOKIE 用户名密码
    const COOKIE_NAME = 'home_username';
    const COOKIE_PWD = 'home_password';
    
    const SESSION_EMAIL_SEND = 'session_email_send';
    
    protected $user_id;
    protected $user_name;
    protected $role;
    protected $table = 'user';
    
    protected $pk = 'id';
    
    public function __construct() {
        parent::__construct();
        
        //切换主题
        $this->load->switch_themes_home();
        
        $this->login_check();
        
        //站点信息
        $this->content = [
            'title'=> WEB_SITE,
            'site_name'=> WEB_SITE,
            'class'=>  $this->class,
            'method' => $this->method,
            '_username' => $this->user_name,
            '_uid'=>  $this->user_id,
            '_role_id'=>  $this->role
        ];
    }
    
    #登录检测
    private function login_check() {
        $sess = $this->session->userdata(self::SESSION_ADMIN);
        if ( ! $sess){
            //没有session字段，检查是否有cookie
            $name = $this->input->cookie(self::COOKIE_NAME, true);
            $pwd = $this->input->cookie(self::COOKIE_PWD, true);
            if($name && $pwd){
                $this->load->library('encrypt');
                $name = $this->encrypt->decode($name);
                $pwd = $this->encrypt->decode($pwd);
                //进行接口验证
                $ret = $this->do_admin_login(array('username'=>$name, 'password'=>$pwd));
                if(false === $ret['code']){
                    #登录失败， 删除cookie
                    $this->input->set_cookie(self::COOKIE_NAME, NULL);
                    $this->input->set_cookie(self::COOKIE_PWD, NULL);
                }
            }else{
            }
        }
        $this->user_id = $this->session->userdata(self::SESSION_USERID);
        $this->user_name = $this->session->userdata(self::SESSION_USERNAME);
        $this->role = $this->session->userdata(self::SESSION_ROLE);
//        print_r($this->session->all_userdata());
    }
    
    protected function do_admin_login($param) {
        $success = false;
        $errMsg = '';
        
        //查询数据库检查
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        $mix['where'] = 'name="' . $param['username'] . '" or email="' . $param['username'] .'"';
        $mix['field'] = 'id, name, role_id, email, passwd, salt, status';

        $row = $this->Base->selectOne($mix);
        if($row){
            if($row['passwd'] == md5($param['password'] . $row['salt'])){
                //账户状态 0-注册未激活 1-激活可用 2-被举报账户受限 3-黑名单账户
                switch ($row['status']){
                    case '0':
                        $emailData['id'] = $row['id'];
                        $emailData['email'] = $row['email'];
                        $emailData['salt'] = $row['salt'];
                        $emailData['resendcnt'] = 1;
                        $emailData['sendtime'] = time();

                        $this->session->set_userdata(self::SESSION_EMAIL_SEND, json_encode($emailData));
                        $errMsg = '账户未激活, ' . '<strong><a href="' . site_url('user/user_resend') . '">立即激活</a></strong>';
                        break;
                    case '1':
                        $success = true;
                        $sessData = array(
                            self::SESSION_USERID  => $row['id'],
                            self::SESSION_USERNAME  => $row['name'],
                            self::SESSION_ROLE     => $row['role_id'],
                        );
                        $this->session->set_userdata($sessData);
                        break;
                    case '2': 
                        $errMsg = '账户被举报，限制使用';
                        break;
                    case '3': 
                        $errMsg = '账户黑名单，限制使用';
                        break;
                    default:
                        $errMsg = '未知的账户状态';
                        break;
                }
            }else{
                $errMsg = '用户名或密码错误';
            }
        }else{
            $errMsg = '用户名或邮箱不存在';
        }

        $ret = [
            'code'=>$success,
            'errMsg'=>$errMsg
        ];
        return $ret;
    }
}

// 后台父控制器
class Admin_Controller extends BASE_Controller {
    
    
    protected $table;
    protected $controller;
    protected $action;
    protected $action_add;
    protected $action_edit;
    protected $action_del;
    protected $action_get;
    protected $action_getByPk;
    protected $pk = 'id';
    protected $sortkey = 'id';

    protected $user_id;
    protected $user_name;
    protected $role;

    
    public function __construct() {
        parent::__construct();
        
        $this->login_check();
        
        //切换主题
        $this->load->switch_themes_admin();
        
        //站点信息
        $this->content = [
            'title'=>'金湖网管理后台',
            'site_name'=>'金湖地方网',
            'class'=>  $this->class,
            'method' => $this->method,
            '_username' => $this->user_name,
            '_uid'=>  $this->user_id,
            'role_id'=>  $this->role
        ];
        $this->get_menu();
    }
    
    private function needLogin() {
        // php 判断是否为 ajax 请求
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){ 
            // ajax 请求的处理方式 
            $ret = array(
                'code'=> 10,    //10表示重新登录
                'msg'=> 'need auth'
            );
            echo json_encode($ret);
            exit;
        }else{ 
            // 正常请求的处理方式
            redirect('admin/site/login');
        };
    }
    #登录检测
    private function login_check() {
        $sess = $this->session->userdata(self::SESSION_ADMIN);
        if ( ! $sess){
            //没有session字段，检查是否有cookie
            $name = $this->input->cookie(self::COOKIE_ADMIN_NAME, true);
            $pwd = $this->input->cookie(self::COOKIE_ADMIN_PWD, true);
            if($name && $pwd){
                $this->load->library('encrypt');
                $name = $this->encrypt->decode($name);
                $pwd = $this->encrypt->decode($pwd);
                //进行接口验证
                $success = $this->do_admin_login(array('username'=>$name, 'password'=>$pwd));
                if(false === $success){
                    #登录失败， 删除cookie
                    $this->input->set_cookie(self::COOKIE_ADMIN_NAME, NULL);
                    $this->input->set_cookie(self::COOKIE_ADMIN_PWD, NULL);
                    $this->needLogin();
                }
            }else{
                $this->needLogin();
            }
        }
        $this->user_id = $this->session->userdata(self::SESSION_ADMIN_USERID);
        $this->user_name = $this->session->userdata(self::SESSION_ADMIN_USERNAME);
        $this->role = $this->session->userdata(self::SESSION_ADMIN_ROLE);
//        print_r($this->session->all_userdata());
    }
    
    protected function role_check() {
        if(in_array($this->role, array(
//            self::ROLE_AGENT_1,
//            self::ROLE_AGENT_2,
//            self::ROLE_AGENT_3,
//            self::ROLE_AGENT_4,
            self::ROLE_AGENT_RELATED,
//            self::ROLE_MERCHART,
            self::ROLE_MERCHART_READONLY,
        ))){
            echo json_encode(array('code'=>-1, 'msg'=>'没有操作权限'));
            exit;
        }
    }

    #获取二级菜单
    private function get_menu() {
        $this->load->library('menu', array(
            'role' => $this->role
        ));
        
        $this->content['_nav'] = $this->menu->get_nav(strtolower($this->class));
        $this->content['_menu'] = $this->menu->get_menu(strtolower($this->class));
        $this->content['_fastNav'] = $this->menu->get_fastNav(strtolower($this->class));
        $this->content['_fastNavSw'] = $this->session->userdata(self::SESSION_ADMIN_FAST_NAV);
    }
    
    public function index() {
        $this->render(strtolower($this->class), array(
            'role_id'=>  $this->role,
            'role_readonly' => array(
                self::ROLE_AGENT_RELATED,
                self::ROLE_MERCHART_READONLY
            )
        ));
    }
    
    function customSort(&$data) {
        if(!empty($this->sortkey)){
            $data['sortkey'] = $this->sortkey;
            $data['sort'] = 2;
        }
    }
    
    private function my_get($data){
        $controller = $this->controller;
        $this->action = $this->action_get;
        $jsonStr = $this->post_url($controller, $this->action, $data);
        return $jsonStr;
    }
    function buildQueryData() {
        $page = $this->input->post('pagination', true);
        $like = $this->input->post('filter[like]', true);
        $where = $this->input->post('filter[where]', true);
        $order = $this->input->post('order', true);
        
        $data = is_array($page)?$page:array();
        if(!empty($like) && is_array($like)){
            $data = array_merge($data, $like);
        }
        if(!empty($where) && is_array($where)){
            $data = array_merge($data, $where);
        }
        if(!empty($order) && is_array($order)){
            $data = array_merge($data, $order);
        }else{
            $this->customSort($data);
        }
        return $data;
    }
    function get() {
        $data = $this->buildQueryData();
        $this->beforeGet($data);
        log_message('error', json_encode($data));
        $jsonStr = $this->my_get($data);
        echo $jsonStr;
    }
    function beforeGet(&$data){
    }
    
    function beforeSubmit($data, $pk){
        return $data;
    }
    function submit() {
        $this->role_check();
        
        $controller = $this->controller;
        $this->action = $this->action_add;
        
        $data = $this->input->post('data', TRUE);
        $dataBuild = $this->beforeSubmit($data, $this->pk);
//        print_r($data);exit;
        
        if(empty($data)){
            echo json_encode(array('code'=>-1, 'msg'=>'接口不存在'));
            exit;
        }
        
        if(isset($data[$this->pk]) && !empty($data[$this->pk])){
            $this->action = $this->action_edit;
        }
        $jsonStr = $this->post_url($controller, $this->action, $dataBuild);
        echo $jsonStr;
        return $jsonStr;
    }
    
    public function del() {
        $this->role_check();
        
        $controller = $this->controller;
        $this->action = $this->action_del;
        
        $data['ids'] = $this->input->post('id', TRUE);
        
        $jsonStr = $this->post_url($controller, $this->action, $data);
        echo $jsonStr;
        return $jsonStr;
    }
    
    public function batch_del() {
        $this->role_check();
        
        $controller = $this->controller;
        $this->action = $this->action_del;
        
        $idArr = $this->input->post('id', TRUE);
        $idstr = 'ids=' . implode('&ids=', $idArr);
        $jsonStr = $this->post_url($controller, $this->action, $idstr);
        echo $jsonStr;
        return $jsonStr;
    }
    
    function show_form_data_handler(&$data) {
        return $data;
    }
    
    function show_form() {
        $data = array();
        $modal_show = $this->input->get('modal', true);
        
        if($modal_show){
            //对话框显示
            $this->show_form_data_handler($data);
            $this->load->view($this->class . '_form', $data);
        }else{
            //新页面展示
            $primaryKey = $this->input->get('id', true);
            if(!empty($primaryKey)){
                $data['id'] = $primaryKey;
                $jsonArr = $this->my_get($data);
                if("0" != $jsonArr['code'] || empty($jsonArr['data'])){
                    redirect('admin/'.$this->class);
                    return;
                }  else {
                    $data['form'] = $jsonArr['data'];
                    $this->show_form_data_handler($data);
                }
            }
            $this->render($this->class . '_form', $data);
        }
    }
}

// 后台统计控制器
class St_Controller extends Admin_Controller {
    
    protected function getResp() {
        $para = $_POST;
//        $para['curr_ssid_id'] = $this->session->userdata('cur_ssid_id');
        $para['curr_ssid_id'] = 290;#1153;#677;#382;
        
        $resp['code'] = 0;
        $resp['para'] = $para;
        
        if(!empty($para['flushData']) && 1==$para['flushData']){
            $this->getFlushData($resp);
        }
        return $resp;
    }
    
    protected function getFlushData(&$resp){
        
    }
}

// 测试父控制器
class Test_Controller extends BASE_Controller {

    public function __construct() {
        parent::__construct();
         
        //打开调试信息
        $this->output->enable_profiler(TRUE);
        
    }
}