<?php
include "mysql.php";
class sqlfunction{
    private $ms;
    function sqlfunction(){
        $this->ms=new mysql;
        $this->ms->link("course_select_database");
    }
    function login($username,$password,$status){
        if($status=="student"){
            $sql="select Spw from studentuser where Sno=$username";
            $pw=$this->ms->excu($sql);
        }
        else if($status=="teacher"){
            $sql="select Spw from teacheruser where Tno=$username";
            $pw=$this->ms->excu($sql);
        }
        else if($status=="admin"){
            $sql="select Spw from admin where Ano=$username";
            $pw=$this->ms->excu($sql);
        }
        $pw=mysqli_fetch_array($pw);
        print_r($pw2);
        if($pw[0]==$password){
            header("location:index.php");
        }
        else{
            echo "账号或密码输入有误";
        }
        
    }
}
?>