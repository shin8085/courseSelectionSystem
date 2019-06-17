<?php
include "../inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>change_pw</title>
</head>
<body>
    <form action="change_pw.php" method="post">
        <table>
            <tr>
                <td>原密码</td>
                <td><input type="password" name="oldpw"/></td>
            </tr>
            <tr>
                <td>新密码</td>
                <td><input type="password" name="newpw"/></td>
            </tr>
            <tr>
                <td>再次输入</td>
                <td><input type="password" name="newpwagain"/></td>
            </tr>
            <tr>
                <td><input type="submit" name="change" value="修改"/></td>
            </tr>
        </table>
    </form>
    <?php
    if(@$_POST['change']=="修改"){
        $username=$_SESSION['username'];
        $status=$_SESSION['status'];
        $oldpw=$_POST['oldpw'];
        $newpw=$_POST['newpw'];
        $newpwagin=$_POST['newpwagain'];
        $sf->changePassWord($oldpw,$newpw,$newpwagin);
    }
    ?>
</body>
</html>