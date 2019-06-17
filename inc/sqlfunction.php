<?php
include "mysql.php";
class sqlfunction{
    private $ms;
    function sqlfunction(){
        $this->ms=new mysql;
        $this->ms->link("course_select_database");
    }
    //登入
    function login($username,$password,$status){
        $sql="";
        if($status=="student"){
            $sql="select Spw from studentuser where Sno=$username";
        }
        else if($status=="teacher"){
            $sql="select Spw from teacheruser where Tno=$username";
        }
        else if($status=="admin"){
            $sql="select Spw from admin where Ano=$username";
        }
        $pw=mysqli_fetch_array($this->ms->excu($sql));
        print_r($pw2);
        if($pw[0]==$password){
            $_SESSION['username']=$username;
            $_SESSION['status']=$status;
            header("location:index.php");
        }
        else{
            echo "账号或密码输入有误";
        }
    }
    //根据账号获取用户信息
    function getUserInfo(){
        $username=$_SESSION['username'];
        $status=$_SESSION['status'];
        $sql="select * from $status where $status[0]no=$username";
        return mysqli_fetch_array($this->ms->excu($sql));
    }
    //修改密码
    function changePassWord($oldpw,$newpw,$newpwagin){
        $username=$_SESSION['username'];
        $status=$_SESSION['status'];
        $sql="select $status[0]pw from $status"."user where $status[0]no=$username";
        $rightpw=mysqli_fetch_array($this->ms->excu($sql))[0];
        if($oldpw==$rightpw){
            if($newpw==$newpwagin){
                $sql="update $status"."user set $status[0]pw=$newpw where $status[0]no=$username";
                $this->ms->excu($sql);
                echo "修改密码成功<br>";
            }
            else{
                echo "两次输入的密码不一致<br>";
            }
        }
        else{
            echo "原密码输入错误<br>";
        }
    }
}
?>