<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Help extends Test_Controller {
    
    public function captcha()
    {
        //echo 'asd';
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => '104',
            'img_height' => 34,
            'expiration' => 7200,
            'font_size' => 16,
            'font_path' => ASSERTS_DIR . 'font/VerifyCode.ttf',
            'colors'	=> array(
//                'background'	=> array(191,228,238),
                'background'	=> array(185,230,236),
                'border'	=> array(0,0,0),
                'text'		=> array(51,122,183),
                'text'		=> array(0,161,233),
                'grid'          => array(255,180,66),
                'grid'		=> array(178,162,82),
            )
        );
        $cap = create_captcha($vals);
        //print_r($cap);
    }
}

?>
