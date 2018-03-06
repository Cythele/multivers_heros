<?php

class Preferences{
    private $vars =array();
    private $db_instance=null;
 
 public function __set($index, $value) { 
     $this->vars[$index] = $value;
 }
 public function __get($index) {
     return $this->vars[$index];
 }
    public function getDB(){
        if($this->db_instance==null){
            $this->db_instance=new PDO("mysql:hostname=$this->hostname; dbname=$this->dbname", $this->username, $this->password, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->db_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->db_instance;
    } 
} ?>