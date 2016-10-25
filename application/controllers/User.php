<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//用户管理
class User extends Home_Controller {

    const SESSION_REG_SUBMIT = 'session_reg_code';
    const SESSION_LOGIN_SUBMIT = 'session_login_code';
    const SESSION_FIND_PWD_SUBMIT = 'session_find_pwd_code';
    
    const FLASH_ERR_MSG = 'home_login_errMsg';
            
    public function __construct() {
        
        parent::__construct();
        $this->table = 'user';
        $this->table_view = 'user_view';
    }
    
    //展示注册页面
    function user_reg() {
        $this->render(strtolower(__FUNCTION__));
    }
    
    //展示注册成功页面
    function user_reg_succ() {
        $this->render(strtolower(__FUNCTION__));
    }
    
    //展示登录页面
    function user_login() {
        if($this->user_id){
            redirect('/');
        }
        
        $data['errMsg'] = $this->session->userdata(self::FLASH_ERR_MSG);
        $this->load->view(strtolower(__FUNCTION__), $data);
    }
    
    function user_pwd_find() {
        if('POST' == $_SERVER['REQUEST_METHOD']){
            $email = $this->input->post('email', true);
            $vCode = $this->input->post('vCode', true);
            
            $mix['field'] = 'id, name, email, salt, update_at';
            $mix['where']['email'] = $email;

            $this->load->model('Base');
            $this->Base->setTable($this->table);
            $row = $this->Base->selectOne($mix);
    //        print_r($row);
            if(!$row){
                $this->render('message', [
                    'code' => -1,
                    'title' => '忘记密码',
                    'content' => '邮箱未注册，&nbsp;&nbsp;' . '<button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">返回</button>',
                ]);
                return;
            }

            $sessCode = $this->session->userdata(self::SESSION_FIND_PWD_SUBMIT);
            if($vCode == false || strtolower($vCode) !== strtolower($sessCode)){
                $this->render('message', [
                    'code' => -1,
                    'title' => '忘记密码',
                    'content' => '验证码错误，&nbsp;&nbsp;' . '<button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">返回</button>',
                ]);
                return;
            }else{
                //发送邮件
                $this->load->library('email');

                $this->email->from(WEB_EMAIL, WEB_SITE);
                $this->email->to($email); 

                $this->email->subject(WEB_SITE . '重置密码');
                $this->email->message(
                    '您忘记了' .WEB_SITE . '注册账号的密码，点击链接来重置密码吧.'
                    .'<strong><a href="' . site_url('user/user_reset_pwd') . '?email=' . $email . '&code=' . md5($row['salt'] . $row['update_at']) . '">立即重置密码</a></strong>'
                    .'<p>如果您没有忘记密码，请忽略这封邮件</p>'
                );

                if ( ! $this->email->send())
                {
                    $this->render('message', [
                        'code' => -1,
                        'title' => '重置密码',
                        'content' => '发送邮件失败，&nbsp;&nbsp;' . '<button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">返回</button>',
                    ]);
                }else{
                    $this->render('message', [
                        'code' => -1,
                        'title' => '重置密码',
                        'content' => '发送邮件成功,请查收邮件'
                    ]);
                }
                
            }
        }else{
            $this->render(strtolower(__FUNCTION__));
        }
    }

    function user_reset_pwd() {
        $email = $this->input->get_post('email', true);
        $code = $this->input->get_post('code', true);

//        echo $email . ' - ' . $code;
        if($this->user_id){
            //如果是登录后修改密码，需要输入原始密码
            $this->render(strtolower(__FUNCTION__), [
                'id' => $this->user_id,
            ]);
        }else if(!empty ($email)){
            //如果是邮箱的链接，不用输入原始密码
            $mix['field'] = 'id, name, email, salt, update_at';
            $mix['where']['email'] = $email;

            $this->load->model('Base');
            $this->Base->setTable($this->table);
            $row = $this->Base->selectOne($mix);
            if($row){
                if(md5($row['salt'] . $row['update_at']) == $code){
                    $this->render(strtolower(__FUNCTION__), [
                        'id' => $row['id'],
                        'email' => $email,
                        'code' => $code,
                    ]);
                }else{
                    $this->render('message', [
                        'code' => -1,
                        'title' => '重置密码',
                        'content' => '参数错误',
                    ]);
                }
            }else{
                $this->render('message', [
                    'code' => -1,
                    'title' => '重置密码',
                    'content' => '查找不到改email用户',
                ]);
            }
        }else{
            redirect('/');
        }
    }
    
