<?php

include "inc/mysql.php";

echo ">>>>>>>>>>>>>>>开始进行数据库初始化<<<<<<<<<<<<<<<<br>";
$ms=new mysql;

$ms->link();
$ms->create("course_select_database");
echo "------------数据表创建---------------<br>";

$sql="create table admin(
    Ano varchar(10) not null unique,
    Apw varchar(10) not null
)";
$ms->excu($sql);
echo "数据表admin创建成功<br>";

$sql="create table studentuser(
    Sno varchar(10) not null primary key unique,
    Spw varchar(10) not null
)";
$ms->excu($sql);
echo "数据表studentuser创建成功<br>";

$sql="create table teacheruser(
    Tno varchar(10) not null primary key unique,
    Spw varchar(10) not null
)";
$ms->excu($sql);
echo "数据表teacheruser创建成功<br>";

$sql="create table Student(
    Sno varchar(10) not null primary key unique,
    Sname varchar(10),
    Sage date,
    Ssex varchar(10),
    constraint kf_student_studentuser foreign key(Sno) references studentuser(Sno)
    )";
$ms->excu($sql);
echo "数据表Student创建成功<br>";

$sql="create table Teacher(
    Tno varchar(10) not null primary key unique,
    Tname nvarchar(10),
    Tage date,
    Tsex varchar(10),
    constraint kf_teacher_teacheruser foreign key(Tno) references teacheruser(Tno)
    )";
$ms->excu($sql);
echo "数据表Teacher创建成功<br>";

$sql="create table Course(
    Cno varchar(10) not null primary key unique auto_increment,
    Cname nvarchar(10),
    Csite varchar(20),
    Ctime varchar(10),
    Tno varchar(10),
    constraint fk_course_teacher foreign key(tno) references teacher(tno)
    )";
$ms->excu($sql);
echo "数据表Course创建成功<br>";

$sql="create table SC(
    Sno varchar(10) not null,
    Cno varchar(10) not null,
    score decimal(18,1),
    constraint fk_sc_student foreign key(Sno) references student(sno),
    constraint fk_sc_course  foreign key(Cno) references Course(cno)
    )";
$ms->excu($sql);
echo "数据表SC创建成功<br>";
echo "------------数据表初始化---------------<br>";

$ms->excu("insert into admin value('admin','admin')");
echo "数据表admin初始化数据加载成功<br>";

$ms->excu("insert into studentuser values('01','123456'),
    ('02','123456'),
    ('03','123456'),
    ('04','123456'),
    ('05','123456'),
    ('06','123456'),
    ('07','123456'),
    ('08','123456')");
echo "数据表studentuser初始化数据加载成功<br>";

$ms->excu("insert into teacheruser values('01','123456'),
    ('02','123456'),
    ('03','123456')");
echo "数据表teacheruser初始化数据加载成功<br>";

$ms->excu("insert into Student values('01' , '赵雷' , '1990-01-01' , '男')");
$ms->excu("insert into Student values('02' , '钱电' , '1990-12-21' , '男')");
$ms->excu("insert into Student values('03' , '孙风' , '1990-05-20' , '男')");
$ms->excu("insert into Student values('04' , '李云' , '1990-08-06' , '男')");
$ms->excu("insert into Student values('05' , '周梅' , '1991-12-01' , '女')");
$ms->excu("insert into Student values('06' , '吴兰' , '1992-03-01' , '女')");
$ms->excu("insert into Student values('07' , '郑竹' , '1989-07-01' , '女')");
$ms->excu("insert into Student values('08' , '王菊' , '1990-01-20' , '女')");
echo "数据表Student初始化数据加载成功<br>";

$ms->excu("insert into Teacher values('01' , '张三','1978-12-03','男')");
$ms->excu("insert into Teacher values('02' , '李四','1985-05-06','男')");
$ms->excu("insert into Teacher values('03' , '王五','1977-06-23','男')");
echo "数据表Teacher初始化数据加载成功<br>";

$ms->excu("insert into Course values('01' , '语文' ,'C5-103', '周四1-2节','02')");
$ms->excu("insert into Course values('02' , '数学' ,'C5-103', '周五6-7节','01')");
$ms->excu("insert into Course values('03' , '英语' ,'C5-103', '周一3-4节','03')");
echo "数据表Course初始化数据加载成功<br>";

$ms->excu("insert into SC values('01' , '01' , 80)");
$ms->excu("insert into SC values('01' , '02' , 90)");
$ms->excu("insert into SC values('01' , '03' , 99)");
$ms->excu("insert into SC values('02' , '01' , 70)");
$ms->excu("insert into SC values('02' , '02' , 60)");
$ms->excu("insert into SC values('02' , '03' , 80)");
$ms->excu("insert into SC values('03' , '01' , 80)");
$ms->excu("insert into SC values('03' , '02' , 80)");
$ms->excu("insert into SC values('03' , '03' , 80)");
$ms->excu("insert into SC values('04' , '01' , 50)");
$ms->excu("insert into SC values('04' , '02' , 30)");
$ms->excu("insert into SC values('04' , '03' , 20)");
$ms->excu("insert into SC values('05' , '01' , 76)");
$ms->excu("insert into SC values('05' , '02' , 87)");
$ms->excu("insert into SC values('06' , '01' , 31)");
$ms->excu("insert into SC values('06' , '03' , 34)");
$ms->excu("insert into SC values('07' , '02' , 89)");
$ms->excu("insert into SC values('07' , '03' , 98)");
echo "数据表SC初始化数据加载成功<br>";

echo ">>>>>>>>>>>>>>>数据库初始化完成<<<<<<<<<<<<<<<<br>";
?>