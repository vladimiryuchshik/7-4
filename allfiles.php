<?php session_start();
?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'> 
 
<html xmlns='http://www.w3.org/1999/xhtml'> 
 
<head> 
<meta http-equiv='content-type' content='text/html; charset=windows-1251' /> 

<title><?php include "name.php"; 
echo $title;  
?>
</title> 

 	 <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.7.2.custom.css">
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui.datepicker-uk.js"></script>
	 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
	 <script type="text/javascript" src="js/forma.js"></script>
	    <script type="text/javascript" src="js/highslide/highslide-with-html.js"></script>
	 <link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
	 
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

<br> 
<table width="100%" border="1" cellspacing="5" cellpadding="5">
  <tr>
    <th colspan='3' align='left'><h3> Список требований и функций проекта №
	<?php 
require "dbconnect.php";
if(isset($_POST['allfile'])) 
{
$nomfileav=$_POST['allfile'];
$_SESSION['nomfileav']=$nomfileav;
echo $nomfileav;
}
?>	</h3></th>
  </tr>
  </table>
<?php
require "dbconnect.php";
$nomfileav=$_SESSION['nomfileav'];
$sod1=mysql_query("SELECT count(idfile )
FROM `file` WHERE  filezav='$nomfileav' and udalfile=0");
while($sod_mas1=mysql_fetch_row($sod1))
{
$kolvo=$sod_mas1[0];
if ($kolvo>0)
{
echo "<table border='0' align='center' width='300'><tr><td class='table1'> Всего загружено требований &nbsp;<b>$kolvo</b></td></tr> </table>\n";
}
else
{
echo "<table border='0' align='center' width='300'><tr><td class='table1'> Требований к проекту нет &nbsp;</td></tr> </table>\n";
}
}
$res=mysql_query("SELECT `idfile`, `namefile`, `filezav`, `datefile`, `descfile`, `linkfile` FROM `file` WHERE  filezav='$nomfileav' and udalfile=0");
$a=1;
while($res_id=mysql_fetch_row($res))
{

echo " <center> <table> <tr>
<td width='30' class='but1'> <b> $a </b> </td>
<td width='200' class='tz'> $res_id[1] </td>
<td width='100' class='tz'> $res_id[3] </td>
<td width='200' class='tz'> $res_id[4] </td> 
<td width='100' class='tz'> <a href='download/$res_id[5]' >
<img src='image/sk.png' TITLE='Скачать файл с требованиями' WIDTH='30' HEIGHT='30' border='0'>
</a> </td>

<td width='45' class=''><form   method='post' name='udalfile' action='udal.php'>
<INPUT TYPE='hidden' NAME='udalfile' VALUE='$res_id[0]'>
<input type='image' src='image/delete.png' TITLE='Удалить требование' WIDTH='30' HEIGHT='30' >
</form>
</td> 
</tr> </table>\n";
$a=$a+1;
}    

?>	


<?php
require "dbconnect.php";
$nomfileav=$_SESSION['nomfileav'];
$sod1=mysql_query("SELECT count(idfile1 )
FROM `file1` WHERE  filezav1='$nomfileav' and udalfile1=0");
while($sod_mas1=mysql_fetch_row($sod1))
{
$kolvo=$sod_mas1[0];
if ($kolvo>0)
{
echo "<table border='0' align='center' width='300'><tr><td class='table1'> Всего загружено функций &nbsp;<b>$kolvo</b></td></tr> </table>\n";
}
else
{
echo "<table border='0' align='center' width='300'><tr><td class='table1'> Функций к проекту нет &nbsp;</td></tr> </table>\n";
}
}
$res=mysql_query("SELECT `idfile1`, `namefile1`, `filezav1`, `datefile1`, `descfile1`, `linkfile1` FROM `file1` WHERE  filezav1='$nomfileav' and udalfile1=0");
$a=1;
while($res_id=mysql_fetch_row($res))
{

echo " <center> <table> <tr>
<td width='30' class='but1'> <b> $a </b> </td>
<td width='200' class='tz'> $res_id[1] </td>
<td width='100' class='tz'> $res_id[3] </td>
<td width='200' class='tz'> $res_id[4] </td> 
<td width='100' class='tz'> <a href='download/$res_id[5]' >
<img src='image/sk.png' TITLE='Скачать файл с функциями' WIDTH='30' HEIGHT='30' border='0'>
</a> </td>

<td width='45' class=''><form   method='post' name='udalfile1' action='udal.php'>
<INPUT TYPE='hidden' NAME='udalfile1' VALUE='$res_id[0]'>
<input type='image' src='image/delete.png' TITLE='Удалить функцию' WIDTH='30' HEIGHT='30' >
</form>
</td> 
</tr> </table>\n";
$a=$a+1;
}    

?>	
</td>
	


   </div> 
            </div> 
			<br>

<br>
</body> 
 </html>