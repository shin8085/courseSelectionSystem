<!----------------管理员主界面界面------------------->
<?php
if(!session_id()) session_start();
    if($_SESSION['username']==""){
        header("location:login.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理系统</title>
</head>

<frameset cols="15%,85%" border="false">
    <frame name="left" src="frame/index_left.php">
    <frame name="right" src="frame/student_info.php">
</frameset>

</html>