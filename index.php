<?php

include_once './config/config.php';
include_once './libs/sql.php';
include_once './libs/mysql.php';
include_once './libs/postgresql.php';


$query = new PostgreSql(HOST, USER_POSTRE, PASSWORD_POSTRE,DBNAME_POSTRE);
$res = $query->
        select("'author_name','book_name','genre_name'")->
        from('author')->
        join('book', 'author.author_id = book.book_id', '', 'left')->
        join('author_book', 'author_book.book_id = book.book_id', '', 'left')->
        join('author_book ab', 'ab.author_id = author.author_id', '', 'left')->
        join('genre_book', 'genre_book.genre_id = book.book_id', '', 'left')->
        join('genre', 'genre.genre_id = genre.genre_id', '', 'left')->
        order("author.author_name asc")->
        //group("author_name")->
        exec();

/*
        $query = new MySql(HOST, USER, PASSWORD,DBNAME);
        $res = $query->
        select("`author_name`,`book_name`, `genre_name`")->
        from('author')->
        //distinct()->
        join('author_book', 'author.author_id = author_book.author_id', '', 'right')->
        join('book', 'author_book.book_id = book.book_id', '', 'right')->
        join('genre_book', 'genre_book.book_id = book.book_id', '', 'right')->
        join('genre', 'genre.genre_id = genre_book.genre_id', '', 'left')->
        order("author.author_name asc")->
        //group("author_name")->
        exec();*/
include_once 'templates/index.php';

