<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//用户管理
class Info extends Admin_Controller {

    const IMG_SESSION_PATH = 'img_info_path';
    
    const SESSION_INFO_CODE = 'info_code';
    
    public function __construct() {
        parent::__construct();
        $this->table = 'info';
        $this->table_view = 'info_view';
        
        $this->table_info_type = 'info_type';
        $this->table_info_type_view = 'info_type_view';
        
        $this->table_infoAttrs = 'infoAttrs';
        $this->table_infoAttrs_view = 'infoAttrs_view';
        
        $this->table_infoImgs = 'infoImgs';
    }
    
    private function my_get($data){
        $mix['where'] = $data;
        
        $this->load->model('Base');
        $this->Base->set_cache_save(false);
        $this->Base->setTable($this->table_view);
        $res['data'] = $this->Base->selectOne($mix);
        
        $this->Base->setTable($this->table_infoAttrs_view);
        $res['data']['attrs'] = $this->Base->selectAll([
            'where'=>[
               'info_id' => $data['id'] 
            ]]);
        $this->Base->setTable($this->table_infoImgs);
        $res['data']['imgs'] = $this->Base->selectAll([
            'where'=>[
               'info_id' => $data['id'] 
            ]]);
        
        if($res){
            $res['code'] = 0;
        }else{
            $res['code'] = -1;
        }
//        print_r($res);exit;
        return $res;
    }
    
