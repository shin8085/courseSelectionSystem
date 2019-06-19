<?php
include "../inc/mysql.php";
$ms=new mysql;
$ms->link("course_select_database");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index_left</title>
</head>
<body>
    <?php
        $username=$_SESSION['username'];
        $status=$_SESSION['status'];
        $sql="select $status[0]name from $status where $status[0]no=$username";
        $result=$ms->excu($sql);
        $row=mysqli_fetch_row($result);
        echo "你好 $row[0]";
    ?>
    <a href="../login.php" target="_top">退出登入</a>
    <table>
        <tr>
            <td>
                <a href="user_info.php" target="right">个人信息</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="change_pw.php" target="right">修改密码</a>
            </td>
        </tr>
        <?php
        if($_SESSION['status']=="student"){
            echo "<tr><td><a href='selected_course.php' target='right'>已选课程</a></td></tr>";
        }
        ?>
        <tr>
            <td>
                <?php
                if($_SESSION['status']=="student"){
                    echo "<a href='select_course.php' target='right'>选择课程</a>";
                }
                else if($_SESSION['status']=="teacher"){
                    echo "<a href='commit_course.php' target='right'>提交课程</a>";
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>