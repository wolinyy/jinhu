<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function create_dir($path){
    if (!file_exists($path)){
            create_dir(dirname($path));
            if (!file_exists($path)){
                    mkdir($path, 0777);
            }
    }
}

function deleteTmpImg($path = '', $sess_name = 'img_path'){
    $ci = &get_instance();
    $ci->load->library('session');
    
    #删除上一次的临时图片，记录本次的临时图片
    $img_path = $ci->session->userdata($sess_name);
    if($img_path && file_exists($img_path)){
        $ci->session->unset_userdata($sess_name);
        @unlink($img_path);
    }
    if(!empty($path))
        $ci->session->set_userdata($sess_name, $path);
}

function img_upload($field_name, $uid, $dir = '', $resize = true){
    $ci = &get_instance();
    
    
    /**
     * 临时文件计划任务删除
     */
    
    $ci->load->helper('file');
    $file_info = get_file_info(UPLOAD_PATH . IMG_TMP_UPLOAD_PATH, array('date'));
    if($file_info != false && date("Y-m-d", $file_info['date']) != date("Y-m-d")){
        #删除该目录
        delete_files(UPLOAD_PATH . IMG_TMP_UPLOAD_PATH, TRUE);
    }
    
    $path = IMG_TMP_UPLOAD_PATH . $uid . '/' .$dir .'/';
    $config['upload_path'] = UPLOAD_PATH . $path;
    $config['encrypt_name'] = true;
    $config['allowed_types'] = 'gif|jpg|jpeg|png|jpe';//gif不支持裁剪，去除 gif|
    $config['max_size'] = '2097152';//2M

    $ci->load->library('upload', $config);

    create_dir($config['upload_path']);
    if ( ! $ci->upload->do_upload($field_name)) {
        $resp = array(
            'result' => false,
            'msg' => $ci->upload->display_errors('', '')
        );
    } else {
        $upload_data = $ci->upload->data();
        $upload_data['src'] = IMG_URL . $path . $upload_data['file_name'];
        $resp = array(
            'result' => true,
            'msg' => $upload_data
        );
        
        if($resize){
            $img_resize = img_resize($upload_data);
            $resp = $img_resize;
        }
    }
    
    return $resp;
}

function img_resize($upload_data){
    $ci = &get_instance();
    
    #图片缩放
    $max_width = 800;
    $flag = false;
    
    if($upload_data['image_width'] >= $max_width){
        $upload_data['image_height'] = ceil($upload_data['image_height'] * $max_width / $upload_data['image_width']);
        $upload_data['image_width'] = $max_width;
        $flag = true;
    }
    
    $resp = array(
        'result' => true,
        'msg' => $upload_data
    );

    if($flag){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $upload_data['full_path'];
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $upload_data['image_width'];
        $config['height'] = $upload_data['image_height'];

        $ci->load->library('image_lib', $config); 
        if( ! $ci->image_lib->resize()){
            $resp = array(
                'result' => false,
                'msg' => $ci->image_lib->display_errors('', '')
            );
        }
    }
    
    return $resp;
}

function img_crop($src_path, $dst_path = ''){
    $ci = &get_instance();
    
    $resp = array(
        'result' => true,
        'msg' => IMG_URL . strstr($src_path, '/tmp')
    );
    
    $config['image_library'] = 'gd2';
    $config['source_image'] = $src_path;
    $config['maintain_ratio'] = false;
            
    $config['x_axis'] = $ci->input->get_post('x');
    $config['y_axis'] = $ci->input->get_post('y');
    $config['width'] = $ci->input->get_post('width');
    $config['height'] = $ci->input->get_post('height');
    
    $ci->load->library('image_lib', $config); 
    #如果是gif就不裁剪
    if(strrchr($src_path, '.')!='.gif' && ! $ci->image_lib->crop()){
        $resp = array(
            'result' => false,
            'msg' => $ci->image_lib->display_errors('', '')
        );
    }else{
	shuiyin($src_path);
        if(!empty($dst_path)){
            create_dir(dirname($dst_path));
            rename($src_path, $dst_path);
            $tmpArr = explode("/img/", $dst_path);
            $resp['msg'] = IMG_URL . $tmpArr[1];
        }
    }
    
    return $resp;
}

function shuiyin($src_path) {
    $ci = &get_instance();
    
    $ci->load->library('image_lib');

    chmod($src_path, 0777);
    $config['source_image'] = $src_path;
    $config['wm_text'] = WEB_URL;
    $config['wm_type'] = 'text';
    $config['wm_font_path'] = ASSERTS_DIR . 'font/VerifyCode.ttf';
    $config['wm_font_size'] = '24';
    $config['wm_font_color'] = 'ffffff';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'right';
    $config['wm_hor_offset'] = '-40';
    $config['wm_vrt_offset'] = '-20';
    $config['wm_padding'] = '0';

    $ci->image_lib->initialize($config); 

    $ci->image_lib->watermark();
}

function getShortName($oldName) {
    $num = crc32($oldName);
    static $charArr = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numChar = strlen($charArr);
    $dstStr = '';
    do {  
        $key = $num % $numChar;  
        $dstStr .= $charArr[$key];  
        $num = floor($num / $numChar);
//        echo $num . '<br />';
    } while ($num > 0);  
    return $dstStr;
}
