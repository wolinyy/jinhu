<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Encrypt extends Test_Controller {
    
    public function index(){
        $this->load->library('encrypt');
        $msg = 'My secret message';
        echo $encrypted_string = $this->encrypt->encode($msg);
        echo '<br />';
        echo $plaintext_string = $this->encrypt->decode($encrypted_string);
    }
}

?>
