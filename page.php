<?php
$page='';
$str_hal='';
if(isset($_GET['hal'])){
	$page=$_GET['hal'];
	$str_hal=$_GET['hal'];
}
switch($page){
	case 'pemilihan':$page="include 'includes/p_pemilihan.php';";break;
	case 'hasil':$page="include 'includes/p_hasil.php';";break;
	default:
		$page="include 'includes/p_home.php';";
		break;
}
$CONTENT_["main"]=$page;

?>