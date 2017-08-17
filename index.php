<?php

include_once './config/config.php';
include_once './libs/sql.php';
include_once './libs/msql.php';
//include_once './libs/postgresql.php';


//$pg = new PostgreSql(HOST, USER_POSTRE, PASSWORD_POSTRE,DBNAME);
//$res = $pg->select('data')->from(TABLE_NAME)->where('`key`' . ' = ' . '"Sasha"')->exec();


$sql = new MySql(HOST, USER, PASSWORD,DBNAME);
$res = $sql->
        select('qwe, qqq')->
        from('book')->
        join('tablename', 'col1.id = col2.id', '', 'cross')->
        join('tablename1', 'col4.id = col5.id', 'outer', 'left')->
        where('col3.id = col4.id')->
        having('col6.id = col7.id')->
        group("col10")->
        order("col5 asc")->
        limit(4, 10)->
        exec();
exit();
include_once 'templates/index.php';

