<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//后台管理控制器
class Admin extends Admin_Controller {

    //后台首页展示
    public function index()
    {
        #$this->load->view('index');
        $this->render('index');
    }
    
    //用户退出
    public function logout(){
        $this->session->sess_destroy();
        $this->input->set_cookie(self::COOKIE_ADMIN_NAME, NULL);
        $this->input->set_cookie(self::COOKIE_ADMIN_PWD, NULL);
        
        redirect('admin/info');
    }
    
    //站点管理相关等
    
    //后台快速导航开关
    public function set_fast_nav($switch = '0'){
        $this->session->set_userdata(array(
            self::SESSION_ADMIN_FAST_NAV => $switch
        ));
        echo json_encode(array(
            'code'=>0
        ));
    }
    
    //显示用户信息修改页面
    public function to_update(){
        //获取登录用户信息
        $user_id = $this->session->userdata(self::SESSION_ADMIN_USERID);
        $action = 'sysUser_myself';
        $controller = 'sysUser';
        $jsonStr = $this->post_url($controller, $action, array('id'=>$user_id));
        $jsonArr = json_decode($jsonStr, true);
        if($jsonArr['code'] !== 0 && $jsonArr['code'] !== '0'){
            show_error($jsonArr['msg'], 200, '错误');
        }else if(0 == count($jsonArr['data'])){
            show_error('查询不到用户信息', 200, '错误');
        }else{
            $data['form'] = $jsonArr['data'][0];
            $data['update_flag'] = true;
            $this->render('sysuser_form', $data);
        }
    }
    
    //清除缓存
    public function clearCache() {
        $ret = $this->cache->clean();
        $code = -1;
        $msg = '缓存清除失败';
        
        if($ret){
            $code = 0;
        }
        echo json_encode(array(
            'code'=>$code,
            'msg'=>$msg
        ));
    }
}
