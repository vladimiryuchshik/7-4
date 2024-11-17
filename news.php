<?php session_start();
?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'> 
   
<html xmlns='http://www.w3.org/1999/xhtml'> 
 
<head> 
<meta http-equiv='content-type' content='text/html; charset=windows-1251' /> 

<title><?php include "name.php"; 
echo $title;
?>
</title> 

<style type="text/css">
body {
  position: relative;
  margin: 0;
  padding: 0;
  font-family: Georgia, Times, "Times New Roman", serif;
  font-size: 9pt;
  color: #000;
}
.border {
  float: left;
  margin: 10px 0 0 5px;
}
label {
  padding-left: 5px;
}
select {
  width: 130px;
  font-family: Georgia, Times, "Times New Roman", serif;
  font-size: 9pt;
  color: #000;
}
</style>


 	 <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.7.2.custom.css">
	  <link rel="stylesheet" type="text/css" href="css/style.css">
	  <link rel="stylesheet" href="css/jquery.treeview.css" />

  
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui.datepicker-uk.js"></script>
	 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
	 <script type="text/javascript" src="js/forma.js"></script>
     <script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
	 <script type="text/javascript" src="js/tiny.js"></script>
	 <script src="js/jquery-1.3.1.js" type="text/javascript"></script>
	 
	 <script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>

	 <script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
			</script>
	
</head> 
 
<body> 
   <?php include "menu.php"; ?>

    <div id='content'> 
		<div id='content1'>
		<!-- вот здесь вся инфа--> 
		<br>

<br>
<table> <tr> <td width="300" VALIGN="top">
<div class="text-left1"> 
<div id="sidetree">
<div class="treeheader">&nbsp;</div>
<div id="sidetreecontrol"><a href="?#">Свернуть все</a> | <a href="?#">Развернуть все</a></div>

<ul id="tree">

<?php 
require "dbconnect.php";
$namec=mysql_query("select namer, logor, idr from razdel where udalr!='1' and tipr='1'");
while($sod_mas1=mysql_fetch_row($namec))
{
$kolv=mysql_query("select count(idn) from news where newsrazdel=$sod_mas1[2]");
while($kolv1=mysql_fetch_row($kolv))
{
$kolv2=$kolv1[0];
}
 echo "<li><table> <tr>  <td>  <img src='image/$sod_mas1[1]' WIDTH='30' HEIGHT='30' />$sod_mas1[0] <u class='reg'> ($kolv2)</u> </td> <td>  
 <form   method='post' name='udalpod' >
<INPUT TYPE='hidden' NAME='udalpod' VALUE='$sod_mas1[2]'>
<input type='image' src='image/search.png' TITLE='Смотреть новости раздела' WIDTH='15' HEIGHT='15' >
</form>  </td> </tr> </table> 

 <ul>";
 $namec1=mysql_query("select namer, idr from razdel where udalr!='1' and tipr='2' and podraz=$sod_mas1[2]");
while($sod_mas2=mysql_fetch_row($namec1))
{
$kolvo=mysql_query("select count(idn) from news where newsrazdel=$sod_mas2[1] and udaln!=1 ");
while($kolvo1=mysql_fetch_row($kolvo))
{
$kolvo2=$kolvo1[0];
}
echo "<li> <table> <tr>  <td> $sod_mas2[0] <u class='kvit'> ($kolvo2) </u> </td> <td> <form   method='post' name='udalpod' >
<INPUT TYPE='hidden' NAME='udalpod' VALUE='$sod_mas2[1]'>
<input type='image' src='image/search.png' TITLE='Смотреть новости раздела' WIDTH='15' HEIGHT='15' >
</form> </td> </tr> </table></li>
";
}
echo "</ul>";
}
echo "</li>";
?>
	
</ul>
</div>

</div>
</div>
 </td>
<td width="600" VALIGN="top">
<?php 
if(isset($_POST['udalpod']))
{
$pokaz=mysql_query("SELECT idn FROM `news` where udaln!=1 and newsrazdel='".$_POST['udalpod']."'");
$pokaz1=mysql_num_rows($pokaz);
if ($pokaz1>0)
{
$res_id=mysql_query("SELECT idn, daten, zagn, bodyn  FROM `news` where udaln!=1 and newsrazdel='".$_POST['udalpod']."'  ORDER BY daten");
while($news=mysql_fetch_row($res_id))
{
echo "<table width='590' > <tr>
<td width='100' class='kvit'> $news[1] </td>
<td class='zag3' width='300'> $news[2] </td>
</tr>
<tr >
<td class='tr' colspan='2'>$news[3] </td>
</tr>
</table>\n
<div class='line1'></div>";
} 
}
if ($pokaz1==0)
{
echo "<p class='but1'> В данном разделе пока нет новостей </p>";
}
}
else
{
$res_id=mysql_query("SELECT idn, daten, zagn, bodyn  FROM `news` where udaln!=1 and newsrazdel=(select MAX(newsrazdel) from news where udaln!=1)  ORDER BY daten");
while($news=mysql_fetch_row($res_id))
{
echo "<table width='590' > <tr>
<td width='100' class='kvit'> $news[1] </td>
<td class='zag3' width='300'> $news[2] </td>
</tr>
<tr >
<td class='tr' colspan='2'>$news[3] </td>
</tr>
</table>\n
<div class='line1'></div>";
}
}
?>

  </td> </tr> </table>





			<br>

<br>
</body> 
 </html>