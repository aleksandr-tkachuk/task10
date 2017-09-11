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
    protected $distinct = false;
    protected $delete = false;
    protected $insert;
    protected $update;
    protected $query;

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


    public function delete() {
        $this->delete = true;
        return $this;
    }
    public function insert($arrayFields, $arrayValues) {
        $fields = implode(',', $arrayFields);
        $values = "'" . implode("','", $arrayValues) . "'";
        $this->insert = '(' . $fields . ') values (' . $values . ')';

        return $this;
    }

    public function update($arrayFields, $arrayValues) {
        $fields = "";
        for ($i = 0; $i < count($arrayFields); $i++) {
            if (strlen($fields) != 0) {
                $fields .= ',';
            }
            $fields .= $arrayFields[$i] . " = '" . $arrayValues[$i] . "'";
        }
        $this->update = $fields;
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
    
    public function distinct() {
        $this->distinct = true;
        return $this;
    }


    public function exec() {
        if (empty($this->from)) {
            throw new Exception("not set");
        }
        if ($this->delete) {
            $this->query = "delete from {$this->from}";
            return $this->result;
        } elseif (!empty($this->insert)) {
            $this->query = "insert into {$this->from} $this->insert";
        } elseif (!empty($this->update)) {
            $this->query = "update  {$this->from} set $this->update";
            $this->query .= (!empty($this->where)) ? " where {$this->where};" : '';
        } else {
            if (empty($this->select)) {
                throw new Exception("not select set");
            }

            $this->query = "select ".(($this->distinct) ? " distinct " : " ")." {$this->select} from {$this->from}";
            foreach ($this->join as $join) {
                $this->query .= " {$join[3]} {$join[2]} join {$join[0]} on {$join[1]}";
            }
            $this->query .= (!empty($this->where)) ? " where {$this->where};" : '';
            if(!empty($this->group)){
                $this->query .= " group by {$this->group}";
            }

            if(!empty($this->having)){
                $this->query .= " having {$this->having}";
            }

            if(!empty($this->order)){
                $this->query .= " order by {$this->order}";
            }

            if(!empty($this->limit)){
                $this->query .= $this->limit;
            }

        }

    }

    public function getQuery()
    {
        return $this->query;
    }

}




