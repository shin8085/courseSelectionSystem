<!----------------学生/教师登录界面------------------->
<?php
include "inc/sqlfunction.php";
$sf=new sqlfunction;
@$_SESSION['username']=""; //用户名（学号/教师编号）
@$_SESSION['status']=""; //身份（学生/老师—）
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="center">
        <form action="login.php" method="POST">
            <table>
                <tr height="50px">
                    <td colspan="2">
                        <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登录选课系统</h2>
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
                        <select name="status">
                            <option value="student">学生</option>
                            <option value="teacher">教师</option>
                        </select>
                    </td>
                </tr>
                <tr height="30px">
                    <td></td>
                    <td>
                        <input type="submit" name="loginin" value="登录" style="margin:0 30px;">
                        <input type="submit" name="signup" value="注册">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(@$_POST["loginin"]=="登录"){
                $username=@$_POST['username']; //获取账号
                $password=@$_POST['password']; //获取密码
                $status=@$_POST['status']; //获取用户身份
                if(@$username!=""&&@$password!=""){
                    $sf->login($username,$password,$status); //登录
                }
                else
                    echo "账号和密码均不能为空";
            }
            else if(@$_POST["signup"]=="注册"){
                header("location:register.php");
            }
        ?>
    </div>
</body>
</html>