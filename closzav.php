<?php session_start();
?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'> 
 
<html xmlns='http://www.w3.org/1999/xhtml'> 
 
<head> 
<meta http-equiv='content-type' content='text/html; charset=windows-1251' /> 

<title><?php include "name.php";   
echo $title;
?>
</title> 

<link rel='stylesheet' type='text/css' href='css/index.css' /> 


 	 <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.7.2.custom.css">
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="js/ui.datepicker-uk.js"></script>
	 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/rounded-corners-min.js"></script>
   <script type="text/javascript" src="js/forma.js"></script>
   
   <script type="text/javascript" src="js/highslide/highslide-with-html.js"></script>
	 <link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
	 
	 <link rel="stylesheet" type="text/css" href="css/style.css">
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <script type="text/javascript">
	hs.graphicsDir = 'js/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'draggable-header';
</script>
</head> 
 
<body> 
   <?php include "menu.php"; ?>

    <div id='content'> 
		<div id='content1'>
		<!-- вот здесь вся инфа--> 
<br> 
<table width="100%" border="1" cellspacing="5" cellpadding="5">
  <tr>
    <td valign="top" ><h3> Список закрытых заявок </h3></td> <td valign="top"> <?php 
require "dbconnect.php";
$user=$_SESSION['user'];
$sod1=mysql_query("SELECT count(idzav )
FROM status, zav 
WHERE  iduopen='$user' and flag=5 and deletz!=1 and idzav=nomzav and iduzav='$user'");
while($sod_mas1=mysql_fetch_row($sod1))
{
$kolvo=$sod_mas1[0];
}
if ($kolvo>0)
{
echo "<table border='0' align='center' width='300'><tr><td class='table1'> Всего закрытых заявок &nbsp;<b>$kolvo</b></td></tr> </table>\n";
}
else
{
echo "<table border='0' align='center' width='300'><tr><td class='table1'> Закрытых заявок нет &nbsp;</td></tr> </table>\n";
}
?>
 </td>
  </tr>
  <tr class="line">	<td colspan="2">&nbsp; </td>	</tr> </table>

<?php
require "dbconnect.php";
echo "<center> <table align='center' width='800'> 
<tr class='but2 tz'>  <td > № пп</td> <td> № проекта</td> <td> статус</td> <td> Срочность</td> <td> Файл</td> <td> Дата окончания</td>
<td> Содержание</td> <td> Подробно</td> <td> Исполнитель</td> <td> История</td> </tr>
";
$res1=mysql_query("SELECT idzav, `namezav`,  priorzav, desczav, activzav, katzav, filezav, commzav
FROM `zav`, status where iduzav='$user' and deletz!=1 and nomzav=idzav and flag=5");
$a=1;
while($res_id=mysql_fetch_row($res1))
{
$res=mysql_query("SELECT flag,openz, rasp, idrasp, 	proz, idproz, test,	idtest, clos, idclos from status where iduopen='$user' and nomzav='$res_id[0]'");
while($sod=mysql_fetch_row($res))
{
$sod1=$sod[1];
$sod2=$sod[2];
$sod3=$sod[4];
$sod4=$sod[6];
  $status="Закрыта";
$dat=$sod[8];
$logo="image/close.png";
$isp="<div>
<a href='index.htm' onclick='return hs.htmlExpand(this)'>
<img src='image/infoisp.png' TITLE='Информация об исполнителе' WIDTH='30' HEIGHT='30' border='0'>
</a>
<div class='highslide-maincontent'>
<h4>Подробные сведения об исполнителе заявки № $res_id[0]</h4>
	<table width='350' border='1' cellspacing='2' cellpadding='2'>
  <tr>
    <td width='250' class='but1'>&nbsp;&nbsp;Имя</td>
    <td width='100' class='table'>Иванов А. А.</td>
  </tr>
  <tr>
    <td class='but1'>&nbsp;&nbsp;Должность</td>
    <td class='table'>Специалист</td>
  </tr>
    </table>
</div>
</div>";

}
switch ($res_id[2]) {
case 1:
  $title="Низкий";
$pr="image/ballblue.png";
    break;
case 2:
  $title="Средний";
$pr="image/ballgreen.png";
    break;
	case 3:
  $title="Высокий";
$pr="image/ballyellow.png";
    break;
		case 4:
  $title="Критичный";
$pr="image/ballred.png";
    break;
}
if ($res_id[6]!=0)
{
$file="<a href='download/$res_id[6]' >
<img src='image/paperclip.png' TITLE='Скачать файл' WIDTH='30' HEIGHT='30' border='0'>
</a>";
}
else
{
$file="<img src='image/paperclip1.png' TITLE='Нет файла' WIDTH='30' HEIGHT='30' border='0'>";
}


 echo " 
 <tr>
<td width='30' class='but1'> <b> $a </b> </td>
<td width='50' class='tz'> $res_id[0] </td>
<td width='50' class='tz'> <img src='$logo' title='$status' WIDTH='30' HEIGHT='30' border='0'> </td>
<td width='50' class='tz'> <img src='$pr' title='$title' WIDTH='30' HEIGHT='30' border='0'> </td>
<td width='50' class='tz'> $file </td>
<td width='80' class='tz'> $dat </td>
<td width='200' class='tz'> $res_id[1] </td>
<td width='30' class='tz'> <div>
<a href='index.htm' onclick='return hs.htmlExpand(this)'>
<img src='image/info.png' TITLE='Подробная информация о заявке' WIDTH='30' HEIGHT='30' border='0'>
</a>
<div class='highslide-maincontent'>
<h4>Подробные сведения Заявка № $res_id[0]</h4>
	<table width='350' border='1' cellspacing='2' cellpadding='2'>
  <tr>
    <td width='250' class='table'>&nbsp;&nbsp;Описание</td>
    <td width='100' class='kvit'>$res_id[3]</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Кабинет</td>
    <td class='kvit'>$res_id[4]</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Категории</td>
    <td class='kvit'>$res_id[5]</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Комментарий</td>
    <td class='kvit'>$res_id[7]</td>
  </tr>
   </table>
</div>
</div>
</td>
<td width='30' class='tz'> $isp
</td>
<td width='30' class='tz'> <div>
<a href='index.htm' onclick='return hs.htmlExpand(this)'>
<img src='image/application-x-trash.png' TITLE='Жизненный цикл заявки' WIDTH='30' HEIGHT='30' border='0'>
</a>
<div class='highslide-maincontent'>
<h4>Жизненный цикл Заявка № $res_id[0]</h4>
	<table width='350' border='1' cellspacing='2' cellpadding='2'>
  <tr>
    <td width='100' class='table'>&nbsp;&nbsp;Открыта</td>
    <td width='150' class='kvit'>$sod1</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Распределена</td>
    <td class='kvit'>$sod2</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;В процессе (принята исполнителем)</td>
    <td class='kvit'>$sod3</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;На проверке</td>
    <td class='kvit'>$sod4</td>
  </tr>
   </table>
</div>
</div>
</td>
</tr> ";
$a=$a+1; 

}
echo "</table>\n";
?>	


   </div> 
            </div> 
			<br>

<br>
</body> 
 </html>