    function logout() {
        //用户退出
        $this->session->unset_userdata(self::SESSION_USERID);
        $this->session->unset_userdata(self::SESSION_USERNAME);
        $this->session->unset_userdata(self::SESSION_ROLE);
        $this->input->set_cookie(self::COOKIE_NAME, NULL);
        $this->input->set_cookie(self::COOKIE_PWD, NULL);
        
        redirect('/');
    }
    
    //用户注册验证码
    public function reg_code() {
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => '104',
            'img_height' => 34,
            'expiration' => 7200,
            'font_size' => 16,
            'font_path' => ASSERTS_DIR . 'font/VerifyCode.ttf',
            'colors'	=> array(
                'background'	=> array(185,230,236),
                'border'	=> array(222,244,254),
                'text'		=> array(51,122,183),
                'grid'		=> array(178,162,82)
            )
        );
        $cap = create_captcha($vals);
        #保存到session
        $this->session->set_userdata(self::SESSION_REG_SUBMIT, $cap);
    }
   
    //用户登录验证码
    public function login_code() {
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => '104',
            'img_height' => 34,
            'expiration' => 7200,
            'font_size' => 16,
            'font_path' => ASSERTS_DIR . 'font/VerifyCode.ttf',
            'colors'	=> array(
                'background'	=> array(185,230,236),
                'border'	=> array(222,244,254),
                'text'		=> array(51,122,183),
                'grid'		=> array(178,162,82)
            )
        );
        $cap = create_captcha($vals);
        #保存到session
        $this->session->set_userdata(self::SESSION_LOGIN_SUBMIT, $cap);
    }
    
    //用户登录验证码
    public function find_pwd_code() {
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => '104',
            'img_height' => 34,
            'expiration' => 7200,
            'font_size' => 16,
            'font_path' => ASSERTS_DIR . 'font/VerifyCode.ttf',
            'colors'	=> array(
                'background'	=> array(185,230,236),
                'border'	=> array(222,244,254),
                'text'		=> array(51,122,183),
                'grid'		=> array(178,162,82)
            )
        );
        $cap = create_captcha($vals);
        #保存到session
        $this->session->set_userdata(self::SESSION_FIND_PWD_SUBMIT, $cap);
    }
    
    function reg_form_check() {
        $name = $this->input->post('name', true);
        $email = $this->input->post('email', true);
        
        $mix['field'] = 'id, name, email';
        if($name) $mix['where']['name'] = $name;
        if($email) $mix['where']['email'] = $email;;
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);

        $row = $this->Base->selectOne($mix);
