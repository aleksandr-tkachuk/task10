<?php

class PostgreSql extends Sql {

    protected function connect() {
        $this->dbh = pg_connect(
            "host=".$this->host." dbname=".$this->dbName." user=".$this->userName." password=".$this->password);
        if(!isset($this->dbh)){
            throw new Exception(pg_last_error());
        }
    }

    public function exec() {
        parent::exec();
        $res = pg_query($this->dbh, $this->query);
        $result = pg_fetch_all($res);
        if(!empty($this->select)) {
            if ($result == false) {
                return [];
            }else{
                return $result;
            }
        }else {
            return $res;
        }
    }

}
