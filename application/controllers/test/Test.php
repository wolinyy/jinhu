<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Test extends Test_Controller {
    
    public function index() {
        echo '<pre>';
        print_r($_SERVER);
        print_r($_REQUEST);
        echo '</pre>';
        exit;
        $str = 'http://img.jh.cn/103/ajNAO2_800x450.jpg';
        echo strrchr($str, '/');
        exit;
//        $str = '/home/img/103/20160922/be36144d61d90beced106ba7caeee9b1_800x450.jpg';
//        echo strstr($str, '/img');
        
        $num = crc32('be36144d61d90beced106ba7caeee9b1');
        $charArr = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numChar = strlen($charArr);
        $dstStr = '';
        do {  
            $key = $num % $numChar;  
            $dstStr .= $charArr[$key];  
            $num = floor($num / $numChar);
            echo $num . '<br />';
        } while ($num > 0);  
        echo $dstStr;
        
//        phpinfo();
        exit;
        
        $str = "1:整套\r\n2:单间\r\n3:床位";
        $tmpArr = explode("\n", $str);
        print_r($tmpArr);
        foreach ($tmpArr as $key => $value) {
            echo explode(":", $value)[0] . ' - ' . explode(":", $value)[1];
        }
//        $str = 'attras|2';
//        $needle = "attrs|";//判断是否包含a这个字符 
//        $tmparray = explode($needle,$str); 
//        print_r($tmparray);
//        if(count($tmparray)>1){ 
//            echo ">1";
//        } else{ 
//            echo count($tmparray);
//        } 

        
        $code = "0";
        if("0" === $code)
            echo "ok";
    }
    public function bm() {
        $this->benchmark->mark('dog');


        for($i=0; $i<10000;$i++){
            ;
        }

        $this->benchmark->mark('cat');

        // More code happens here

        $this->benchmark->mark('bird');

        echo $this->benchmark->elapsed_time('dog', 'cat') . '<br />';
        echo $this->benchmark->elapsed_time('cat', 'bird') . '<br />';
        echo $this->benchmark->elapsed_time('dog', 'bird') . '<br />';
    }
    
    public function tb() {
        $this->load->library('trackback');

        $tb_data = array(
            'ping_url'  => 'http://example.com/trackback/456',
            'url'       => 'http://www.my-example.com/blog/entry/123',
            'title'     => 'The Title of My Entry',
            'excerpt'   => 'The entry content.',
            'blog_name' => 'My Blog Name',
            'charset'   => 'utf-8'
        );

        if ( ! $this->trackback->send($tb_data))
        {
            echo $this->trackback->display_errors();
        }
        else
        {
            echo 'Trackback was sent!';
        }
    }
    
    public function unit() {
        $this->load->library('unit_test');
       
        $test = 1 + 1;
        $expected_result = 2;
        $test_name = 'Adds one plus one';
        echo $this->unit->run($test, $expected_result, $test_name);
        
        echo $this->unit->run('Foo', 'Foo');
        echo $this->unit->run('Foo', 'is_string');
        
        echo $this->unit->report();
    }
    
    public function db() {
        $this->load->database();
        $this->db->db_select('z_test');
        $this->db->dbprefix='test_';
        $query = $this->db->from('permission')->get();
        
        print_r($query->result_array());
    }
    
    public function cache() {
        
        $this->load->driver('cache', [
            #'adapter' => 'file',
            'adapter' => 'memcached',
            #'backup' => 'file'
        ]);
        if ($this->cache->apc->is_supported())
        {
            echo "apc<br/>";
        }
        
        if ($this->cache->memcached->is_supported())
        {
            echo "memcached<br/>";
        }
        
        
        if ( ! $foo = $this->cache->get('foo'))
        {
            echo 'Saving to the cache!<br />';
            $foo = 'foobarbaz!';

            // Save into the cache for 5 minutes
            $this->cache->save('foo', $foo, 10);
        }

        echo $foo;
    }
    
    public function arrstr() {
        $arr = [
            'a'=>'a',
            'b'=>123,
            'c'=>false
        ];
        $ser_arr = serialize($arr);
        print_r($ser_arr);
        print_r(unserialize($ser_arr));
        print_r(json_encode($arr));
    }
    
    public function strpos() {
        $data['platform'] = 'Android';
        echo strpos(strtolower($data['platform']), 'android');
        $data['user_agent'] = null;
        if(strpos(strtolower($data['user_agent']), 'android') !== false 
            || strpos(strtolower($data['platform']), 'android') !== false){
            echo 'yes';
        }
    }
}

?>
