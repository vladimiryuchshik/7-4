<?php
session_start();
require "dbconnect.php";
if(isset($_POST['parol']))
{
$res=mysql_query("SELECT idu, status FROM user WHERE login='".$_POST['login']."' AND password='".$_POST['password']."' AND udaluser=0");
if(mysql_num_rows($res))
{  
while($prise_mas=mysql_fetch_row($res))
{
if ($prise_mas[1]==1)
{
$_SESSION['admin']="$prise_mas[0]";
Header ("Location: admin/zavnewadmin.php");
}
if ($prise_mas[1]==2)
{
$_SESSION['user']="$prise_mas[0]";
Header ("Location: zav.php");
}
if ($prise_mas[1]==3)
{
$_SESSION['disp']="$prise_mas[0]";
Header ("Location: disp/dispzav.php");
}
if ($prise_mas[1]==4)
{
$_SESSION['ispolnit']="$prise_mas[0]";
Header ("Location: isp/ispzav.php");
}
}
}
else
{    //такого пользователя нет
echo "<center><br><br>Введены неверные логин или пароль<br><br> <span><a href='index.php'>Попробуйте еще раз</a></span> <br> или обратитесь к администратору системы<br>
";
}
}
?>
