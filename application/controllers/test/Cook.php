<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cook extends Test_Controller {

    public function __construct() {
        parent::__construct();
        
//        $this->load->helper('cookie');
    }
    
    public function index()
    {
        echo $this->input->cookie('wolin');
    }

    public function set(){
        
        $this->input->set_cookie('wolin', '321123', 60);
        echo 'set ok';
    }
}
