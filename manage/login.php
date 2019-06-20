<!----------------管理员登录界面------------------->
<?php
include "../inc/sqlfunction.php";
$sf=new sqlfunction;
$_SESSION['username']="";
$_SESSION['status']="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登入</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <div class="center">
        <form action="login.php" method="POST">
            <table>
                <tr height="50px">
                    <td colspan="2" align="center">
                        <h2>学生选课后台管理系统</h2>
                    </td>
                </tr>
                <tr height="30px">
                    <td>账号：</td><td><input type="text" name="username" autocomplete="off"/></td>
                </tr>
                <tr height="30px">
                    <td>密码：</td><td><input type="password" name="password" /></td>
                </tr>
                <tr height="30px">
                    <td></td>
                    <td>
                        <input type="submit" name="loginin" value="登录" style="margin:0 30px;">
                        <input type="reset" name="cancel" value="取消">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(@$_POST['loginin']=="登录"){
            $username=$_POST['username']; //获取管理员账号
            $password=$_POST['password']; //获取管理员密码
            $sf->login($username,$password,"admin");
        }
        ?>
    </div>
</body>
</html>