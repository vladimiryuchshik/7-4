<?php
session_start();
?>
<?php 
$_SESSION['var']=0; /* ������������ ������� �������� */
session_destroy();
Header ("Location: index.php"); /*  �������������� �� ������� �������� ������� */
?>
<!-- ���� ����������� ������  -->. 
