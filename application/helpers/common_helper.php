<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function test($param) {
    echo __FUNCTION__;
}

function get_attrs_arr($str) {
    $tmpArr = explode("\n", $str);
    $resp = [];
    foreach ($tmpArr as $k => $v){
        $Arr = explode(":", $v);
        $resp[$Arr[0]] = $Arr[1];
    }
    
    return $resp;
}

function get_attrs_value($str, $key) {
    $tmpArr = explode("\n", $str);
    $resp = [];
    foreach ($tmpArr as $k => $v){
        $Arr = explode(":", $v);
        $resp[$Arr[0]] = $Arr[1];
    }
    
    $ret = '';
    if(is_array($key)){
        foreach ($key as $value) {
            $ret .= $resp[$value] . '&nbsp;&nbsp;';
        }
    }else{
        $ret = $resp[$key];
    }
    
    return $ret;
}

function timeShow($time) {
    $currTime = time();
    $day = floor(($currTime-$time)/86400);
    
    $ret;
    if($day == 0){
        //今天 显示时间
        $ret = date('H:i', $time);
    }else if($day < 7){
        $ret = $day . '天前';
    }else{
        $ret = date('Y-m-d', $time);
    }
    
    return $ret;
}

function searchKeyShow($title, $key){
    if(empty($key)){
        return $title;
    }
    
    return str_replace($key, "<font color='red'>" . $key . '</font>', $title);
}

function higrid_compress_html($higrid_uncompress_html_source )
{
    $chunks = preg_split( '/(<pre.*?\/pre>)/ms', $higrid_uncompress_html_source, -1, PREG_SPLIT_DELIM_CAPTURE );
    //print_r($chunks);
    $higrid_uncompress_html_source = '';//[higrid.net]修改压缩html : 清除换行符,清除制表符,去掉注释标记
    foreach ( $chunks as $c )
    {
        if ( strpos( $c, '<pre' ) !== 0 )
        {
            $pattern = array (
                '/[\n\r\t]+/',  // remove new lines & tabs
                '/\s{2,}/',     // remove extra whitespace
                '/>\s</',       // remove inter-tag whitespace
                '/<!--[^!]*-->/',
                "/\/\*.*?\*\//i"
            );
            $replace = array (
                '', ' ', '><', '', ''
            );
            $c = preg_replace($pattern, $replace, $c);
            /*
            //[higrid.net] remove new lines & tabs
            $c = preg_replace( '/[\n\r\t]+/', ' ', $c );
            // [higrid.net] remove extra whitespace
            $c = preg_replace( '/\s{2,}/', ' ', $c );
            // [higrid.net] remove inter-tag whitespace
            $c = preg_replace( '/>\s</', '><', $c );
            // [higrid.net] remove CSS & JS comments
            $c = preg_replace( '/\/\*.*?\*\//i', '', $c );
            // 删除注释
            $c = preg_replace( '/<!--[^!]*-->/i', '', $c );
             */
        }
        $higrid_uncompress_html_source .= $c;
    }
    return $higrid_uncompress_html_source;
} 
