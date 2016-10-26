<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//用户管理
class Info extends Home_Controller {
    
    const IMG_SESSION_PATH = 'home_img_info_path';
    
    const SESSION_INFO_ADD_CODE = 'home_info_code';
    const SESSION_INFO_EDIT_CODE = 'home_info_edit_code';
    
    const COOKIE_UNLOGIN_ADD_TODAY = 'cookie_unlogin_add_today';
    const COOKIE_UNLOGIN_ADD_DATE = 'cookie_unlogin_add_date';
    
    public function __construct() {
        parent::__construct();
        $this->table = 'info';
        $this->table_view = 'info_view';
        $this->table_info_type = 'info_type';
        $this->table_info_type_view = 'info_type_view';
        
        $this->table_info_attr = 'info_attr';
        $this->table_info_attr_view = 'info_attr_view';
        
        $this->table_infoAttrs = 'infoAttrs';
        $this->table_infoAttrs_view = 'infoAttrs_view';
        
        $this->table_region = 'region_jh';
        $this->table_region_view = 'region_jh_view';
        
        $this->table_infoImgs = 'infoImgs';
        
        $this->load->helper('common');
    }

    //展示分类信息页面
    function index() {
        
        //获取分类类型
        $this->load->model('Base');
//        $this->Base->set_cache_save(false);
        $this->Base->setTable($this->table_info_type_view);
        $data['infoType'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname, icon',
        ]);
        
        $this->Base->setTable($this->table_info_type_view);
        $data['infoRegion'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';exit;

        //获取最新的$limitCnt条信息
        $limitCnt = 30;
        $data['limitCnt'] = $limitCnt;
        $this->Base->setTable($this->table_view);
        $this->Base->set_cache_save(false);
        $data['infoNew'] = $this->Base->selectAll([
            'where' => '(status = 1 or status = 2) and is_delete = 0',
//            'where' => 'status = 1 or status = 2',
            'order_by'=>'update_at desc',
            'limit' => $limitCnt,
            'field'=>'id, title, content, update_at, t1_name, t2_name, r1_name, r2_name, addr_two_id, type_one_id, type_two_id',
        ]);
        
        if($data['infoNew'] && !empty($data['infoNew'])){
            //获取信息对应的图片
            $infoIds = [];
            foreach ($data['infoNew'] as $key => $value) {
                $infoIds[] = $value['id'];
            }
            $this->Base->setTable($this->table_infoImgs);
            $infoNewImg = $this->Base->selectAll([
                'where' => 'info_id in (' . implode(',', $infoIds) . ')',
                'field'=>'id, info_id, path',
                'order_by'=>'porder asc',
            ]);

            foreach ($infoNewImg as $k1 => $v1) {
                foreach ($data['infoNew'] as $k2 => $v2) {
                    if($v1['info_id'] == $v2['id']){
                        $data['infoNew'][$k2]['imgs'][] = $v1;
                        break;
                    }
                }
            }
        }
        
//        echo '<pre>';
////        print_r($data['infoNewImg']);
//        print_r($data['infoNew']);
//        echo '</pre>';exit;
        $this->render('index', $data);
    }
    
