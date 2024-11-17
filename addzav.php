<?php 
		session_start();
?>
<?php
   require "dbconnect.php";
if(isset($_POST['zav']))
{
echo $_SESSION['chat'];
$user=$_SESSION['user'];
setlocale (LC_ALL, "ru_RU.CP1251");
$ttt=date("dmyGis", time());
/* echo $_FILES['filename']['name'];*/

if(!empty($_FILES['filename']['name']))
{
if($_FILES["filename"]["size"] > 12800000). 
   {
echo ("Размер файла превышает 128 кбайт");
     exit;
   };
if(copy($_FILES["filename"]["tmp_name"],"C:/WebServers/home/localhost/www/helpdesk/download/".$ttt.$_FILES["filename"]["name"])) 
{
   $link=$ttt.$_FILES["filename"]["name"];
}
}
else {
$link=0;
}
$today = date("Y-m-d H:i:s");
$activ=2;
$query1="insert into zav (`namezav`, desczav, priorzav, activzav, katzav, filezav, iduzav, commzav, datedl) 
values ('".$_POST['namezav']."','".$_POST['desczav']."', '".$_POST['priorzav']."',$activ,'".$_POST['katzav']."','$link','$user', '".$_POST['commzav']."', '".$_POST['datedl']."')";
$query2=mysql_query("select max(idzav) from zav");
$zav=mysql_num_rows($query2);
			while ($zav=mysql_fetch_row($query2))
			{
			$numzav=$zav[0];
			}
$query3="insert into status (`nomzav`, openz, flag, iduopen) 
values ('$numzav'+1,'$today', '1','$user')";
if(mysql_query($query1) and mysql_query($query3)) 
{
Header ("Location: zav.php");
}
else
{
echo "<p class='log'></p>Не получилось</p>";   
}
 
 } 
?> 
