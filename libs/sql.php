<?php
abstract class Sql {
    
    protected $host;
    protected $userName;
    protected $password;
    protected $dbName;
    
    protected $select;
    protected $from;
    protected $where = "";
    protected $join = [];
    
    protected $group = '';


    protected $order = "";
    protected $limit = "";
    protected $having = "";
    protected $distinct;

    protected $dbh;


    public function __construct($host, $userName, $password, $dbName){
        $this->host     = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->connect();
        
    }
    
    protected abstract function connect();

    public function select($str) {
        $this->select = $str;
        return $this;
    }
    
    public function from($str) {
        $this->from = $str;
        return $this;
    }
    
    public function where($str) {
        $this->where = $str;
        return $this;
    }
    
    public function join($tname, $cond, $oi, $lrf) {
        $this->join[] = [$tname, $cond, $oi, $lrf];       
        return $this;
    }
    
    public function order($str) {
        $this->order = $str;
        return $this;
    }
    
    public function limit($count, $offset = 0) {
        $this->limit = ($offset == 0) ? ' limit '.$count : ' limit '.$offset.",".$count;
        return $this;
    }
    public function having($str) {
        $this->having = $str;
        return $this;
    }
    
    public function group($str) {
        $this->group = $str;
        return $this;
    }
    
    public function distinct($str) {
        $this->distinct = $str;
        return $this;
    }
    
    
    public abstract function exec();

}




