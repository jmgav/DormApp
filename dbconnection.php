<?php

class dbconnection{
    private static $instance;
    private static $config = array(
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "db_name" => "dormapp"
        
         /*"host" => "dormapp.hostei.com",
        "username" => "a9993421_user",
        "password" => "dormapp100",
        "db_name" => "a9993421_dormapp" */
        
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

