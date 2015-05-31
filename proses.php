<?php
//membuat fungsi threshold
	function thres($x){
		if($x<=0){
			$x = 0;
		}
		return $x;
	}

//mengambil data dari form
	$nama = $_POST['nama'];
	$nim = $_POST['nim'];
	$ipk = $_POST['ipk'];
	$gaji = $_POST['gaji'];
	$daya = $_POST['listrik'];
	$tanggungan = $_POST['tanggungan'];
	$organisasi = $_POST['organisasi'];
	$semester = $_POST['semester'];
	$beasiswa = $_POST['beasiswa'];
	
	
	//threshold IPK
	if($ipk>=3){
		$arr_ipk = 1;
	}else{
		$arr_ipk = -1;
	}
	//threshold gaji
	if($gaji>3){
		$arr_gaji = -1;
	}else{
		$arr_gaji = 1;
	}
	
	if($gaji == 1 ){
		$text_gaji = 'Kurang dari Rp 1.000.000';
	}else if($gaji == 2){
		$text_gaji = 'Rp 1.000.000 - Rp 2.000.000';
	}else if($gaji == 3){
		$text_gaji = 'Rp 2.000.000 - Rp 3.000.000';
	}else if($gaji == 4){
		$text_gaji = 'Rp 3.000.000 - Rp 4.000.000';
	}else{
		$text_gaji = 'Lebih dari Rp 4.000.000';
	}


//threshold organisasi
	if($organisasi == 1 ){
		$arr_org = 1;
		$text_org = 'Ya';
	}else{
		$arr_org = -1;
		$text_org = 'Tidak';
	}

//threshold beasiswa
	if($beasiswa == 1 ){
		$arr_bea = -1;
		$text_bea = 'Ya';
	}else{
		$arr_bea = 1;
		$text_bea = 'Tidak';
	}
	
//threshold daya listrik
	if($daya<=900){
		$arr_daya = 1;
	}else{
		$arr_daya = -1;
	}

	//threshold tanggungan
	if($tanggungan>=5){
		$arr_tangg = 1;
	}else{
		$arr_tangg = -1;
	}

//threshold smt
	if($semester>4){
		$arr_smt = 1;
	}else{
		$arr_smt = -1;
	}

	
	$array_uji = array($arr_ipk, $arr_gaji, $arr_daya, $arr_tangg, $arr_org, $arr_smt, $arr_bea);
	$eps = 0.2;
	$bj =  sizeOf($array_uji)/2;
	//proses perhitungan
	$array_terima = array(1,1,1,1,1,-1,1);
	$array_tolak = array(-1,-1,-1,-1,-1,1,-1);
	
	$w11 = array();
	foreach($array_terima as $array){
		array_push($w11,$array/2);
	}

	$w21 = array();
	foreach($array_tolak as $array){
		array_push($w21,$array/2);
	}

	
	$y_net1 = $bj + ($array_uji[0]*$array_terima[0]) + ($array_uji[1]*$array_terima[1]) + ($array_uji[2]*$array_terima[2]) + ($array_uji[3]*$array_terima[3]) + ($array_uji[4]*$array_terima[4]) + ($array_uji[5]*$array_terima[5]) + ($array_uji[6]*$array_terima[6]);
	
	$y_net2 = $bj + ($array_uji[0]*$array_tolak[0]) + ($array_uji[1]*$array_tolak[1]) + ($array_uji[2]*$array_tolak[2]) + ($array_uji[3]*$array_tolak[3]) + ($array_uji[4]*$array_tolak[4]) + ($array_uji[5]*$array_tolak[5]) + ($array_uji[6]*$array_tolak[6]);
	
	$a1[0] = $y_net1; 

	$a2[0] = $y_net2; 
	
	$i=0;
	$stop = false;

	while(!$stop){
		$i++;
		$a1[$i] = thres($a1[$i-1] - ($eps * $a2[$i-1]));
		
		$a2[$i] = thres($a2[$i-1] - ($eps * $a1[$i-1]));
		
		if(($a1[$i]==0) or ($a2[$i]==0)){
			$stop = true;
		}
	}

	if($a1[$i] >= $a2[$i]){
		$result = 'Diterima';
	}else{
		$result = 'Ditolak';
	}
	
