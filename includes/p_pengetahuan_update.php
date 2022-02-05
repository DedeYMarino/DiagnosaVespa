<?php
$link_list='?hal=data_pengetahuan';
$link_update='?hal=update_pengetahuan';

if(isset($_POST['save'])){
	$id=$_POST['id'];
	$action=$_POST['action'];
	$id_pilihan=$_POST['pilihan'];
	$id_kriteria=$_POST['kriteria'];
	$mb=$_POST['mb'];
	$md=$_POST['md'];
	
	if(empty($id_pilihan) or empty($id_kriteria) or empty($mb) or empty($md)){
		$error='Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	}else{
		if($action=='add'){
			if(mysql_num_rows(mysql_query("select * from pengetahuan where id_pilihan='".$id_pilihan."' and id_kriteria='".$id_kriteria."'"))>0){
				$error='Basis pengetahuan sudah terdaftar sebelumnya. Silahkan gunakan basis pengetahuan yang lain.';
			}else{
				$q="insert into pengetahuan(id_pilihan, id_kriteria, mb, md) values('".$id_pilihan."', '".$id_kriteria."', '".($mb/10)."', '".($md/10)."')";
				mysql_query($q);
				exit("<script>location.href='".$link_list."';</script>");
			}
		}
		if($action=='edit'){
			$q=mysql_query("select * from pengetahuan where id_pengetahuan='".$id."'");
			$h=mysql_fetch_array($q);
			$id_pilihan_tmp=$h['id_pilihan'];
			$id_kriteria_tmp=$h['id_kriteria'];
			if(mysql_num_rows(mysql_query("select * from pengetahuan where id_pilihan='".$id_pilihan."' and id_pilihan<>'".$id_pilihan_tmp."' and id_kriteria='".$id_kriteria."' and id_kriteria<>'".$id_kriteria_tmp."'"))>0){
				$error='Basis pengetahuan sudah terdaftar sebelumnya. Silahkan gunakan basis pengetahuan yang lain.';
			}else{
				$q="update pengetahuan set id_pilihan='".$id_pilihan."', id_kriteria='".$id_kriteria."', mb='".$mb."', md='".$md."' where id_pengetahuan='".$id."'";
				mysql_query($q);
				exit("<script>location.href='".$link_list."';</script>");
			}
		}
		
	}
}else{
	$id_pilihan='';$id_kriteria='';$mb='';$md='';
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysql_query("select * from pengetahuan where id_pengetahuan='".$id."'");
		$h=mysql_fetch_array($q);
		$id_pilihan=$h['id_pilihan'];
		$id_kriteria=$h['id_kriteria'];
		$mb=$h['mb'];
		$md=$h['md'];
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysql_query("delete from pengetahuan where id_pengetahuan='".$id."'");
		exit("<script>location.href='".$link_list."';</script>");
	}
}

$list_pilihan='';
$q=mysql_query("select * from pilihan order by kode");
while($h=mysql_fetch_array($q)){
	if($h['id_pilihan']==$id_pilihan){$s='selected';}else{$s='';}
	$list_pilihan.='<option value="'.$h['id_pilihan'].'" '.$s.'>'.$h['nama'].'</option>';
}
$list_kriteria='';
$q=mysql_query("select * from kriteria order by kode");
while($h=mysql_fetch_array($q)){
	if($h['id_kriteria']==$id_kriteria){$s='selected';}else{$s='';}
	$list_kriteria.='<option value="'.$h['id_kriteria'].'" '.$s.'>'.$h['nama'].'</option>';
}

?>

<h3 class="p2">Update Data Basis Pengetahuan</h3>
<div style="clear:both;height:20px;"></div>
<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo $id;?>">
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
	<td width="120">Pilihan<span class="required">*</span> </td>
	<td><select name="pilihan"><option value=""></option><?php echo $list_pilihan;?></select></td>
  </tr>
  <tr>
	<td>Kriteria<span class="required">*</span> </td>
	<td><select name="kriteria"><option value=""></option><?php echo $list_kriteria;?></select></td>
  </tr>
  
  <tr>
	<td>MB<span class="required">*</span> </td>
	<td><input name="mb" type="text" size="40" value="<?php echo $mb;?>" class="m-wrap large" style="width:50px;"></td>
  </tr>
  <tr>
	<td>MD<span class="required">*</span> </td>
	<td><input name="md" type="text" size="40" value="<?php echo $md;?>" class="m-wrap large" style="width:50px;"></td>
  </tr>
  <tr>
	<td></td>
	<td><button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button> 
	<button type="button" name="cancel" class="btn" onclick="location.href='<?php echo $link_list;?>'">Batal</button></td>
  </tr>
</table>
</form>
