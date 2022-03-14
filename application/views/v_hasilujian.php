<html>

<head>
	<title>UJIAN CAT</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url(); ?>/asset/bootstrap.min.css">
	<link rel='stylesheet' href='<?= base_url(); ?>/asset/css.css'>
	<link rel='stylesheet' href='<?= base_url(); ?>/asset/fontawesome/css/all.min.css'>
</head>

<body>
	<div class="wrapper" style="min-height: 900px;">
		<div class="wrap">
			<div class="text-center pb-4">
				<div class="h5 col-md-12">
					Nama <?= $check->nama; ?>
					<br>
					Selesai Ujian <?php if ($check->tanggal_selesai > 0) {
										echo date("H:i:s - d M Y", $check->tanggal_selesai);
									} else {
										echo ": Blm Melakukan Ujian";
									} ?>
					<br><br>
					Skor Ujian
					<br>

					<table class="h6 table table-bordered text-center">
						<?php
						$dataskor = explode('#', $check->skor);
						unset($dataskor[$totalSoal]);

						if (count($dataskor) > 0) {
							foreach ($dataskor as $key => $value) {
								echo "<tr>";
								$datax = explode(':', $value);
								echo '<th style="border-color:black;">' . $datax[0] . '</th>';
								$dataz = explode(',', $datax[1]);
								echo '<th style="border-color:black;">' . $dataz[0] . '</th>';
								echo '<th style="border-color:black;">' . $dataz[1] . '</th>';
								if (isset($dataz[2])) {
									echo '<th style="border-color:black;">' . $dataz[2] . '</th>';
								}
								echo "</tr>";
							}
						}
						?>
					</table>
					<br>
					<button class="btn btn-primary" onclick="window.print();">Print</button>
				</div>
			</div>
		</div>
	</div>
	<div class="d-flex flex-column">
		<div class="h3 font-weight-bold text-white">Go Dark</div> <label class="switch"> <input type="checkbox"> <span class="slider round"></span> </label>
	</div>

	<script src="<?= base_url(); ?>/asset/jquery.min.js"></script>
	<script src="<?= base_url(); ?>/asset/bootstrap.bundle.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const main = document.querySelector('body')
			const toggleSwitch = document.querySelector('.slider')
			toggleSwitch.addEventListener('click', () => {
				main.classList.toggle('dark-theme')
			})
		});
	</script>
</body>

</html>