?>

<html>
	<head>
		<title>Jaringan Syaraf Tiruan</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		
	</head>
	<body>
		<div id="wrapper" class="row">
			<div id="header" class="col-md-12">
				<div id="title">
					<h1>Jaringan Syaraf Tiruan - Hamming</h1>
				</div>
			</div>
			<div id="content" class="col-md-12">
				<div id="content_title" class="col-md-12">
					<h2>Aplikasi Penentuan Penerimaan Beasiswa</h2>
					<h4>Hasil Perhitungan</h4>
				</div>
				<div class="col-md-3"></div>
				<div id="content_body" class="col-md-6">
					<table class="table">
						<tr>
							<td>Nama Lengkap</td>
							<td><?php echo $nama;?></td>
						</tr>
						<tr>
							<td>NIM</td>
							<td><?php echo $nim;?></td>
						</tr>
						<tr>
							<td>IPk</td>
							<td><?php echo $ipk;?></td>
						</tr>
						<tr>
							<td>Gaji Orang Tua</td>
							<td><?php echo $text_gaji;?></td>
						</tr>
						<tr>
							<td>Daya Listrik</td>
							<td><?php echo $daya;?> KWh</td>
						</tr>
						<tr>
							<td>Jumlah Tanggungan Orang Tua</td>
							<td><?php echo $tanggungan;?> orang</td>
						</tr>
						<tr>
							<td>Aktif Organisasi</td>
							<td><?php echo $text_org;?></td>
						</tr>
						<tr>
							<td>Semester</td>
							<td><?php echo $semester;?></td>
						</tr>
						<tr>
							<td>Menerima Beasiswa Lain</td>
							<td><?php echo $text_bea;?></td>
						</tr>
						<tr>
							<td>Diterima</td>
							<td><b><?php echo $result;?></b></td>
						</tr>
						<tr>
							<td colspan="2">
								<a id="btn_selesai" class="btn btn-default pull-right col-md-3 col-xs-12" data-toggle="modal" data-target="#modal_selesai">Selesai</a>
								<a id="btn_kembali" class="btn btn-default col-md-3 col-xs-12" style="margin-right:10px;" href="index.php">Kembali</a>
								<button type="button" id="lihat_proses" data-toggle="modal" data-target="#myModal" class="btn btn-default col-md-3 col-xs-12">Lihat Proses</button>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-3"></div>
			</div>
			<div id="footer" class="col-md-12">
				<div id="copyright" class="col-md-12">
					&copy; Team Jaringan Syaraf Tiruan - Hamming
				</div>
			</div>
		</div>
	</body>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Proses Perhitungan</h4>
				</div>
				<div class="modal-body">
					<?php
						echo 'Nama			: '.$nama.'<br>';
						echo 'NIM			: '.$nim.'<br>';
						echo 'IPk			: '.$ipk.'<br>';
						echo 'Gaji			: '.$text_gaji.'<br>';
						echo 'Daya Listrik			: '.$daya.'<br>';
						echo 'Tanggungan			: '.$tanggungan.'<br>';
						echo 'Organisasi			: '.$text_org.'<br>';
						echo 'Semester			: '.$semester.'<br>';
						echo 'Sedang Menerima Beasiswa			: '.$text_bea.'<br><br>';		

						
						
						echo 'Dilakukan threshold untuk masing-masing masukan (Kecuali Nama dan NIM)<br><br>';
						echo 'Sehingga menghasilkan vektor uji : (';
						foreach($array_uji as $array){
							echo $array.' ';
						}
						echo ')';
						echo '<br>';

						echo '<br>';
						echo 'Diketahui Vektor untuk diterima Beasiswa : (';
						foreach($array_terima as $array){
							echo $array.' ';
						}
						echo ')';
						echo '<br>';

						echo 'Diketahui Vektor untuk ditolak Beasiswa : (';
						foreach($array_tolak as $array){
							echo $array.' ';
						}
						echo ')';
						echo '<br>';

						echo '<br>';
						
						echo 'Menghitung bobot dengan rumus w[j][i] = e[i](j)/2, sehingga menghasilkan';
						echo '<br>';
						echo 'w[1][1] = (';
						foreach($w11 as $array){
							echo $array.' ';
						}
						echo ')';
						echo '<br>';

						echo 'w[2][1] = (';
						foreach($w21 as $array){
							echo $array.' ';
						}
						echo ')';
						echo '<br>';
						echo '<br>';

						echo 'Menghitung nilai b[j] dengan rumus b[j]=jumlah_komponen/jumlah_vektor_contoh, sehingga menghasilkan';
						echo '<br>';
						echo 'b[j] ='.$bj;
						echo '<br>';
						echo '<br>';


						echo 'Evaluasi kemiripan dengan vektor contoh';
						echo '<br>';
				
						echo 'y_netj = b[j]+x[i]*w[j][i]), sehingga menghasilkan';
						echo '<br>';
						echo 'y_net1 = '.$y_net1;	
						echo '<br>';
						echo 'y_net2 = '.$y_net2;
						
						echo '<br>';
						echo '<br>';
						
						echo 'Gunakan jaringan Maxnet untuk menghitung unit pemenang, misal eps = '.$eps;
						
						echo '<br>';
						
						echo 'a1(0) = y_net1 = '.$y_net1;
						echo '<br>';
						echo 'a2(0) = y_net2 = '.$y_net2;
						echo '<br>';
						echo '<br>';
						
						echo 'Iterasinya menghasilkan ';
						echo '<br>';
						$i=0;
						$stop = false;

						while(!$stop){
							$i++;
							$a1[$i] = thres($a1[$i-1] - ($eps * $a2[$i-1]));
							
							$a2[$i] = thres($a2[$i-1] - ($eps * $a1[$i-1]));
							
							if(($a1[$i]==0) or ($a2[$i]==0)){
								$stop = true;
							}
							
							echo 'a1('.$i.') = f('.$a1[$i-1].' - ('.$eps.' * '.$a2[$i-1].')) = '.$a1[$i].'';
							echo '<br>';
							echo 'a2('.$i.') = f('.$a2[$i-1].' - ('.$eps.' * '.$a1[$i-1].')) = '.$a2[$i].'';
							echo '<br>';
							echo '<br>';
						}

						if($a1[$i] >= $a2[$i]){
							$result = 'Diterima';
							$pos = 1;
						}else{
							$result = 'Ditolak';
							$pos = 2;
						}
						
						echo 'Karena yang bernilai positif adalah a'.$pos.', maka vektor contoh e('.$pos.') merupakan vektor yang paling
						cocok dengan vektor masukan sehingga hasilnya adalah <b>'.$result.'</b>';
						
						
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
	
	<div class="modal fade" id="modal_selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Kelompok Kami</h4>
				</div>
				<div class="modal-body">
					Aplikasi Jaringan Syaraf Tiruan - Hamming ini dibuat oleh : <br><br>
					Fiker Aofa<br>
					Alfin L. Arifah<br>
					Indah Wulandari<br>
					Muhammad Khaerul Anam<br>
					Novia Ferina Putri<br>
					Vania Zerlina Susela Devi<br>
					Seza Dio Firmansyah<br>
					Mohammad Fajar Ainul Bashri<br>
					Bery Orindi <br>
					Gumilar Lingga Pamungkas<br><br>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
						<script>
							$(document).on("click", "#lihat_proses", function () {
								
							});
							
						</script>
	
</html>

					