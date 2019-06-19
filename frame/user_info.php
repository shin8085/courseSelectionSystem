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
    <link rel="stylesheet" type="text/css" href="css/index_right.css">
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
    <div class="center">
        <form action="user_info.php" method="post">
            <table border=1>
                <tr class="tr1">
                    <?php
                    $status=$_SESSION['status'];
                    $infoarr=$sf->getUserInfo();
                    if($status=='student'){ //学生
                        echo "<td>学号</td>";
                        echo "<td>姓名</td>";
                        echo "<td>出生日期</td>";
                        echo "<td>性别</td>";
                        echo "<td></td>";
                    }
                    else{ //教师
                        echo "<td>教师编号</td>";
                        echo "<td>姓名</td>";
                        echo "<td>出生日期</td>";
                        echo "<td>性别</td>";
                        echo "<td></td>";
                    }
                    ?>
                </tr>
                <tr>
                    <?php
                    echo "<td>$infoarr[0]</td>";
                    if(@$_POST['change']=='修改'){
                        for($i=1;$i<count($infoarr);$i++){
                            echo "<td><input type='text' name='$i' value='$infoarr[$i]' style='width:90px;'></td>";
                        }
                    }
                    else{
                        for($i=1;$i<count($infoarr);$i++){
                            
                            echo "<td>$infoarr[$i]</td>";
                        }
                    }
                    ?>
                    <td>
                        <?php
                            if(@$_POST['change']=='修改'){
                                echo "<input type='submit' name='finish' value='完成'>";
                            }
                            else{
                                if(@$_POST['finish']=='完成'){
                                    $tno=$_SESSION['username'];
                                    $tname=@$_POST['1'];
                                    $tage=@$_POST['2'];
                                    $tsex=@$_POST['3'];
                                    $sf->updateUserinfo($tno,$tname,$tage,$tsex);
                                    echo "<script> window.parent.location.reload()</script>"; //刷新页面
                                }
                                echo "<input type='submit' name='change' value='修改'>";
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>