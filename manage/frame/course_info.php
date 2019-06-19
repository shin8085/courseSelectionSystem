<?php
include "../../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>course_info</title>
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
    <?php
    $result=$sf->getInfo("course");
    if($result->num_rows==0){
        echo "暂课程信息<br>";
    }
    else{
    ?>
    <table class="table1" border="1">
        <tr class="tr1">
            <td>课程编号</td><td>课程名</td><td>上课地点</td><td>上课时间</td><td>教师</td>
        </tr>
        <?php
        while($row=mysqli_fetch_row($result)){
        ?>
        <tr>
            <?php
            for($i=0;$i<count($row);$i++){
                if($row[$i]==null){
                    echo "<td>暂无数据</td>";
                }
                else{
                    echo "<td>$row[$i]</td>";
                }
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
</body>
</html>