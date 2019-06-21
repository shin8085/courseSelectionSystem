<!----------------教师提交课程界面------------------->
<?php
if(!session_id()) session_start();
include "../inc/mysql.php";
$ms=new mysql;
$ms->link("course_select_database");
$tno=$_SESSION['username']; //获取教师编号
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>commit_course</title>
    <link rel="stylesheet" type="text/css" href="css/index_right.css">
    <style>
        .table1{
            width:500px;
            text-align:center;
        }
        .tr1{
            height:30px;
            background:orange;
            color:white;
        }
        .tr2{
            height:30px;
        }
        .left{
            float:left;
            margin-top:100px;
            margin-left:150px;
        }
        .right{
            float:right;
            margin-top:100px;
            margin-right:150px;
        }
    </style>
</head>
<body>
    <div class="left">
        <?php
        //获取已提交的课程
        $sql="select course.cno,course.cname,course.csite,course.ctime from course where course.tno=$tno";
        $result=$ms->excu($sql);
        if($result->num_rows==0){
            echo "您还没有提交课程<br>";
        }
        else{
        ?>
        <table border=1 class="table1">
            <tr class="tr1">
                <?php
                echo "<td>课程编号</td><td>课程名称</td><td>教室</td><td>上课时间</td>";
                ?>
            </tr>
            <?php
                while($row=mysqli_fetch_row($result)){
            ?>
                <tr class="tr2">
                    <?php
                        for($i=0;$i<count($row);$i++){
                            echo "<td>$row[$i]</td>";
                        }
                    ?>
                </tr>
            <?php
                }
            ?>
        </table>
        <?php
        }
        ?>
    </div>
    <div class="right">
        <form action="commit_course.php" method="post">
            <table style="height: 120px;">
                <tr>
                    <td>课程编号</td>
                    <td><input type="text" name="cno" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>课程名称</td>
                    <td><input type="text" name="cname" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>教室</td>
                    <td><input type="text" name="csite" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>上课时间</td>
                    <td><input type="text" name="ctime" autocomplete="off"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center"><input type="submit" name="submit" value="提交"></td>
                </tr>
            </table>
        </form>
        <?php
            if(@$_POST['submit']=="提交"){
                //获取课程基本信息
                $cno=$_POST['cno'];
                $cname=$_POST['cname'];
                $csite=$_POST['csite'];
                $ctime=$_POST['ctime'];
                if($cno!=""&&$cname!=""&&$csite!=""&&$ctime!=""){
                    $sql="select * from course where cno=$cno";
                    $result=$ms->excu($sql);
                    if($result->num_rows==0){
                        $sql="insert into course(cno,cname,csite,ctime,tno) values('$cno','$cname','$csite','$ctime','$tno')";
                        $ms->excu($sql);
                        echo "课程提交成功";
                        header("location:commit_course.php");
                    }
                    else{
                        echo "课程编号已存在";
                    }
                }
                else{
                    echo "输入内容均不能为空";
                }
            }
        ?>
    </div>
</body>
</html>