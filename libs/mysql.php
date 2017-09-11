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
        parent::exec();
        $res = mysql_query($this->query, $this->dbh);

        if(!empty($this->select)){
            $result = [];
            while ($row = mysql_fetch_array($res)){
                $result[] = $row;
            }
            return $result;
        }else{
            return $res;
        }
    }


}
