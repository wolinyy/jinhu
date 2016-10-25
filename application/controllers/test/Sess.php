<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sess extends Test_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
    }
    
    public function index()
    {
        $this->benchmark->mark('code_start');

        echo '<pre>';
        print_r($this->session->all_userdata());
        
        print_r($_SESSION);
        
        print_r($this->session->flashdata());
        print_r(session_id());
        echo '</pre>';
        
        

        $this->benchmark->mark('code_end');

        echo $this->benchmark->elapsed_time('code_start', 'code_end');
    }

    public function set(){
        $this->session->set_userdata([
            'name' => 'wolin',
            'age' => 26
        ]);
        
        $_SESSION['email'] = 'qq.com';
        $this->session->set_flashdata('item', 'value');
        $this->session->set_flashdata('item1', 'value1');
        
    }

    public function get(){
        $name = $this->session->userdata('name');
        $age = $this->session->age;
        echo "name : $name, age : $age";
    }
    
    public function cl(){
       $this->session->sess_destroy();
    }
}
