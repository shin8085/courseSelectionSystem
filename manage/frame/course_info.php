<!----------------课程信息界面------------------->
<?php
if(!session_id()) session_start();
include "../../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>course_info</title>
    <link rel="stylesheet" type="text/css" href="../../frame/css/index_right.css">
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
    </style>
</head>
<body>
    <div class="center">
        <?php
        $result=$sf->getInfo("course");
        if($result->num_rows==0){
            echo "暂课程信息<br>";
        }
        else{
        ?>
        <form action="course_info.php" method="post">
            <table class="table1" border="1">
                <tr class="tr1">
                    <td>课程编号</td><td>课程名</td><td>上课地点</td><td>上课时间</td><td>教师</td><td></td>
                </tr>
                <?php
                $k=0;
                while($row=mysqli_fetch_row($result)){
                ?>
                <tr>
                    <?php
                    for($i=0;$i<count($row);$i++){
                        if(@$_POST["change$k"]=="修改"){
                            echo "<td><input type='text' name='$i' value='$row[$i]' style='width:90px;'></td>";
                        }
                        else{
                            if($row[$i]==null){
                                echo "<td>暂无数据</td>";
                            }
                            else{
                                echo "<td>$row[$i]</td>";
                            }
                        }
                    }
                    ?>
                    <td>
                        <?php
                            if(@$_POST["change$k"]=='修改'){
                                echo "<input type='submit' name='finish$k' value='完成'>";
                            }
                            else{
                                if(@$_POST["finish$k"]=='完成'){
                                    //获取要修改的课程信息
                                    $oldcno=$row[0];
                                    $cno=$_POST['0'];
                                    $cname=$_POST['1'];
                                    $csite=$_POST['2'];
                                    $ctime=$_POST['3'];
                                    $tname=$_POST['4'];
                                    $r=$sf->updateCourseInfo($oldcno,$cno,$cname,$csite,$ctime,$tname);
                                    if($r!=""){
                                        echo "<Script>alert('课程编号已存在');</Script>";
                                    }
                                    else
                                        header("location:course_info.php");
                                }
                                echo "<input type='submit' name='change$k' value='修改'>";
                            }
                            $k++;
                        ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </form>
        <?php
            }
        ?>
    </div>
</body>
</html>