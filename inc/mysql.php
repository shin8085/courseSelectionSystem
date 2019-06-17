<?php

class mysql{
    private $database;
    private $username;
    private $password;
    private $db;
    function mysql(){
        $this->username="root";
        $this->password="168168";
    }
    function link($database=""){
        $this->database=$database;
        if(@$this->db=mysqli_connect('localhost',$this->username,$this->password)){
            $this->linkDatabase($database);
        }
        else{
            echo "服务器连接失败！<br>";
            exit();
        }
    }
    private function linkDatabase($database){
        if($database!=""&&!mysqli_select_db($this->db,$database)){
            echo "数据库 $this->database 连接失败！<br>";
            exit();
        }
    }
    function create($database){
        $this->excu("CREATE DATABASE $database DEFAULT CHARSET utf8");
        echo "数据库 $database 创建成功<br>";
        $this->linkDatabase($database);
    }
    function excu($sql){
        if($result=mysqli_query($this->db,$sql)){
            return $result;
        }
        else{
            echo "sql语句执行失败:$sql <br>";
            exit();
        }
    }
    
}


?>