<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Lang extends Test_Controller {
    
    public function index()
    {
        $this->lang->load('upload_lang', 'english');
        echo $this->lang->line('upload_userfile_not_set');
    }
}

?>
