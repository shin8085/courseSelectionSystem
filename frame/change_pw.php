<!----------------修改密码界面------------------->
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
    <title>change_pw</title>
    <link rel="stylesheet" type="text/css" href="css/index_right.css">
</head>
<body>
    <div class="center">
        <form action="change_pw.php" method="post">
            <table>
                <tr height="30px">
                    <td>原密码</td>
                    <td><input type="password" name="oldpw"/></td>
                </tr>
                <tr height="30px">
                    <td>新密码</td>
                    <td><input type="password" name="newpw"/></td>
                </tr>
                <tr height="30px">
                    <td>再次输入</td>
                    <td><input type="password" name="newpwagain"/></td>
                </tr>
                <tr height="30px">
                    <td></td>
                    <td>
                        <input type="submit" name="change" value="修改" style="margin:0 30px;"/>
                        <input type="reset" value="取消"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(@$_POST['change']=="修改"){
            $username=$_SESSION['username'];
            $status=$_SESSION['status'];
            $oldpw=$_POST['oldpw']; //旧密码
            $newpw=$_POST['newpw'];  //新密码
            $newpwagin=$_POST['newpwagain'];
            $sf->changePassWord($oldpw,$newpw,$newpwagin);
        }
        ?>
    </div>
</body>
</html>