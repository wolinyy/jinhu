<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//用户管理
class Info_type extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->table = 'info_type';
        $this->table_view = 'info_type_view';
        
    }
    
    //后台首页展示
    public function index()
    {
        $this->render(strtolower($this->class), ['role_id'=>1]);
    }
    
    function get() {
        $mix['like'] = $this->input->post('filter[like]', true);
        $mix['where'] = $this->input->post('filter[where]', true);
        $order = $this->input->post('order', true);
        $mix['order_by'] = [$order['sortkey'] => ($order['sort']==1)?'asc':'desc'];
        $mix['pageNow'] = $this->input->post('pagination[page_now]', true);
        $mix['pageSize'] = $this->input->post('pagination[page_size]', true);
                
//        print_r($mix);exit;
        
        $this->load->model('Base');
        $this->Base->setTable($this->table_view);
        $this->Base->set_cache_save(false);
        $res = $this->Base->selectPage($mix);
        
        if($res){
            $res['code'] = 0;
        }else{
            $res['code'] = -1;
        }
        echo json_encode($res);
    }
    
    public function submit() {
        $data = $this->input->post('data', TRUE);
        $dataBuild = $this->beforeSubmit($data, $this->pk);
        
//        echo json_encode($dataBuild);
//        exit;
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        
        if(!isset($dataBuild[$this->pk])){
            $ret = $this->Base->insert($dataBuild);
        }else{
            $ret = $this->Base->update([$this->pk=>$dataBuild[$this->pk]], $dataBuild);
        }
        
        if($ret){
            echo json_encode(array('code'=>0, 'msg'=>'', 'id'=>$ret));
            exit;
        }else{
            echo json_encode(array('code'=>-1, 'msg'=>'操作失败'));
            exit;
        }
    }
    
    public function beforeSubmit($data, $pk) {
        if(isset($data[$pk]) && empty($data[$pk])){
//            添加
            unset($data[$pk]);
        }else{
//            编辑
        }
        
        return $data;
    }
    
    public function del() {
        
        $id = $this->input->post('id', TRUE);
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);

        $rows = $this->Base->deleteByPk($id);
        
        echo json_encode(array(
            'code'=>0,
            'msg'=>'',
            'rows'=> $rows
        ));
        exit;
    }
    
    public function batch_del() {
        $this->del();
    }
    
    function getName() {
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "name, id";
        $mix['where'] = 'level <= 1';
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    function getT1Name() {
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "name, id";
        $mix['where'] = ['level'=>1, 'status'=> 0];
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    function getT2Name($type_id='') {
        
        if(isset($type_id) && !is_int($type_id)){
            $this->load->model('Base');
            $this->Base->setTable($this->table);
            //print_r($this->Base->getTable());
            $this->Base->set_cache_save(false);
            $mix['field'] = "name text, id";
            $mix['where'] = ['level'=>2, 'pid'=>$type_id, 'status'=> 0];
            $res['list'] = $this->Base->selectAll($mix);
        }
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
}
