<?php
$page='';
$str_hal='';
if(isset($_GET['hal'])){
	$page=$_GET['hal'];
	$str_hal=$_GET['hal'];
}
switch($page){
	case 'data_pilihan':$page="include 'includes/p_pilihan.php';";break;
	case 'p_pilihan_update':$page="include 'includes/p_pilihan_update.php';";break;
	case 'data_kriteria':$page="include 'includes/p_kriteria.php';";break;
	case 'p_kriteria_update':$page="include 'includes/p_kriteria_update.php';";break;
	case 'data_solusi':$page="include 'includes/p_solusi.php';";break;
	case 'update_solusi':$page="include 'includes/p_solusi_update.php';";break;
    case 'data_pengetahuan':$page="include 'includes/p_pengetahuan.php';";break;
	case 'p_pengetahuan_update':$page="include 'includes/p_pengetahuan_update.php';";break;
	case 'diagnosa':$page="include 'includes/p_diagnosa.php';";break;
	case 'hasil':$page="include 'includes/p_hasil.php';";break;
	case 'ubah_password':$page="include 'includes/p_ubah_password.php';";break;

	default:
		$page="include 'includes/p_home.php';";
		break;
}
$CONTENT_["main"]=$page;

?>