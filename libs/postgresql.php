<?php

class PostgreSql extends Sql {
/*
    protected function connect() {
        $this->dbh = pg_connect(
                "host=".$this->host,
                "dbName=".$this->dbName,
                "user=".$this->userName,
                "password=".$this->password);
*/        
    protected function connect() {
        $this->dbh = pg_connect(
                "host=localhost",
                'port=5432',
                "dbName=postgres",
                "user=postgres",
                "password=123456");
        if(!isset($this->dbh)){
            throw new Exception(pg_last_error());
        }
        var_dump($this->dbh);
        echo '<br>';
    }
    
    public function exec() {
        
        if(!isset($this->select) || !isset($this->from)){
            throw new Exception("not set");
        }

        $query =  "select {$this->select} from {$this->from}";
                
        foreach ($this->join as $join) {
            $query .= " {$join[3]} {$join[2]} join {$join[0]} on ({$join[1]})";
        }
        
        if(!empty($this->where)){
            $query .= " where {$this->where}";
        }
        
        if(!empty($this->group)){
            $query .= " group by {$this->group}";
        }
        
        if(!empty($this->having)){
            $query .= " having {$this->having}";
        }
        
        if(!empty($this->order)){
            $query .= " order by {$this->order}";
        }
        
        if(!empty($this->limit)){
            $query .= $this->limit;
        }
        echo $query;
        $res = pg_query($this->dbh,$query);
            if(pg_num_rows($res) > 0){
                return 1;
            } else{
                return 0;
            }
                //return pg_fetch_assoc($res);
    }

}
