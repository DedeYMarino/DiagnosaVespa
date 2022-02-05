<?php
$link_list='?hal=pemilihan';

if(isset($_POST['submit'])){
	$kriteria='';
	if(isset($_POST['gejala'])){
		$kriteria=$_POST['gejala'];
	}
	if(empty($kriteria)){
		$error='Silahkan pilih gejala terlebih dahulu.';
	}else{
		$_SESSION['gejala']=$kriteria;
		exit("<script>location.href='?hal=hasil';</script>");
		
	}
}
if(isset($_POST['reset'])){
	if(isset($_SESSION['gejala'])){
		unset($_SESSION['gejala']);
	}
	exit("<script>location.href='?hal=pemilihan';</script>");
		
}

$list_kriteria='';
$no=0;
$q=mysql_query("select * from gejala order by kode");
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		if(isset($_SESSION['gejala'])){
			if(in_array($h['id_gejala'],$_SESSION['gejala'])){$c='checked';}else{$c='';}
		}else{
			$c='';
		}
		$no++;
		$list_kriteria.='
		  <tr>
			<td style="text-align:center;" width="30"><input name="gejala[]" type="checkbox" class="checkboxes" '.$c.' value="'.$h['id_gejala'].'" /></td>
			<td style="text-align:center;" width="30">'.$no.'</td>
			<td>'.$h['nama'].'</td>
		  </tr>
		';
	}
}


?>

<h3 class="p2">Diagnosa Kerusakan Sepeda Motor Vespa</h3>
<div style="clear:both;height:20px;"></div>
<form action="" name="" method="post" enctype="multipart/form-data">
<?php
if(!empty($error)){
	echo '
	   <div class="alert alert-error ">
		  '.$error.'
	   </div>
	';
}
?>

<p>Silahkan pilih gejala kerusakan vespa yang dialami.</p>
<table class="table table-striped table-hover table-bordered">
	<thead>
	  <tr>
		<td style="text-align:center;" width="30"><input type="checkbox" id="ckbCheckAll" /></td>
		<td style="text-align:center;" width="30">NO</td>
		<td style="text-align:center;">NAMA KRITERIA</td>
	  </tr>
	</thead>
	<tbody>
		<?php echo $list_kriteria;?>
	</tbody>
</table>
<center>
<button type="submit" name="reset" class="btn"> Reset</button>
<button type="submit" name="submit" class="btn"><i class="icon-ok"></i> Submit Pemilihan</button>
</center>

</form>

<script>
jQuery(document).ready(function() {
	$("#ckbCheckAll").click(function () {
		if($(this).prop("checked")==true){
			$(".checkboxes").attr("checked",true);
			$(".checkboxes").parent("span").attr("class","checked");
		}else{
			$(".checkboxes").attr("checked",false);
			$(".checkboxes").parent("span").attr("class","");
		}
    });
})
</script>

