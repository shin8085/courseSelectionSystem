<!----------------学生已选课程界面------------------->
<?php
if(!session_id()) session_start();
include "../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>selected_course</title>
    <link rel="stylesheet" type="text/css" href="css/index_right.css">
    <style>
        table{
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
        $result=$sf->getSelectedCourse();
        if($result->num_rows==0){
            echo "您还没有选择课程";
        }
        else{
        ?>
        <table border=1>
            <tr class="tr1">
                <?php
                echo "<td>课程编号</td><td>课程名称</td><td>教室</td><td>上课时间</td><td>成绩</td><td>教师</td>";
                ?>
            </tr>
            <?php
                while($row=mysqli_fetch_row($result)){
            ?>
                <tr class="tr2">
                    <?php
                        for($i=0;$i<count($row);$i++){
                            if($row[$i]==null)
                                echo "<td>暂无成绩</td>";
                            else
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
</body>
</html>