    function show_form() {
        $data = array();
        $modal_show = $this->input->get('modal', true);
        
        if($modal_show){
            //对话框显示
            $this->show_form_data_handler($data);
            $this->load->view($this->class . '_form', $data);
        }else{
            //新页面展示
            $primaryKey = $this->input->get('id', true);
            if(!empty($primaryKey)){
                $data['id'] = $primaryKey;
                $jsonArr = $this->my_get($data);
                if("0" != $jsonArr['code'] || empty($jsonArr['data'])){
                    redirect('admin/'.$this->class);
                    return;
                }  else {
                    $data['form'] = $jsonArr['data'];
                    $this->show_form_data_handler($data);
                }
            }
            $this->render($this->class . '_form', $data);
        }
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
        $imgs = $data['imgs'];
        unset($data['imgs']);
        
        $dataBuild = $this->beforeSubmit($data, $this->pk);
        
        $attrs = [];
        $findme = '|';
        foreach ($dataBuild as $key => $value) {
            $tmparray = explode($findme,$key); 
            if(count($tmparray)>2){ 
                $attrs[$tmparray[1]]['value'] = $value;
                $attrs[$tmparray[1]]['type'] = $tmparray[2];
                unset($dataBuild[$key]);
            }
        }
//        $dataBuild['attrs'] = $attrs;
//        echo json_encode($dataBuild);
//        exit;
        
//        echo json_encode($dataBuild);
//        exit;
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        
        if(!isset($dataBuild[$this->pk])){
            $this->Base->TransBegin();
            $insert_id = $this->Base->insert($dataBuild);
            $this->Base->setTable($this->table_infoAttrs);
            $insertDatas = [];
            foreach ($attrs as $key => $value) {
                $insertDatas[] = [
                    'info_id'=>$insert_id,
                    'attr_id'=>$key,
                    'attr_value_float'=>(5 == $value['type']?$value['value']:''),
                    'attr_value_text'=>(5 != $value['type']?$value['value']:''),
                ];
            }
            $this->Base->insert_batch($insertDatas);
            
            //图片绑定信息id
            if(!empty($imgs) && is_array($imgs)){
                $this->Base->setTable($this->table_infoImgs);
                foreach ($imgs as $key => $value) {
                    $con = ['id'=>$value];
                    $updateData = [
                        'info_id'=>$insert_id,
                        'porder'=>$key,
                    ];
                    $this->Base->update($con, $updateData);
                }
            }
            $ret = $this->Base->TransCommit();
        }else{
            $this->Base->TransBegin();
            $ret = $this->Base->update([$this->pk=>$dataBuild[$this->pk]], $dataBuild);
            
            $this->Base->setTable($this->table_infoAttrs);
            foreach ($attrs as $key => $value) {
                $con = [];
                $con['info_id'] = $dataBuild[$this->pk];
                $con['attr_id'] = $key;
                
                $updateData = [
                    'info_id'=>$dataBuild[$this->pk],
                    'attr_id'=>$key,
                    'attr_value_float'=>(5 == $value['type']?$value['value']:''),
                    'attr_value_text'=>(5 != $value['type']?$value['value']:''),
                ];
                $this->Base->update($con, $updateData);
            }
            //图片绑定信息id
            if(!empty($imgs) && is_array($imgs)){
                $this->Base->setTable($this->table_infoImgs);
                foreach ($imgs as $key => $value) {
                    $con = ['id'=>$value];
                    $updateData = [
                        'info_id'=>$dataBuild[$this->pk],
                        'porder'=>$key,
                    ];
                    $this->Base->update($con, $updateData);
                }
            }
            $ret = $this->Base->TransCommit();
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
        
        $vcode = $this->session->userdata(self::SESSION_INFO_CODE);
        
        if($vcode == false || strtolower($vcode) !== strtolower($data['vCode'])){
            echo json_encode(array(
                'code'=>20,
                'msg'=>'验证码错误'.$vcode.'-'.$data['vCode']
            ));
            exit;
        }else{
            unset($data['vCode']);
            $this->session->unset_userdata(self::SESSION_INFO_CODE);
        }

        $uid = $this->session->userdata(self::SESSION_ADMIN_USERID);
        $currTime = time();
        $addData = [
            'uid' => $uid,
            'update_at' => $currTime,
            'status' => 0,
            'ip'=> $_SERVER['REMOTE_ADDR'],
        ];
        
        if(isset($data[$pk]) && empty($data[$pk])){
//            添加
            $addData['create_at'] = $currTime;
            unset($data[$pk]);
        }else{
//            编辑
        }
        $data = array_merge($addData, $data);
        return $data;
    }
    
    //硬删除
    public function del_hard() {
        
    }
    
    public function del() {
        
        $id = $this->input->post('id', TRUE);
        
        if(is_array($id) && !empty($id)){
            $idArr = $id;
        }else{
            $idArr[] = $id;
        }
        //软删除信息
        $this->load->model('Base');
        $this->Base->setTable($this->table);

        $data = [];
        foreach ($idArr as $key => $value) {
            $data[] = [
                'id'=>$value,
                'is_delete'=>1
            ];
        }
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        $rows = $this->Base->update_batch($data, 'id');
        
//        $rows = $this->Base->deleteByPk($id);
        
        //删除图片表
        
        //删除属性表
        
        
        $this->del_cache();

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
    
    // 返回选择分类的页面
    function sel_type() {
        $this->load->model('Base');
        $this->Base->setTable($this->table_info_type_view);
        $this->Base->set_cache_save(false);
        $mix['field'] = "name, id";
        $mix['where'] = ['level'=>1, 'status'=> 0];
        $type_one = $this->Base->selectAll($mix);
        
        $this->render('sel_type'
                , array(
                'type_one'=>  $type_one,
            )
        );
    }
    
    //验证码
    public function verify_code() {
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => '104',
            'img_height' => 34,
            'expiration' => 7200,
            'font_size' => 16,
            'font_path' => ASSERTS_DIR . 'font/VerifyCode.ttf',
            'colors'	=> array(
                'background'	=> array(185,230,236),
                'border'	=> array(222,244,254),
                'text'		=> array(51,122,183),
                'grid'		=> array(178,162,82)
            )
        );
        $cap = create_captcha($vals);
        #保存到session
        $this->session->set_userdata(self::SESSION_INFO_CODE, $cap);
    }
    
    public function imgUpload() {
        if(!empty($_FILES) && $_FILES['file']['error'] == 0){
            $this->load->helper('image');

            $field_name = "file";
            $resp = img_upload($field_name, $this->user_id, strtolower($this->class));

            if($resp['result']){
                deleteTmpImg($resp['msg']['full_path'], self::IMG_SESSION_PATH);
                $resp['msg'] = $resp['msg']['src'];
            }
        }else{
            $resp = array(
                'result' => false,
                'msg' => '没有上传图片'
            );
        }
        echo json_encode($resp);
    }
    
    public function imgCrop(){
        $img_path = $this->session->userdata(self::IMG_SESSION_PATH);
        if($img_path && file_exists($img_path)){

            $this->load->helper('image');
            
            $w = $this->input->get_post('width');
            $h = $this->input->get_post('height');
            $id = $this->input->get_post('id');
            $oldimg = $this->input->get_post('oldimg');
                
            $file_name = strrchr($img_path, '/');   # '/xxx.xx'
            $pos = stripos($file_name, '.');
            $file_name = getShortName(substr($file_name, 0, $pos)) . '_' . ceil($w) . 'x' . ceil($h) . substr($file_name, $pos);

            $upload_dir = UPLOAD_PATH;
            $imgpath = $this->user_id . '/' . $file_name;
            $newpath = $upload_dir . $imgpath;
            
            $resp = img_crop($img_path, $newpath);

            $this->session->set_userdata(self::IMG_SESSION_PATH, $img_path);
            
            if($resp['result']){
                //图片路径信息添加到数据库中
                $this->load->model('Base');
                $this->Base->setTable($this->table_infoImgs);
                if(!$id){
                    $insertData = [
                        'uid' => $this->user_id,
                        'path' => $imgpath,
                        'creaat_at' => time(),
                    ];
                    $insert_id = $this->Base->insert($insertData);

                    if($insert_id){
                        $resp['id'] = $insert_id;
                    }else{
                        $resp = array('result'=>false, 'msg'=>'数据库添加失败');
                        deleteTmpImg('', $newpath);
                    }
                }else{
                    $updateData = [
                        'path' => $imgpath,
                    ];
                    $ret = $this->Base->update(['id'=>$id], $updateData);
                    if($ret){
                        $resp['id'] = $id;
                        $delpath = $upload_dir . $this->user_id . strrchr($oldimg, '/');
                        if(file_exists($delpath)){
                            @unlink($delpath);
                        }
                    }else{
                        $resp = array('result'=>false, 'msg'=>'数据库更新失败');
                        deleteTmpImg('', $newpath);
                    }
                }
            }
        }else{
            $resp = array('result'=>false, 'msg'=>'操作时间太久，缓存图片已经删除，请重新上传。');
        }

        echo json_encode($resp);
    }
    
    public function imgDel() {
        $id = $this->input->get_post('id');
        $oldimg = $this->input->get_post('oldimg');
        if($id){
            $this->load->model('Base');
            $this->Base->setTable($this->table_infoImgs);
            $ret = $this->Base->deleteByPk($id);
            
            $delpath = UPLOAD_PATH . $this->user_id . strrchr($oldimg, '/');
            if(file_exists($delpath)){
                @unlink($delpath);
            }
        }
        
        $resp = array('result'=>true, 'msg'=>'');
        echo json_encode($resp);
    }
    
    function batch_edit_review() {
        $idArr = $this->input->get_post('id');
        $status = $this->input->get_post('status');
        
        $data = [];
        foreach ($idArr as $key => $value) {
            $data[] = [
                'id'=>$value,
                'status'=>$status
            ];
        }
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);
        $ret = $this->Base->update_batch($data, 'id');
        
        $this->del_cache();
        
        $resp = array('result'=>true, 'msg'=>'');
        echo json_encode($resp);
    }
    
    private function del_cache() {
        //相关缓存删除
        $this->load->model('Base');
        $this->Base->setTable($this->table_info_type_view);
        $this->Base->DeleteCache();
    }
}
