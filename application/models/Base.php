<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Base extends Yun_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getTable(){
        return $this->table;
    }
    
    public function setTable($table){
        $this->table = $table;
    }
}

?>
