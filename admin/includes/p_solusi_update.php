<?php
$link_list='?hal=data_solusi';
$link_update='?hal=update_solusi';

if(isset($_POST['save'])){
	$action=$_POST['action'];
	$kode_pilihan=$_POST['kode_pilihan'];
    $kode_solusi=$_POST['kode_solusi'];
	$solusi=$_POST['solusi'];
	
	if(empty($kode_pilihan) or empty($kode_solusi) or empty($solusi)){
		$error='Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	}else{
		if($action=='add'){
			if(mysql_num_rows(mysql_query("select * from solusi where kode='".$kode_pilihan."'"))>0){
				$error='Kode sudah terdaftar. Silahkan gunakan kode yang lain.';
			}else{
				$q="insert into solusi(kode,kd_sol,solusi) values('".$kode_pilihan."','".$kode_solusi."','".$solusi."')";
				mysql_query($q);
				exit("<script>location.href='".$link_list."';</script>");
			}
		}
		if($action=='edit'){
			$q=mysql_query("select * from solusi where kode='".$kode_pilihan."'");
			$h=mysql_fetch_array($q);
			$kode_tmp=$h['kode'];
			if(mysql_num_rows(mysql_query("select * from solusi where kode='".$kode_pilihan."' and kode<>'".$kode_tmp."'"))>0){
				$error='Kode sudah terdaftar. Silahkan gunakan kode yang lain.';
			}else{
				$q="update solusi set kd_sol='".$kode_solusi."', solusi='".$solusi."' where kode='".$kode_pilihan."'";
				mysql_query($q);
				exit("<script>location.href='".$link_list."';</script>");
			}
		}
		
	}
}else{
	$kode_pilihan='';
    $kode_solusi='';
    $solusi='';
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$kode_pilihan=$_GET['id'];
		$q=mysql_query("select * from solusi where kode='".$kode_pilihan."'");
		$h=mysql_fetch_array($q);
		$kode_solusi=$h['kd_sol'];
		$solusi=$h['solusi'];
	}
	if($action=='delete'){
		$kode_pilihan=$_GET['id'];
		mysql_query("delete from solusi where kode='".$kode_pilihan."'");
		exit("<script>location.href='".$link_list."';</script>");
	}
}


?>

<h3 class="p2">Update Data Solusi</h3>
<div style="clear:both;height:20px;"></div>
<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo $kode_pilihan;?>">
<input name="action" type="hidden" value="<?php echo $action;?>">
<?php
if(!empty($error)){
	echo '
	   <div class="alert alert-error ">
		  '.$error.'
	   </div>
	';
}
?>

<table class="table">
  <tr>
	<td width="120">Kode pilihan<span class="required">*</span> </td>
	<td><input name="kode_pilihan" type="text" size="40" value="<?php echo $kode_pilihan;?>" class="m-wrap large"></td>
  </tr>
  <tr>
	<td width="120">Kode Solusi<span class="required">*</span> </td>
	<td><input name="kode_solusi" type="text" size="40" value="<?php echo $kode_solusi;?>" class="m-wrap large"></td>
  </tr>
  <tr>
	<td>Nama solusi<span class="required">*</span> </td>
	<td><input name="solusi" type="text" size="40" value="<?php echo $solusi;?>" class="m-wrap large"></td>
  </tr>
  <tr>
	<td></td>
	<td><button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button> 
	<button type="button" name="cancel" class="btn" onclick="location.href='<?php echo $link_list;?>'">Batal</button></td>
  </tr>
</table>
</form>
