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
