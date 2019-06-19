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
            $sql="select Tpw from teacheruser where Tno=$username";
        }
        else if($status=="admin"){
            $sql="select Apw from admin where Ano=$username";
        }
        $pw=mysqli_fetch_row($this->ms->excu($sql));
        if($pw[0]==$password){
            $_SESSION['username']=$username; //获取账号
            $_SESSION['status']=$status; //获取登入者身份
            header("location:index.php");
        }
        else{
            echo "账号或密码输入有误";
        }
    }
    //根据账号获取用户信息
    function getUserInfo(){
        $username=$_SESSION['username']; //获取账号
        $status=$_SESSION['status']; //获取登入者身份
        $sql="select * from $status where $status[0]no=$username";
        return mysqli_fetch_row($this->ms->excu($sql));
    }
    //修改密码
    function changePassWord($oldpw,$newpw,$newpwagin){
        $username=$_SESSION['username']; //获取账号
        $status=$_SESSION['status']; //获取登入者身份
        $sql="select $status[0]pw from $status"."user where $status[0]no=$username";
        $rightpw=mysqli_fetch_row($this->ms->excu($sql))[0];
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
    //获取已选课程
    function getSelectedCourse(){
        $sno=$_SESSION['username']; //获取学号
        $sql="select
                t.cno,
                t.cname,
                t.csite,
                t.ctime,
                t.score,
                teacher.tname
            from
                (
                    select
                        sc.sno,
                        sc.cno,
                        course.cname,
                        course.csite,
                        course.ctime,
                        course.tno,
                        sc.score
                    from
                    sc left join course on
                        sc.cno=course.cno
                ) t left join teacher on
                    t.tno=teacher.tno
            where
                t.sno=$sno
            order by t.cno";
        return $this->ms->excu($sql);
    }
    //获取课程信息
    function getCourseInfo(){
        $sno=$_SESSION['username']; //获取学号
        $sql="select
                c.cno,
                c.cname,
                teacher.tname
            from
                (
                    select
                        *
                    from
                        course
                    where
                        course.cno not in (
                                    select
                                        sc.cno
                                    from
                                        sc
                                    where
                                        sc.sno=$sno
                                    )
                ) c,
                teacher
            where
                c.tno=teacher.tno
            order by c.cno";
        return $this->ms->excu($sql);
    }
    //选择课程
    function selectCourse($cno){
        $sno=$_SESSION['username']; //获取学号
        $sql="insert into SC(sno,cno) values('$sno','$cno')";
        $this->ms->excu($sql);
    }
    //更新用户信息
    function updateUserinfo($no,$name,$age,$sex){
        $status=$_SESSION['status'];
        $sql="update $status set $status[0]name='$name',$status[0]age='$age',$status[0]sex='$sex' where $status[0]no='$no'";
        $this->ms->excu($sql);
    }
}
?>