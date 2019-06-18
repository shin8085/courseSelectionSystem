<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index_left</title>
</head>
<body>
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