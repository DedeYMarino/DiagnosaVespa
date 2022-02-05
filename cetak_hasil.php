<?php

session_start(); 
date_default_timezone_set("Asia/Jakarta");
include 'config.php'; 

if(!isset($_SESSION['gejala'])){
	exit("<script>location.href='?hal=diagnosa';</script>");
}
$kriteria=$_SESSION['gejala'];
$solusi=$_SESSION['solusi'];
$nama_kriteria=array();
for($i=0;$i<count($kriteria);$i++){
	$q=mysql_query("select * from gejala where id_gejala='".$kriteria[$i]."'");
	$h=mysql_fetch_array($q);
	$nama_kriteria[]=$h['nama'];
}
$nama_kriteria=implode(', ',$nama_kriteria);

$pilihan=array();
$cf=array();

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

sort($cf);

$nama_pilihan='';
$daftar='';
$no=0;
for($i=count($cf)-1;$i>=0;$i--){
	if($nama_pilihan==''){$nama_pilihan=$pilihan[$cf[$i][1]][1];}
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

?>

<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="assets/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;}
table{font-size:12px}
td{line-height:20px;}
p{display:inline;}
</style>
</head>

<body>
<div id="right_col" style="font-size:10px;width:770px ">
	<table cellpadding="0" cellspacing="0" width="100%" >
	<tr>
	<td valign="top">
	<div style="text-align:center;font-family:Arial, Helvetica, sans-serif;line-height:26px;padding-top:0px;height:90px;">
	<span style="font-size:18px;font-weight:bold;"><br>LAPORAN HASIL PEMILIHAN</span><br />
	</div>
	<div style="border-bottom:2px solid #000;"></div>
	<br>
	<div style="border:0px solid #000000;width:770px;font-family:Arial;font-size:10px ">
	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="float:left;">
	<tr>
		<td width="120">KERUSAKAN</td> <td>:</td>
		<td> <strong><?php echo strtoupper($nama_pilihan);?></strong></td>
	</tr>
	<tr>
		<td>GEJALA</td><td>:</td>
		<td> <?php echo $nama_kriteria;?></td>
	</tr>
    <tr>
		<td>SOLUSI</td><td>:</td>
		<td> <?php echo $solusi;?></td>
	</tr>
	</table>
	
	
	<div style="clear:both;height:20px"></div>
	<table width="100%" class="tabel_t4" cellpadding="0" cellspacing="0" border="0">
	<thead>
	<tr>
		<th class="t4_title" align="center" width="30">NO</th>
		<th class="t4_title" align="center" width="100">KODE</th>
		<th class="t4_title" align="center">PILIHAN</th>
		<th class="t4_title" align="center" width="100">NILAI</th>
		<th class="t4_title" align="center" width="100">RANK</th>
	</tr>
	</thead>
	<tbody>
		<?php
		echo $daftar;
		?>
	</tbody>
	</table>
	

	</div>
	</td>
	</tr>
	</table>
	
	
	
	
</div>

  			
			<style type="text/css">
			.tabel{
				font-family: Verdana;
				font-size: 10px;
			}
			.tabel_t4{
				border-collapse: collapse;

				border:2px solid #000000;
			}
			.tabel_t4 td{
				font-family: Verdana;
				font-size: 10px;

				border:1px solid #CCCCCC;
				padding: 4px;
			}
			.tabel_t4 th{
				font-family: Verdana;
				font-size: 10px;
				border:1px solid #CCCCCC;
				border-bottom:4px double #000000;
				padding: 10px;
				font-weight:bold;
			}
			.zt4_title{
				border-collapse:separate;
				border-bottom:4px solid #FFFFFF;
				font-weight:bold;
			}
			a{color:#0066FF;text-decoration:underline}
			</style>
</body>
</html>
