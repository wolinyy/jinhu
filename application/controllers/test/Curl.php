<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl extends Test_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
    }
    
    public function login(){
        $url = 'http://agent.wl.cn/test/curl/test';
        $url = 'http://10.0.2.120:58083/dunyun_webservice/auth';
        $post_form = array(
            'username' => 'admin',
            'password' => '12345678'
        );
        echo $this->curl($url, $post_form);
    }
    
    public function test(){
        print_r($_REQUEST);
        exit;
        $post_form = array(
            'username' => 'admin',
            'password' => '12345678'
        );
        echo serialize($post_form);
    }
    
    public function logout(){
        $res = $this->post_url('logout');
        echo '-' . $res . '-';
    }
}
