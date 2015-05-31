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
				</div>
				<div id="form" class="col-md-12">
					<div id="form_title">
						<h4>Masukkan Kriteria Calon Penerima</h4>
					</div>
					<div id="form_content">
						<form class="form-horizontal" method="post" action="proses.php">
							<div class="form-group">
								<label for="nama" class="col-sm-5 control-label">Nama Lengkap</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required />
								</div>
							</div>
							<div class="form-group">
								<label for="nim" class="col-sm-5 control-label">NIM</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" required />
								</div>
							</div>
							<div class="form-group">
								<label for="ipk" class="col-sm-5 control-label">IPk</label>
								<div class="col-sm-5">
									<input type="number" min="0" max="4" class="form-control" id="ipk" name="ipk" placeholder="IPk; misal 3.56" required step="any" pattern="[0-9]+([\.|,][0-9]+)?" />
								</div>
							</div>
							<div class="form-group">
								<label for="gaji" class="col-sm-5 control-label">Penghasilan Orang Tua</label>
								<div class="col-sm-5">
									<select class="form-control" id="gaji" name="gaji">
										<option value="1">Kurang dari Rp 500.000</option>
										<option value="2">Rp 500.000 - Rp 1.500.000</option>
										<option value="3">Rp 1.500.000 - Rp 3.000.000</option>
										<option value="4">Rp 3.000.000 - Rp 5.000.000</option>
										<option value="5">Lebih dari Rp 5.000.000</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="listrik" class="col-sm-5 control-label">Daya Listrik</label>
								<div class="col-sm-5">
									<input type="number" min="0" class="form-control" id="listrik" name="listrik" placeholder="Daya Listrik" required />
								</div>
							</div>
							<div class="form-group">
								<label for="tanggungan" class="col-sm-5 control-label">Jumlah Tanggungan Orang Tua</label>
								<div class="col-sm-5">
									<input type="number" min="0" class="form-control" id="tanggungan" name="tanggungan" placeholder="Jumlah Tanggungan Orang Tua" required />
								</div>
							</div>
							<div class="form-group">
								<label for="organisasi" class="col-sm-5 control-label">Aktif Organisasi</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="organisasi" id="organisasi" value="1" checked /> Ya
									</label>
									<label class="radio-inline">
										<input type="radio" name="organisasi" id="organisasi" value="2" /> Tidak
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="semester" class="col-sm-5 control-label">Semester</label>
								<div class="col-sm-5">
									<input type="number"  min="0" class="form-control" id="semester" name="semester" placeholder="Semester" required />
								</div>
							</div>
							<div class="form-group">
								<label for="beasiswa" class="col-sm-5 control-label">Menerima Beasiswa Lain</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="beasiswa" id="beasiswa" value="1" checked /> Ya
									</label>
									<label class="radio-inline">
										<input type="radio" name="beasiswa" id="beasiswa" value="2" /> Tidak
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-5 col-sm-5 ">
									<button type="submit" class="btn btn-default pull-right col-xs-12 col-md-2">Proses</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="footer" class="col-md-12">
				<div id="copyright" class="col-md-12">
					&copy; Team Jaringan Syaraf Tiruan - Hamming
				</div>
			</div>
		</div>
	</body>
</html>

						<script>
							$('form input').on('change', function(){
                if($(this).attr('type') != 'file'){
                    $(this).val($.trim($(this).val()));
                }
            	});
						</script>