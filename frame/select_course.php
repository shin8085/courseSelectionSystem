<?php
include "../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>select_course</title>
    <style>
        table{
            width:500px;
            height:100px;
            text-align:center;
        }
        .tr1{
            background:orange;
            color:white;
        }
    </style>
</head>
<body>
    <?php
    $result=$sf->getCourseInfo();
    if($result->num_rows==0){
        echo "您已选择了所有课程";
    }
    else{
    ?>
    <form action="select_course.php" method="post">
        <table border=1>
            <tr class="tr1">
                <?php
                echo "<td>课程编号</td><td>课程名称</td><td>教师</td><td>选课</td>";
                ?>
            </tr>
            <?php
                while($row=mysqli_fetch_row($result)){
            ?>
                <tr>
                    <?php
                        for($i=0;$i<count($row);$i++){
                            echo "<td>$row[$i]</td>";
                        }
                        echo "<td><button type='submit' name='select' value=$row[0]>选择</button></td>";
                    ?>
                </tr>
            <?php
                }
            ?>
        </table>
    </form>
    <?php
    $cno=$_POST['select'];
    $sf->selectCourse($cno);
    }
    ?>
</body>
</html>