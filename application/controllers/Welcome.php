<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Home_Controller {
    
    //首页展示
    public function index()
    {
//      $this->load->view('index');
//        $this->render('index');
        redirect('/info');
    }
    
    
}
