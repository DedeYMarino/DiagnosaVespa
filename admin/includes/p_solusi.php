<?php

$link_list='?hal=data_pilihan';
$link_update='?hal=update_solusi';

$daftar='';$no=0;
$q="select * from solusi order by kode";
$q=mysql_query($q);
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$no++;
		$id=$h['kode'];
		$allow_del=true;
		if(mysql_num_rows(mysql_query("select * from solusi where kode='".$id."' limit 0,1"))>0){$allow_del=false;}
		if($allow_del){
			$disabled='';
			$delete_link='DeleteConfirm(\''.$link_update.'&amp;id='.$id.'&amp;action=delete\');';
		}else{
			$disabled='disabled';
			$delete_link='';
		}
		$daftar.='
		  <tr>
			<td style="text-align:center;">'.$no.'</td>
			<td>'.$h['kode'].'</td>
            <td>'.$h['kd_sol'].'</td>
			<td>'.$h['solusi'].'</td>
			<td style="text-align:center;">
			<a href="'.$link_update.'&amp;id='.$id.'&amp;action=edit" class="btn"><i class="icon-edit"></i></a> 
			<a href="#" onclick="'.$delete_link.'return(false);" class="btn '.$disabled.'"><i class="icon-trash"></i></a>
			</td>
		  </tr>
		';
	}
}


?>
<script language="javascript">
function DeleteConfirm(url){
	if (confirm("Anda yakin akan menghapus data ini ?")){
		window.location.href=url;
	}
}
</script>

<h3 class="p2">Data Solusi</h3>
<div style="clear:both;height:20px;"></div>
<a href="<?php echo $link_update;?>" class="btn blue" style="float:right"><i class="icon-plus"></i> Tambah data Solusi</a><br /><br />
<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th style="text-align:center;" width="30">NO</th>
			<th style="text-align:center;" width="50">KODE PILIHAN</th>
            <th style="text-align:center;" width="50">KODE SOLUSI</th>
			<th style="text-align:center;">NAMA SOLUSI</th>
			<th width="90">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
