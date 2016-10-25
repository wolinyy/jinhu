<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Db extends Test_Controller {
    
    function insert() {
        $this->load->model('Permission');
        $this->Permission->TransBegin();
        $row = $this->Permission->insert([
            'id'=>101,
            'name'=>'分组修改',
            'type'=>1
        ]);
        print_r($row);
        $row = $this->Permission->insert([
            
           'name'=>'分组删除',
            'type'=>1
        ]);
        print_r($row);
        $res = $this->Permission->TransCommit();
        if($res)
            echo "ok<br/>";
        else
            echo "failed<br/>";
        
    }
    
    function select(){
        $this->load->model('Permission');
        $count = $this->Permission->selectCount('name like "%删除%"');
        $row1 = $this->Permission->selectOne('name like "%删除%"');
        #$row1 = $this->Permission->selectOne();
        $row2 = $this->Permission->selectByPk(2);
        echo '<pre>';
        print_r($count);
        print_r($row1);
        print_r($row2);
        echo '</pre>';
    }
    
    function proj_test() {
        $this->load->model('Base');
        $this->Base->setTable('project');
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['pageNow'] = "3";
        $mix['pageSize'] = "3";
        $res = $this->Base->selectPage($mix);
        
        print_r($res);
        exit;
    }
    
    function proj() {
        $this->load->model('Base');
        $this->Base->setTable('project');
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['where'] = $this->input->post('filter[where]', true);
        $mix['like'] = $this->input->post('filter[like]', true);
        $mix['pageNow'] = $this->input->post('pagination[page_now]', true);
        $mix['pageSize'] = $this->input->post('pagination[page_size]', true);
        $mix['order_by'] = $this->input->post('order', true);
//        print_r($mix);
        $res = $this->Base->selectPage($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    function user() {
        $this->load->model('Base');
        $this->Base->setTable('user');
        
        $this->Base->set_cache_save(false);
        
        $mix['field'] = 'name,passwd,salt';
        $mix['where'] = ['name'=>'wolin'];
        $res = $this->Base->selectOne($mix);
        
        print_r($res);
        
        echo __FUNCTION__;
    }
    
    function user_add() {
        $this->load->model('Base');
        $this->Base->setTable('user');
        
        $salt = crc32(time());
        $insert_data = [
            'name' => 'wolin',
            'passwd' => md5($salt . '123456'),
            'salt' => $salt,
        ];
        
        for($i=0;$i<100;$i++){
            $insert_data['name'] = 'wolin' . $i;
            $ret = $this->Base->insert($insert_data);
        }
        
        print_r($ret);
    }
}

?>
