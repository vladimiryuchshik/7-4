<?php
$id_con=mysql_connect("localhost", "root", "")
or die("���������� ����������� � ��������");
mysql_select_db("2407") or die("���������� ������� ��");
mysql_query("set names cp1251");
mysql_query("set character_set_server=cp1251"); 
?>
