<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'certaintyfactor';

$web_host='http://localhost:8056/DiagnosaVespa/admin/';
$web_user='http://localhost:8056/DiagnosaVespa/';

$link=mysql_connect($db_host,$db_user,$db_password);
mysql_select_db($db_name,$link);

?>