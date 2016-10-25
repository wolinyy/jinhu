<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Loader
 *
 * @author wolin
 */
class MY_Loader extends CI_Loader {
    
    protected $_test = 'test/';
    
    #前台视图目录
    public function switch_themes_home() {
        $this->_ci_view_paths = [FCPATH . THEMES_DIR . HOME_DIR => true];
    }

    #后台视图目录
    public function switch_themes_admin() {
        $this->_ci_view_paths = [FCPATH . THEMES_DIR . ADMIN_DIR => true];
    }
    
    #测试视图目录
    public function switch_themes_test() {
        $this->_ci_view_paths = [FCPATH . THEMES_DIR . $this->_test => true];
    }
}

