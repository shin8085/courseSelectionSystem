<!----------------学生/教师注册界面------------------->
<?php
include "inc/sqlfunction.php";
$sf=new sqlfunction;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
    <div class="center">
        <form action="register.php" method="post">
            <table>
                <tr height="50px">
                    <td align="center" colspan="2">
                        <h2>注册</h2>
                    </td>
                </tr>
                <tr height="30px">
                    <td>学号/编号</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr height="30px">
                    <td>密码</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr height="30px">
                    <td>再次输入</td>
                    <td><input type="password" name="password2"></td>
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
                    <td >
                        <input type="submit" name="register" value="注册" style="margin:0 30px;">
                        <input type="reset" name="cancel" value="取消">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(@$_POST['register']=='注册'){
            $username=@$_POST['username']; //获取账号
            $password=@$_POST['password']; //获取密码
            $password2=@$_POST['password2']; //获取再次输入的密码
            $status=@$_POST['status']; //获取用户身份
            $sf->register($username,$password,$password2,$status); //注册
        }
        ?>
    </div>
</body>
</html>