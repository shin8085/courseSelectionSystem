<!----------------学生信息界面------------------->
<?php
include "../../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>student_info</title>
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
        $result=$sf->getInfo("student");
        if($result->num_rows==0){
            echo "暂无学生信息<br>";
        }
        else{
        ?>
        <table class="table1" border="1">
            <tr class="tr1">
                <td>学号</td><td>姓名</td><td>出生日期</td><td>性别</td>
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
    </div>
</body>
</html>