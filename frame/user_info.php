<?php
include "../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user_info</title>
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
    <table border=1>
        <tr class="tr1">
            <?php
            $infoarr=$sf->getUserInfo();
            if(count($infoarr)/2==4){ //学生
                echo "<td>学号</td>";
                echo "<td>姓名</td>";
                echo "<td>出生日期</td>";
                echo "<td>性别</td>";
            }
            else{ //教师
                echo "<td>教师编号</td>";
                echo "<td>姓名</td>";
            }
            ?>
        </tr>
        <tr>
            <?php
            
            for($i=0;$i<count($infoarr)/2;$i++){
                echo "<td>$infoarr[$i]</td>";
            }
            ?>
        </tr>
    </table>
</body>
</html>