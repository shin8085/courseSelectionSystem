<?php
include "mysql.php";
//通过该类中的函数可对数据库进行相应的操作
class sqlfunction{
    private $ms;
    function sqlfunction(){
        $this->ms=new mysql;
        $this->ms->link("course_select_database"); //连接数据库
    }
    //登录
    function login($username,$password,$status){
        $sql="";
        if($status=="student"){
            $sql="select Spw from studentuser where Sno=$username";
        }
        else if($status=="teacher"){
            $sql="select Tpw from teacheruser where Tno=$username";
        }
        else if($status=="admin"){
            $sql="select Apw from admin where Ano='$username'";
        }
        $pw=mysqli_fetch_row($this->ms->excu($sql));
        if($pw[0]==$password){
            $_SESSION['username']=$username; //获取账号
            $_SESSION['status']=$status; //获取登录者身份
            header("location:index.php"); //跳转至index页面
        }
        else{
            echo "账号或密码输入有误";
        }
    }
    //注册
    function register($username,$password,$password2,$status){
        if($username!=""&&$password!=""&&$password2!=""){ //输入数据不为空
            $sql="select * from $status where $status[0]no=$username";
            $result=$this->ms->excu($sql);
            if($result->num_rows==0){ //判断表中是否已存在$username
                if($password==$password2){
                    //插入对应账号密码表中
                    $sql="insert into $status"."user values('$username','$password')";
                    $this->ms->excu($sql);
                    //插入对应的信息表中
                    $sql="insert into $status($status[0]no) values('$username')";
                    $this->ms->excu($sql);
                    $_SESSION['username']=$username;
                    $_SESSION['status']=$status;
                    header("location:index.php");
                }
                else{
                    echo "两次密码不一致<br>";
                }
            }
            else{
                echo "该用户已存在<br>";
            }
        }
        else{
            echo "学号/编号和密码均不能为空<br>";
        }
    }
    //根据账号获取用户信息
    function getUserInfo(){
        $username=$_SESSION['username']; //获取账号
        $status=$_SESSION['status']; //获取登录者身份
        $sql="select * from $status where $status[0]no=$username";
        return mysqli_fetch_row($this->ms->excu($sql));
    }
    //修改密码
    function changePassWord($oldpw,$newpw,$newpwagin){
        $username=$_SESSION['username']; //获取账号
        $status=$_SESSION['status']; //获取登录者身份
        $sql="select $status[0]pw from $status"."user where $status[0]no=$username";
        $rightpw=mysqli_fetch_row($this->ms->excu($sql))[0];
        if($oldpw==$rightpw){ //判断原密码是否正确
            if($newpw==$newpwagin){ //判断两次密码是否一致
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
        //获取预选课程的信息
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
    //获取未选择的课程信息
    function getCourseInfo(){
        $sno=$_SESSION['username']; //获取学号
        //获取未选择的课程信息
        $sql="select
                c.cno,
                c.cname,
                c.csite,
                c.ctime,
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
        if($name!=""&&$age!=""&&$sex!=""){
            $status=$_SESSION['status'];
            $sql="update $status set $status[0]name='$name',$status[0]age='$age',$status[0]sex='$sex' where $status[0]no='$no'";
            $this->ms->excu($sql);
        }
        else{
            echo "<Script>alert('输入信息均不能为空')</Script>";
        }
        
    }
    //获取学生、教师、课程信息
    function getInfo($infoObject){
        $sql="";
        if($infoObject=="course"){ //获取课程信息
            $sql="select cno,cname,csite,ctime,tname from course,teacher where course.tno=teacher.tno";
        }
        else{ //获取学生或教师信息
            $sql="select * from $infoObject";
        }
        $result=$this->ms->excu($sql);
        return $result;
    }
    //更新课程信息
    function updateCourseInfo($oldcno,$cno,$cname,$csite,$ctime,$tname){
        $sql="select * from course where cno=$cno";
        $result=$this->ms->excu($sql);
        $row=mysqli_fetch_row($result);
        if($result->num_rows==0||$row[0]==$oldcno){ //课程编号不重复
            //取消外键约束
            $sql="alter table sc drop foreign key fk_sc_course";
            $this->ms->excu($sql);
            //更新course表
            $sql="update course set cno='$cno',cname='$cname',csite='$csite',ctime='$ctime' where cno='$oldcno'";
            $this->ms->excu($sql);
            //更新sc表
            $sql="update sc set cno='$cno' where cno='$oldcno'";
            $this->ms->excu($sql);
            //增加外键约束
            $sql="alter table sc add constraint fk_sc_course foreign key(cno) references course(cno)";
            $this->ms->excu($sql);
            //获取教师编号
            $sql="select tno from course where cno=$cno";
            $result=$this->ms->excu($sql);
            $row=mysqli_fetch_row($result);
            $tno=$row[0];
            //更改教师姓名
            $sql="update teacher set tname='$tname' where tno=$tno";
            $this->ms->excu($sql);
            return "";
        }
        else{
            return "课程编号已存在";
        }
    }
}
?>