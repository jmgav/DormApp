<?php

class dbconnection{
    private static $instance;
    private static $config = array(
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "db_name" => "dormapp"
        
       /*  "host" => "mysql6.000webhost.com",
        "username" => "a3173412_yabs",
        "password" => "shaman6869",
        "db_name" => "a3173412_yabs" */
        
    );
    private $connection;
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new dbconnection();
        }
        return self::$instance;
    }
    public static function getConnection(){
        return self::getInstance()->connection;
    }
    private function __construct(){
        $conf = self::$config;
        $this->connection = mysql_connect($conf['host'],$conf['username'],$conf['password']);
        mysql_select_db($conf['db_name']);
    }
    public function __destruct(){
        mysql_close($this->connection);
    }
}

