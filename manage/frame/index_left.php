<!----------------管理员主界面右侧界面------------------->
<?php
if(!session_id()) session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index_left</title>
    <link rel="stylesheet" type="text/css" href="../../frame/css/index_left.css">
</head>
<body>
    <?php
    $username=$_SESSION['username'];
    echo "管理员：$username<br>";
    ?>
    <a href="../login.php" target="_top">退出登录</a>
    <div class="main">
        <table>
            <tr>
                <td><a href="student_info.php" target="right">学生信息</a></td>
            </tr>
            <tr>
                <td><a href="teacher_info.php" target="right">教师信息</a></td>
            </tr>
            <tr>
                <td><a href="course_info.php" target="right">课程信息</a></td>
            </tr>
        </table>
    </div>
</body>
</html>