//        print_r($row);
        if($row){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    function reg_code_check() {
        $vCode = $this->input->post('vCode', true);
        $sessCode = $this->session->userdata(self::SESSION_REG_SUBMIT);
        
        if($vCode == false || strtolower($vCode) !== strtolower($sessCode)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    function do_reg() {
        $data = $this->input->post('data', TRUE);
       
        //用户名不可以包含@字符
        if(false === strpos($data['name'], '@')){
            $resp = [
                'code'=>-1,
                'msg'=> '用户名不可以包含@字符',
            ];
            echo json_encode($resp);
            exit;
        }
        
        $this->load->model('Base');
        
        //检验
        #用户名 #邮箱
        $mix['field'] = 'id, name, email';
        $mix['where'] = 'name = \''. $data['name'] . '\' or email = \'' . $data['email'] .'\'';
        
        $this->Base->setTable($this->table);
        $row = $this->Base->selectOne($mix);
        
        if($row){
            $resp = [
                'code'=>-1,
                'msg'=> ($row['name']==$data['name']?'用户名':'邮箱') . '已经存在',
            ];
            echo json_encode($resp);
            exit;
        }
        #密码
        if($data['passwd'] != $data['repasswd']){
            $resp = [
                'code'=>-1,
                'msg'=> '密码输入不一致',
            ];
            echo json_encode($resp);
            exit;
        }
        #验证码
        $sessCode = $this->session->userdata(self::SESSION_REG_SUBMIT);
        if($data['vCode'] == false || strtolower($data['vCode']) !== strtolower($sessCode)){
            $resp = [
                'code'=>20,
                'msg'=> '验证码输入错误',
            ];
            echo json_encode($resp);
            exit;
        }
        
        //删除验证码
        $this->session->unset_userdata(self::SESSION_REG_SUBMIT);
        
        //添加用户
        unset($data['vCode']);
        unset($data['repasswd']);
        
        $salt = md5($data['name'] . time());
        $data['create_at'] = time();
        $data['update_at'] = $data['create_at'];
        $data['update_at'] = $data['create_at'];
        $data['salt'] = $salt;
        $data['passwd'] = md5($data['passwd'] . $salt);
        
        $ret = $this->Base->insert($data);
        if($ret){
            $emailData['id'] = $ret;
            $emailData['email'] = $data['email'];
            $emailData['salt'] = $data['salt'];
            $emailData['resendcnt'] = 1;
            $emailData['sendtime'] = time();
            //发送注册邮件
            if($this->sendemail($emailData)){
                $this->session->set_userdata(self::SESSION_EMAIL_SEND, json_encode($emailData));
                $resp = ['code'=>0, 'msg'=>''];
            }else{
                $resp = ['code'=>20, 'msg'=>'激活邮件发送失败'];
                log_message('error', '激活邮件发送失败');
            }
        }else{
            $resp = ['code'=>20, 'msg'=>'注册失败,数据库添加失败'];
            log_message('error', '注册失败,数据库添加失败');
        }
        echo json_encode($resp);
    }
    
    function do_login() {
        $errMsg = '';
        
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $remember = $this->input->post('remember', true);
        
        $code = $this->input->post('verifyCode', TRUE);
        $sessCode = $this->session->userdata(self::SESSION_LOGIN_SUBMIT);
        
        if($code == false || strtolower($code) !== strtolower($sessCode)){
            $errMsg = '验证码输入错误';
        }else{
            $ret = $this->do_admin_login(array('username'=>$username, 'password'=>$password));
            
//            print_r($ret);exit;
            if($ret['code'] == TRUE){
                if('on' == $remember){
                    //记住用户名密码,自己提交
                    $this->load->library('encrypt');
                    $this->input->set_cookie(self::COOKIE_NAME, $this->encrypt->encode($username), 24*60*60);
                    $this->input->set_cookie(self::COOKIE_PWD, $this->encrypt->encode($password), 24*60*60);
                }
                redirect('/');
                exit;
            }
            $errMsg = $ret['errMsg'];
        }
        
        $this->session->set_flashdata(self::FLASH_ERR_MSG, $errMsg);
        redirect('/user/user_login');
    }
    
    //重置密码
    function do_reset_pwd() {
        $passwd = $this->input->post('passwd', TRUE);
        $repasswd = $this->input->post('repasswd', TRUE);
        $id = $this->input->post('id', true);
        
        $code = $this->input->post('code', true);
        $oldpasswd = $this->input->post('oldpasswd', TRUE);
        
        $mix['field'] = 'id, name, email, passwd, salt, update_at';
        $mix['where']['id'] = $id;

        $this->load->model('Base');
        $this->Base->setTable($this->table);

        $row = $this->Base->selectOne($mix);
//        print_r($row);
        if(!$row){
            $this->render('message', [
                'code' => -1,
                'title' => '修改密码失败',
                'content' => '查找不到记录，&nbsp;&nbsp;' . '<button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">返回</button>',
            ]);
            return;
        }

        if(isset($oldpasswd) & !empty($oldpasswd)){
            //登录后修改
            if($row['passwd'] != md5($oldpasswd . $row['salt'])){
                $this->render('message', [
                    'code' => -1,
                    'title' => '修改密码失败',
                    'content' => '原始密码错误，&nbsp;&nbsp;' . '<button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">返回</button>',
                ]);
                return;
            }
        }else{
            //邮箱重置密码
            if($code != md5($row['salt'] . $row['update_at'])){
                $this->render('message', [
                    'code' => -1,
                    'title' => '重置密码错误',
                    'content' => '链接已过期，&nbsp;&nbsp;' . '<button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">返回</button>',
                ]);
                return;
            }
        }
        
        $time = time();
        $salt = md5($row['name'] . $time);
        $passwd = md5($passwd . $salt);
        $ret = $this->Base->update([
            'id'=>$id
        ],[
            'salt'=>$salt,
            'passwd'=>$passwd,
            'update_at' => $time
        ]);
        
        if($ret){
            $data = [
                'code' => 0,
                'title' => '密码修改成功',
                'content' => '密码修改成功！'   // &nbsp;<a href="'.site_url('/user/user_login').'" class="alert-link">立即登录</a>'
            ];
        }else{
            $data = [
                'code' => -1,
                'title' => '密码修改失败',
                'content' => '数据库更新失败'
            ];
        }
        $this->render('message', $data);
        return;
    }
    
    private function sendemail($data) {
        $this->load->library('email');

        $this->email->from(WEB_EMAIL, WEB_SITE);
        $this->email->to($data['email']); 

        $this->email->subject(WEB_SITE . '账号激活');
        $this->email->message(
            '您已经注册成为了' .WEB_SITE . '的用户，验证激活后即可立即使用.'
            .'<strong><a href="' . site_url('user/email_active/' . $data['id']) . '?code=' . md5($data['salt'] . $data['update_at']) . '">立即激活</a></strong>'
            .'<p>如果您没有注册，请忽略这封邮件</p>'
        );
        
        if ( ! $this->email->send())
        {
            return false;
        }else{
            return true;
        }
    }

    function email_active($id='') {
        $md5Salt = $this->input->get_post('code', TRUE);
        
        if(!empty($id)){
            
            $mix['field'] = 'id, name, salt, update_at';
            $mix['where'] = [
                'id' => $id,
                'status' => 0
            ];
            
            $this->load->model('Base');
            $this->Base->setTable($this->table);
            $row = $this->Base->selectOne($mix);
            if($row && md5($row['salt'] . $row['update_at'])== $md5Salt){
                //激活处理
                $ret = $this->Base->update([
                    'id'=>$id
                ],[
                    'status'=>1,
                    'update_at' => time()
                ]);
                if($ret){
                    $data = [
                        'code' => 0,
                        'title' => '激活成功',
                        'content' => '账号已经激活成功！ &nbsp;<a href="'.site_url('/user/user_login').'" class="alert-link">立即登录</a>'
                    ];
                }else{
                    $data = [
                        'code' => -1,
                        'title' => '激活失败',
                        'content' => '数据库更新失败'
                    ];
                }
            }else{
                $data = [
                    'code' => -1,
                    'title' => '激活失败',
                    'content' => '用户不存在或者已经激活'
                ];
            }
        }else{
            $data = [
                'code' => -1,
                'title' => '激活失败',
                'content' => '激活链接非法'
            ];
        }
        
        $this->render('message', $data);
    }
    
    function user_resend(){
        $dataStr = $this->session->userdata(self::SESSION_EMAIL_SEND);
        $data = json_decode($dataStr, true);
        
        if(!$dataStr || !$data){
            $this->render('message', [
                'code' => -1,
                'title' => '重新发送邮件失败',
                'content' => '参数获取失败错误'
            ]);
            return;
        }
        
        if($data['resendcnt'] > 3){
            if(time() - $data['sendtime'] > 5*60){
                $data['resendcnt'] = 1;
            }else{
                $this->render('message', [
                    'code' => -1,
                    'title' => '重新发送邮件失败',
                    'content' => '发送太频繁'
                ]);
                return;
            }
        }else{
            $data['resendcnt'] += 1;
        }
        
//        print_r($data);exit;
        if($this->sendemail($data)){
            $data['sendtime'] = time();
            $this->session->set_userdata(self::SESSION_EMAIL_SEND, json_encode($data));
            redirect('/user/user_reg_succ');
        }else{
            log_message('error', '激活邮件发送失败');
            $this->render('message', [
                'code' => -1,
                'title' => '重新发送邮件失败',
                'content' => '邮件发送失败'
            ]);
        }
    }
    
//    function to_update() {
//        $this->render(strtolower(__FUNCTION__));
//    }
}
