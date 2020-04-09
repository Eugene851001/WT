<?php

class DatabaseHandler
{
    public $host = 'localhost';
    public $userName = 'root';
    public  $password = 'password';
    public $dbName = 'site_php';
	
    public $tableName = 'sections';
	
    public $data;
    public $link;
    public $query;
    public $result;
	
    function connect(){
        var_dump($this->host);
        $this->link = mysqli_connect($this->host, $this->userName, $this->password, $this->dbName);
    }
	
    function makeQuery($query){
        $this->result = mysqli_query($this->link, $query);
    }
	
    function close(){
        mysqli_close($this->link);
    }	
}

