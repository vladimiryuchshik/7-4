<?php session_start();
?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'> 
 
<html xmlns='http://www.w3.org/1999/xhtml'> 
 
<head> 
<meta http-equiv='content-type' content='text/html; charset=windows-1251' /> 

<title><?php include "name.php";   
echo $title;
?>
</title> 

 	 <link rel="stylesheet" type="text/css" href="../js/jquery-ui-1.7.2.custom.css">
	  <link rel="stylesheet" type="text/css" href="../style.css">
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-uk.js"></script>
	 <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
	 <script type="text/javascript" src="../js/forma.js"></script>
     <script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
	 <script type="text/javascript" src="../js/tiny.js"></script>
</head> 
 
<body> 
   <?php include "menu.php"; ?>

    <div id='content'> 
		<div id='content1'>
		<!-- вот здесь вся инфа--> 
		<br>
			<?php 
require "dbconnect.php";
$user=$_SESSION['user'];
$sod1=mysql_query("SELECT count( ida )
FROM activ, otdel, user where dela=0 and idoa=iduserotd and idoa=ido and idu='{$_SESSION['user']}'
");
while($sod_mas1=mysql_fetch_row($sod1))
{
$kolvo=$sod_mas1[0];
}
if ($kolvo>0)
{
echo "<table border='0' align='center' width='900'><tr><td class='table1'> Всего кабинетов  &nbsp;<b>$kolvo</b></td></tr> </table>\n";
}
?>
<?php
require "dbconnect.php";
$res=mysql_query("SELECT ida,nameo, nomkab FROM `activ`, otdel, user where dela=0 and idoa=ido and ido=iduserotd and idu='{$_SESSION['user']}'");
while($res_id=mysql_fetch_row($res))
{
echo " <center> <table> <tr>
<td width='45' class='tz'> $res_id[0] </td>
<td width='200' class='tz'> $res_id[1] </td>
<td width='50' class='tz'> $res_id[2] </td>

</tr> </table>\n";
}    
?>	
<br> 

<?php
require "dbconnect.php";
$res1=mysql_query("SELECT idpk, `namepk`,  datepk FROM `pk`, user where udalpk=0 and idpk=idpkuser and idu='{$_SESSION['user']}'");
while($res_id=mysql_fetch_row($res1))
{
$res=mysql_query("SELECT `namemat`,`nameproz`, namevideo, namemon, nameklava, nameblok, namemouse, namekorpus, nameweb, nameos, namevint, nameoper 
from pk,  mat, klava, proz, mouse, mon, korpus, video, vint, blok, os, web, oper where  idpk='$res_id[0]' and `matpk`=idmat and `prozpk`=idproz and videopk=idvideo and  monpk=idmon and klavapk=idklava and blokpk=idblok and mousepk=idmouse and korpuspk=idkorpus and webpk=idweb and ospk=idos and vintpk=idvint and operpk=idoper ");
while($sod=mysql_fetch_row($res))
{
$sod1=$sod[0];
$sod2=$sod[1];
$sod3=$sod[2];
$sod4=$sod[3];
$sod5=$sod[4];
$sod6=$sod[5];
$sod7=$sod[6];
$sod8=$sod[7];
$sod9=$sod[8];
$sod10=$sod[9];
$sod11=$sod[10];
$sod12=$sod[11];
 echo " <table border='0' align='center' width='900'><tr><td class='table1'> Конфигурация персонального компьютера <b>$res_id[1] </b> </td></tr> </table>
	<table width='650' border='1' cellspacing='2' cellpadding='2'>
  <tr>
    <td width='150' class='table'>&nbsp;&nbsp;Материнская карта</td>
    <td width='500' class='table'>$sod1</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Процессор</td>
    <td class='table'>$sod2</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Видео</td>
    <td class='table'>$sod3</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Монитор</td>
    <td class='table'>$sod4</td>
  </tr>
    <tr>
    <td class='table'> <span class='zzzzz'> &nbsp;&nbsp;Клавиатура </span></td>
    <td class='table'>$sod5</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Блок питания</td>
    <td class='table'>$sod6</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Мышь</td>
    <td class='table'>$sod7</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Корпус</td>
    <td class='table'>$sod8</td>
  </tr>
    <tr>
    <td width='80' class='table'>&nbsp;&nbsp;Веб-камера</td>
    <td width='270' class='table'>$sod9</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;ОС</td>
    <td class='table'>$sod10</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;Винчестер</td>
    <td class='table'>$sod11</td>
  </tr>
  <tr>
    <td class='table'>&nbsp;&nbsp;ОЗУ</td>
    <td class='table'>$sod12</td>
  </tr>
   </table>
</div>
</div>
</td>
<td class='$class' width='50'> <form   method='post' name='pk' action='udal.php'>
<INPUT TYPE='hidden' NAME='pk' VALUE='$res_id[0]'>
<input type='image' src='../image/delete.png' TITLE='Удалить конфигурацию' WIDTH='30' HEIGHT='30' >
</form> </td>

</tr> </table>\n";
$a=$a+1; 
}
}

?>	

   </div> 
            </div> 
			<br>

<br>
</body> 
 </html>