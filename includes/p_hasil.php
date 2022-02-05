<?php

$link_list='?hal=hasil';

if(!isset($_SESSION['gejala'])){
	exit("<script>location.href='?hal=pemilihan';</script>");
}
$kriteria=$_SESSION['gejala'];
$pilihan=array();
$cf=array();

# PROSES PERHITUNGAN CF
$q=mysql_query("select * from penyakit order by kode");
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		$id=$h['id_penyakit'];
		$pilihan[$id]=array($h['kode'],$h['nama']);
		
		$mb_lama=0;$md_lama=0;$mb_baru=0;$md_baru=0;$mb_sementara=0;$md_sementara=0;
		$kriteria_ke=0;
		
		$qq=mysql_query("select * from pengetahuan where id_penyakit='".$id."' order by id_pengetahuan");
		while($hh=mysql_fetch_array($qq)){
			if(in_array($hh['id_gejala'],$kriteria)){
				$kriteria_ke++;
				if($kriteria_ke==1){
					$mb_lama=0;$md_lama=0;
					$mb_baru=$hh['mb'];
					$md_baru=$hh['md'];
					$mb_sementara=$hh['mb'];
					$md_sementara=$hh['md'];
				}else{
					$mb_lama=$mb_sementara;
					$md_lama=$md_sementara;
					$mb_baru=$hh['mb'];
					$md_baru=$hh['md'];
					$mb_sementara=$mb_lama + ($mb_baru * (1-$mb_lama));
					$md_sementara=$md_lama + ($md_baru * (1-$md_lama));
					//$md_sementara=($md_lama + $md_baru) * (1-$md_lama);
				}
				
			}
		}
		if($kriteria_ke>0){
			$nilai=round($mb_sementara-$md_sementara,3);
			$nilai_pilihan[$id]=$nilai;
			$cf[]=array($nilai,$id);
		}
	}
}
# URUTKAN NILAI
sort($cf);

$nama_pilihan='';
$nama_solusi='';
$daftar='';
$no=0;
for($i=count($cf)-1;$i>=0;$i--){
	if($nama_pilihan==''){$nama_pilihan=$pilihan[$cf[$i][1]][1];}
    $nama_solusi[]=$pilihan[$cf[$i][1]][0];
	$no++;
	$daftar.='
	  <tr>
		<td style="text-align:center;">'.$no.'</td>
		<td>'.$pilihan[$cf[$i][1]][0].'</td>
		<td>'.$pilihan[$cf[$i][1]][1].'</td>
		<td style="text-align:center;">'.($cf[$i][0]*100).' %</td>
		<td style="text-align:center;">'.$no.'</td>
	  </tr>
	';
}

$list_kriteria='';
$no=0;
$q=mysql_query("select * from gejala order by kode");
if(mysql_num_rows($q) > 0){
	while($h=mysql_fetch_array($q)){
		if(isset($_SESSION['gejala'])){
			if(in_array($h['id_gejala'],$_SESSION['gejala'])){
				$no++;
				$list_kriteria.='
				  <tr>
					<td valign="top" width="30">'.$no.'</td>
					<td valign="top" width="70">'.$h['kode'].'</td>
					<td valign="top">'.$h['nama'].'</td>
				  </tr>
				';
			}
		}
	}
}

?>
<h3 class="p2">Hasil Pemilihan</h3>
<div style="clear:both;height:20px;"></div>
<p>Kriteria - kriteria yang anda alami :</p>
<table class="table table-striped table-hover table-bordered">
	<tbody>
		<?php echo $list_kriteria;?>
	</tbody>
</table>
<p>Data Analisa</p>
<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th style="text-align:center;" width="30">NO</th>
			<th style="text-align:center;" width="100">KODE</th>
			<th style="text-align:center;">NAMA KRITERIA</th>
			<th style="text-align:center;" width="70">CF</th>
			<th style="text-align:center;" width="70">RANK</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
<table class="table table-bordered">
	<tbody>
	  <tr>
		<td width="150"><strong>Pilihan Terbaik</strong></td>
		<td><strong><?php echo strtoupper($nama_pilihan);?></strong></td>
	  </tr>
      <tr>
		<td width="150"><strong>Solusi</strong></td>
		<td><strong><?php
                        $solusi=$nama_solusi[0];
                        $mysql=mysql_query("select solusi from solusi where kode='$solusi'");
                        $row=mysql_fetch_array($mysql);
                        $_SESSION['solusi']=$row['solusi'];
        echo $row['solusi'];?></strong></td>
	  </tr>
	</tbody>
</table>
<center>
<a href="?hal=pemilihan" class="btn">Pilih Kriteria/ Kembali</a>
<a href="cetak_hasil.php" target="_blank" class="btn">Cetak</a>
</center>