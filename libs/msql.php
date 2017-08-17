<?php

class MySQL extends Sql{

    protected function connect() {
        $this->dbh = mysql_connect(
                $this->host,
                $this->userName,
                $this->password);
        $dbConnect = mysql_select_db($this->dbName,$this->dbh);
        if(!$dbConnect){
            throw new Exception('Failed to select base'.$this->dbName.': ' . mysql_error());
        }
    }
    
    public function exec() {
        
        if(empty($this->select) || empty($this->from)){
            throw new Exception("not set");
        }

        $query =  "select {$this->distinct} `{$this->select}` from `{$this->from}`";
        
        
        foreach ($this->join as $join) {
            $query .= " {$join[3]} {$join[2]} join {$join[0]} on {$join[1]}";
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
        //$res = mysql_query($query, $this->dbh);
        //return mysql_fetch_array($res);
    }


}