    function info_add() {
        //获取分类，获取地域
        $this->load->model('Base');
//        $this->Base->set_cache_save(false);
        $this->Base->setTable($this->table_info_type_view);
        $data['infoType'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
        $this->Base->setTable($this->table_region_view);
        $data['infoRegion'] = $this->Base->selectAll([
            'where' => 'type=2 and pid!=0',
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
        if($this->user_name){
            $data['_username'] = $this->user_name;
        }
        
        $this->render(strtolower(__FUNCTION__), $data);
    }
    
    //非登录用户 添加信息需要输入验证码 防止灌水机灌水
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
        $this->session->set_userdata(self::SESSION_INFO_ADD_CODE, $cap);
    }
    
    //非登录用户 编辑信息需要输入验证码 防止灌水机灌水
    public function edit_verify_code() {
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
        $this->session->set_userdata(self::SESSION_INFO_EDIT_CODE, $cap);
    }
    
    function getAttr($id) {
        $this->load->model('Base');
        $this->Base->setTable($this->table_info_attr);
        //print_r($this->Base->getTable());
        $this->Base->set_cache_save(false);
        $mix['field'] = "name, id, type, value";
        $mix['where'] = 'type2_id = ' . $id;
        $res['list'] = $this->Base->selectAll($mix);
        
        $res['code'] = 0;
        echo json_encode($res);
        exit;
    }
    
    function add_code_check() {
        $vCode = $this->input->post('vCode', true);
        $sessCode = $this->session->userdata(self::SESSION_INFO_ADD_CODE);
        
        if($vCode == false || strtolower($vCode) !== strtolower($sessCode)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    function edit_code_check() {
        $vCode = $this->input->post('vCode', true);
        $sessCode = $this->session->userdata(self::SESSION_INFO_EDIT_CODE);
        
        if($vCode == false || strtolower($vCode) !== strtolower($sessCode)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    
    public function imgUpload() {
        //非登录用户禁止处理图片
        if(!$this->user_name){
            $resp = array(
                'result' => false,
                'msg' => '非登录用户禁止上传图片'
            );
            echo json_encode($resp);
            return;
        }
        
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
        //非登录用户禁止处理图片
        if(!$this->user_name){
            $resp = array(
                'result' => false,
                'msg' => '非登录用户禁止上传图片'
            );
            echo json_encode($resp);
            return;
        }
        
        $img_path = $this->session->userdata(self::IMG_SESSION_PATH);
        if($img_path && file_exists($img_path)){

            $this->load->helper('image');
            
            $w = $this->input->get_post('width');
            $h = $this->input->get_post('height');
            $id = $this->input->get_post('id');
            $info_id = $this->input->get_post('info_id');
            if(empty($info_id)) $info_id = 0;
            
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
                        'info_id' => $info_id
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
                        'info_id' => $info_id
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
        //非登录用户禁止处理图片
        if(!$this->user_name){
            $resp = array(
                'result' => false,
                'msg' => '非登录用户禁止上传图片'
            );
            echo json_encode($resp);
            return;
        }
        
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
    
    public function submit() {
        
        //每天限制条数判断

        $currTime = time();
        $begin_time = strtotime(date('Y-m-d', $currTime));
        $end_time = strtotime(date('Y-m-d H:i:s', $currTime));

        if($this->user_id){
            //登录用户 一天只能发送2条
            $this->load->model('Base');
            $this->Base->setTable($this->table);
            
            $where = 'uid = ' . $this->user_id . ' and create_at between ' . $begin_time . ' and ' . $end_time; 
            $cnt = $this->Base->selectCount($where);
            if($cnt >= 2){
                echo json_encode(array('code'=>-1, 'msg'=>'今日添加信息已经达到上限'));
                exit;
            }
        }else{
            //未登录用户 一天只能发送一条 根据 session ip判断
            $unlogin_add_today = $this->input->cookie(self::COOKIE_UNLOGIN_ADD_TODAY, TRUE);
            $unlogin_add_date = $this->input->cookie(self::COOKIE_UNLOGIN_ADD_DATE, TRUE);
            if(1==$unlogin_add_today && $unlogin_add_date==date('Y-m-d', time())){
                echo json_encode(array('code'=>-1, 'msg'=>'今日添加信息已经达到上限'));
                exit;
            }
            
            $this->load->model('Base');
            $this->Base->setTable($this->table);
            
            $where = 'ip="' . $_SERVER['REMOTE_ADDR'] . '" and uid=0 and create_at between ' . $begin_time . ' and ' . $end_time; 
            $cnt = $this->Base->selectCount($where);
            if($cnt >= 1){
                echo json_encode(array('code'=>-1, 'msg'=>'今日添加信息已经达到上限'));
                exit;
            }
        }
        
        $data = $this->input->post('data', TRUE);
        if(isset($data['imgs']) && !empty($data['imgs'])){
            $imgs = $data['imgs'];
            unset($data['imgs']);
        }
        
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
            if(!empty($attrs)){
                foreach ($attrs as $key => $value) {
                    $insertDatas[] = [
                        'info_id'=>$insert_id,
                        'attr_id'=>$key,
                        'attr_value_float'=>(5 == $value['type']?$value['value']:''),
                        'attr_value_text'=>(5 != $value['type']?$value['value']:''),
                    ];
                }
                $this->Base->insert_batch($insertDatas);
            }
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
            //修改后改为未审核
            $dataBuild['status'] = 0;
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
            if( ! $this->user_id){
                $cookie = array(
                    'name'   => self::COOKIE_UNLOGIN_ADD_TODAY,
                    'value'  => 1,
                    'expire' => '86500',
                    'path'   => '/',
                    'prefix' => 'myprefix_',
                    'secure' => TRUE
                );

                $this->input->set_cookie($cookie);
                $cookie['name'] = self::COOKIE_UNLOGIN_ADD_DATE;
                $cookie['value'] = date('Y-m-d', time());
                $this->input->set_cookie($cookie);
            }
            echo json_encode(array('code'=>0, 'msg'=>'', 'id'=>$ret));
            exit;
        }else{
            echo json_encode(array('code'=>-1, 'msg'=>'操作失败'));
            exit;
        }
    }
    
    public function beforeSubmit($data, $pk) {
        
        $sess_name = self::SESSION_INFO_ADD_CODE;
        if(isset($data[$this->pk])){
            $sess_name = self::SESSION_INFO_EDIT_CODE;
        }
        
        $vcode = $this->session->userdata($sess_name);
        
        if($vcode == false || strtolower($vcode) !== strtolower($data['vCode'])){
            echo json_encode(array(
                'code'=>20,
                'msg'=>'验证码错误'.$vcode.'-'.$data['vCode']
            ));
            exit;
        }else{
            unset($data['vCode']);
            $this->session->unset_userdata($sess_name);
        }

        $currTime = time();
        $addData = [
            'update_at' => $currTime,
            'status' => 0,
            'ip'=> $_SERVER['REMOTE_ADDR'],
        ];
        if($this->user_id){
            $addData['uid'] = $this->user_id;
        }
        
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
    
    function details($id='') {
        if(!empty($id)){
            $data['id'] = $id;
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
//            print_r($res);exit;
//            return $res;
            
            $this->load->helper('common');
            $this->render('info_details', $res['data']);
        }else{
            redirect('/');
        }
    }
    
    function info_list(){
        //获取分类类型
        $this->load->model('Base');
//        $this->Base->set_cache_save(false);
        $this->Base->setTable($this->table_info_type_view);
        $data['infoType'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname, icon',
        ]);
        
        $this->Base->setTable($this->table_info_type_view);
        $data['infoRegion'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';exit;

        //获取最新的$limitCnt条信息
        $limitCnt = 30;
        $data['limitCnt'] = $limitCnt;
        $this->Base->setTable($this->table_view);
        $this->Base->set_cache_save(false);
        $data['infoNew'] = $this->Base->selectAll([
            'where' => '(status = 1 or status = 2) and is_delete = 0',
//            'where' => 'status = 1 or status = 2',
            'order_by'=>'update_at desc',
            'limit' => $limitCnt,
            'field'=>'id, title, content, update_at, t1_name, t2_name, r1_name, r2_name, addr_two_id',
        ]);
        
        if($data['infoNew'] && !empty($data['infoNew'])){
            //获取信息对应的图片
            $infoIds = [];
            foreach ($data['infoNew'] as $key => $value) {
                $infoIds[] = $value['id'];
            }
            $this->Base->setTable($this->table_infoImgs);
            $data['infoNewImg'] = $this->Base->selectAll([
                'where' => 'info_id in (' . implode(',', $infoIds) . ')',
                'field'=>'id, info_id, path',
                'order_by'=>'porder asc',
            ]);

            foreach ($data['infoNewImg'] as $k1 => $v1) {
                foreach ($data['infoNew'] as $k2 => $v2) {
                    if($v1['info_id'] == $v2['id']){
                        $data['infoNew'][$k2]['imgs'][] = $v1;
                        break;
                    }
                }
            }
        }
        
//        echo '<pre>';
////        print_r($data['infoNewImg']);
//        print_r($data['infoNew']);
//        echo '</pre>';exit;
        $this->render(strtolower(__FUNCTION__), $data);
    }
    
    function category($type_one='', $type_two='') {
        $type_id = $type_one;
        if(empty($type_one)){
            redirect('/');
            return;
        }
        
        $data['attr'] = $this->input->get_post('attr', true);
        $pageNow = $this->input->get_post('pageNow', true);
        $region_pid = $this->input->get_post('rpid', true);
        $region_sid = $this->input->get_post('rsid', true);
        
        $this->load->model('Base');
        
        $subWhere = ' and type_one_id = ' . $type_one;
        if(empty($type_two)){
            //查询主分类的所有子分类
            $this->Base->setTable($this->table_info_type_view);
            $data['infoSubType'] = $this->Base->selectAll([
                'where' => [
                    'level' => 2,
                    'pid' => $type_one
                ],
                'order_by'=>'order asc',
                'field'=>'id, name, pid, pname',
            ]);
        }else{
            //查询子分类的所有属性
            $this->Base->setTable($this->table_info_attr_view);
            $data['infoTypeAttr'] = $this->Base->selectAll([
                'where' => [
                    'type2_id' => $type_two,
                    'type' => 2
                ],
                'order_by'=>'order asc',
                'field'=>'id, name, type, value',   //, c1_name, c2_name
            ]);
            
            $subWhere .= ' and type_two_id = ' . $type_two;
            $type_id = $type_two;
        }
 
        //查询一级地域
        $this->Base->setTable($this->table_region);
        $data['region_one'] = $this->Base->selectAll([
            'where' => [
                'type' => 1,
            ],
            'field'=>'id, name',
        ]);
        
        //根据条件查询二级地域
        if(!empty($region_pid)){
            $data['region_two'] = $this->Base->selectAll([
                'where' => [
                    'pid' => $region_pid,
                ],
                'field'=>'id, name',
            ]);
            $data['region_pid'] = $region_pid;
        }
        if(!empty($region_sid)){
            $data['region_sid'] = $region_sid;
        }
        
//        print_r($data);exit;
        
        $this->Base->setTable($this->table_info_type_view);
        $data['typeInfo'] = $this->Base->selectOne([
            'where' => [
                'id' => $type_id,
                'status' => 0
            ],
            'field'=>'id, name, pid, pname, level',
        ]);
                
        $para['sub_where'] = $subWhere;
        $para['pageNow'] = $pageNow?$pageNow:1;
        $para['pageSize'] = 10;
        $para['attr'] = $data['attr'];
        $para['region_pid'] = $region_pid;
        $para['region_sid'] = $region_sid;
        
        $this->load->model('Info_model');
        $tmp = $this->Info_model->getInfoWithCategory($para);
        
//        print_r($tmp);exit;
        
        $data['infoNew'] = $tmp['data'];
        $data['page'] = $tmp['pageinfo'];
        
        if($data['infoNew'] && !empty($data['infoNew'])){
            //获取信息对应的图片
            $infoIds = [];
            foreach ($data['infoNew'] as $key => $value) {
                $infoIds[] = $value['id'];
            }
            $this->Base->setTable($this->table_infoImgs);
            $infoNewImg = $this->Base->selectAll([
                'where' => 'info_id in (' . implode(',', $infoIds) . ')',
                'field'=>'id, info_id, path',
                'order_by'=>'porder asc',
            ]);

            foreach ($infoNewImg as $k1 => $v1) {
                foreach ($data['infoNew'] as $k2 => $v2) {
                    if($v1['info_id'] == $v2['id']){
                        $data['infoNew'][$k2]['imgs'][] = $v1;
                        break;
                    }
                }
            }
        }
        
        
//        print_r($data);exit;
        $this->load->helper('common');
        $this->render(strtolower(__FUNCTION__), $data);
    }
    
    function search() {
        $data['key'] = $this->input->get_post('key', true);
        $pageNow = $this->input->get_post('pageNow', true);
        
        $data['type_one_id'] = $this->input->get_post('type_one_id', true);
        $data['type_two_id'] = $this->input->get_post('type_two_id', true);
        $data['addr_one_id'] = $this->input->get_post('addr_one_id', true);
        $data['addr_two_id'] = $this->input->get_post('addr_two_id', true);
        if(empty($data['key'])){
            $data['key'] = $this->input->get_post('title', true);
        }
        
        $and_where = '';
        if($data['key']){
            $and_where .= ' and title like "%' . $data['key'] . '%"';
        }
        if($data['type_one_id']){
            $and_where .= ' and type_one_id = ' . $data['type_one_id'];
        }
        if($data['type_two_id']){
            $and_where .= ' and type_two_id = ' . $data['type_two_id'];
        }
        if($data['addr_one_id']){
            $and_where .= ' and addr_one_id = ' . $data['addr_one_id'];
        }
        if($data['addr_two_id']){
            $and_where .= ' and addr_two_id = ' . $data['addr_two_id'];
        }
        
        $this->load->model('Base');
        
        $para['pageNow'] = $pageNow?$pageNow:1;
        $para['pageSize'] = 10;
        
        $this->Base->setTable($this->table_view);
        $this->Base->set_cache_save(false);
        $tmp = $this->Base->selectPage([
            'where' => '(status = 1 or status = 2) and is_delete = 0 ' . $and_where,
//            'where' => 'status = 1 or status = 2',
            'order_by'=>'update_at desc',
            'field'=>'id, title, content, update_at, t1_name, t2_name, r1_name, r2_name, addr_two_id, type_one_id, type_two_id',
            'pageNow' => $para['pageNow'],
            'pageSize' => $para['pageSize']
        ]);
        
        $data['infoNew'] = $tmp['data'];
        $data['page'] = $tmp['pageinfo'];
        
//        print_r($data);exit;

        if($data['infoNew'] && !empty($data['infoNew'])){
            //获取信息对应的图片
            $infoIds = [];
            foreach ($data['infoNew'] as $key => $value) {
                $infoIds[] = $value['id'];
            }
            $this->Base->setTable($this->table_infoImgs);
            $data['infoNewImg'] = $this->Base->selectAll([
                'where' => 'info_id in (' . implode(',', $infoIds) . ')',
                'field'=>'id, info_id, path',
                'order_by'=>'porder asc',
            ]);

            foreach ($data['infoNewImg'] as $k1 => $v1) {
                foreach ($data['infoNew'] as $k2 => $v2) {
                    if($v1['info_id'] == $v2['id']){
                        $data['infoNew'][$k2]['imgs'][] = $v1;
                        break;
                    }
                }
            }
        }
        
        //获取分类，获取地域
        $this->load->model('Base');
//        $this->Base->set_cache_save(false);
        $this->Base->setTable($this->table_info_type_view);
        $data['infoType'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
        $this->Base->setTable($this->table_region_view);
        $data['infoRegion'] = $this->Base->selectAll([
            'where' => 'type=2 and pid!=0',
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
//        print_r($data);exit;
        $this->render(strtolower(__FUNCTION__), $data);
    }
    
    function mng() {
        
        if(!$this->user_id){
            redirect('/info');
            exit;
        }
        
        $pageNow = $this->input->get_post('pageNow', true);
        $pageSize = $this->input->get_post('pageSize', true);
        
        $this->load->model('Base');
        
        $para['pageNow'] = $pageNow?$pageNow:1;
        $para['pageSize'] = $pageSize?$pageSize:10;
        
        $this->Base->setTable($this->table_view);
        $this->Base->set_cache_save(false);
        $tmp = $this->Base->selectPage([
            'where' => ' is_delete = 0 and uid = ' . $this->user_id,
            #'where' => ' is_delete = 0 ',
            'order_by'=>'update_at desc',
//            'field'=>'id, title, content, update_at, t1_name, t2_name, r1_name, r2_name, addr_two_id, type_one_id, type_two_id, status',
            'pageNow' => $para['pageNow'],
            'pageSize' => $para['pageSize']
        ]);
        
        $data['infoNew'] = $tmp['data'];
        $data['page'] = $tmp['pageinfo'];
        
        $data['status'] = [
            '0' => '未审核',
            '1' => '受信用户',
            '2' => '审核通过',
            '3' => '审核失败',
            '4' => '被人举报'
        ];
//        print_r($data);exit;

        if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
            $data['code'] = 0;
            echo json_encode($data);
            exit;
        }
        $this->render(strtolower(__FUNCTION__), $data);
    }
    
    function info_del(){
        
        if(!$this->user_id){
            echo json_encode(array(
                'code'=>-1,
                'msg'=>'非登陆用户，禁止操作',
            ));
            exit;
        }
        
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
    
    function info_uptime(){
        
        if(!$this->user_id){
            echo json_encode(array(
                'code'=>-1,
                'msg'=>'非登陆用户，禁止操作',
            ));
            exit;
        }
        
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
        $currTime = time();
        foreach ($idArr as $key => $value) {
            $data[] = [
                'id'=>$value,
                'update_at'=>$currTime
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
    
    function info_edit($id) {
        
        if(!empty($id)){
            $data['id'] = $id;
            $jsonArr = $this->my_get($data);
//            print_r($jsonArr);exit;
            if("0" != $jsonArr['code'] || empty($jsonArr['data'])){
                redirect('info/mng');
                return;
            }  else {
                $data['form'] = $jsonArr['data'];
                $this->show_form_data_handler($data);
            }
        }
        
//        print_r($data);exit;
        
        $this->render(strtolower(__FUNCTION__), $data);

    }
    
    private function my_get($data){
        $mix['where'] = $data;
        
        $this->load->model('Base');
        
        $this->Base->set_cache_save(false);
        $this->Base->setTable($this->table_view);
        $res['data'] = $this->Base->selectOne($mix);
        
        if(empty($res['data'])){
            $res['code'] = -1;
            return $res;
        }
        
        $this->Base->setTable($this->table_info_type_view);
        $res['data']['infoType'] = $this->Base->selectAll([
            'where' => [
                'level' => 2
            ],
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
        $this->Base->setTable($this->table_region_view);
        $res['data']['infoRegion'] = $this->Base->selectAll([
            'where' => 'type=2 and pid!=0',
            'order_by'=>'pid asc, order asc',
            'field'=>'id, name, pid, pname',
        ]);
        
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
    
    function show_form_data_handler(&$data) {
        return $data;
    }
    
    function test() {
        
        print_r($_SERVER);exit;
        
        $currTime = time();
        $begin_time = strtotime(date('Y-m-d', $currTime));
        $end_time = strtotime(date('Y-m-d H:i:s', $currTime));
        
        $this->load->model('Base');
        $this->Base->setTable($this->table);

        $where = 'uid=0'; 
        $cnt = $this->Base->selectCount($where);
        
        echo $cnt;
//        
//        $this->load->model('Info_model');
//        $data = $this->Info_model->getInfoWithCategory();
//        
//        print_r($data);exit;
    }
    
    private function del_cache() {
        //相关缓存删除
        $this->load->model('Base');
        $this->Base->setTable($this->table_info_type_view);
        $this->Base->DeleteCache();
    }
}
