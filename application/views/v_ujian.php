<?php
?>
<html>

<head>
	<title>UJIAN CAT</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url(); ?>/asset/bootstrap.min.css">
	<link rel='stylesheet' href='<?= base_url(); ?>/asset/css.css'>
	<link rel='stylesheet' href='<?= base_url(); ?>/asset/fontawesome/css/all.min.css'>
</head>

<body>
	<div class="countdown-top">Nama Peserta <?= $nama; ?><h2><span id="time">00:00</span></h2>
	</div>
	<div class="wrapper">
		<div class="wrap">
			<div class="text-center pb-4">
				<div class="h5 font-weight-bold col-md-12"><span id="number"> </span>Petunjuk Soal </div>
				<div class="h5 col-md-12">
					<table class="h6 table table-bordered text-center">
						<tr>
							<th style="border-color:black;">A</th>
							<th style="border-color:black;">B</th>
							<th style="border-color:black;">C</th>
							<th style="border-color:black;">D</th>
							<th style="border-color:black;">E</th>
						</tr>
						<tr>
							<td style="border-color:black;"><b id="a"></b></td>
							<td style="border-color:black;"><b id="b"></b></td>
							<td style="border-color:black;"><b id="c"></b></td>
							<td style="border-color:black;"><b id="d"></b></td>
							<td style="border-color:black;"><b id="e"></b></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="text-center pb-4">
				<div class="h5 font-weight-bold col-md-12"><span id="number"> </span>SOAL</div>
				<div class="h5 col-md-12">
					<table class="h6 table table-bordered text-center">
						<tr>
							<th style="border-color:black;"><b id="1"></b></th>
							<th style="border-color:black;"><b id="2"></b></th>
							<th style="border-color:black;"><b id="3"></b></th>
							<th style="border-color:black;"><b id="4"></b></th>
						</tr>
					</table>
				</div>
			</div>
			<div class="h5 font-weight-bold"> Jawaban Anda</div>
			<div class="pt-2">
				<form name="jawaban">
					<label class="options">A <input type="radio" name="radio" id="radioA" value="0" onclick="funcRadio()"> <span class="checkmark"></span> </label>
					<label class="options">B <input type="radio" name="radio" id="radioB" value="1" onclick="funcRadio()"> <span class="checkmark"></span> </label>
					<label class="options">C <input type="radio" name="radio" id="radioC" value="2" onclick="funcRadio()"> <span class="checkmark"></span> </label>
					<label class="options">D <input type="radio" name="radio" id="radioD" value="3" onclick="funcRadio()"> <span class="checkmark"></span> </label>
					<label class="options">E <input type="radio" name="radio" id="radioE" value="4" onclick="funcRadio()"> <span class="checkmark"></span> </label>
				</form>
			</div>
		</div>
	</div>
	<div class="footer bg-danger text-warning">
		<h2>Waktu Ujian <span id="totaltime">00:00</span> menit</h2>
	</div>
	<div class="d-flex flex-column">
		<div class="h3 font-weight-bold text-white">Go Dark</div> <label class="switch"> <input type="checkbox"> <span class="slider round"></span> </label>
	</div>

	<script src="<?= base_url(); ?>/asset/jquery.min.js"></script>
	<script src="<?= base_url(); ?>/asset/bootstrap.bundle.min.js"></script>
	<script>
		var xhttp = new XMLHttpRequest();
		var nomorSoal = 1;
		var flagChangeSoal = true;
		var dataSoalAsli = [];
		var randomSoal = [];

		var jmlSoal = 1;
		var jawabanBenar = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
		var jawabanSalah = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
		console.log(jawabanBenar)
		var angkaMin = <?= $minute ?>;
		var totalSoal = <?= $totalSoal ?>;
		var angkaMinTotal = <?= $minute * $totalSoal ?>;
		var timer;
		var timerTotal;
		var display;
		var displayTotal;
		var dataMinutes;
		var dataMinutesTotal;

		function ChangeSoal() {
			if (flagChangeSoal) {
				flagChangeSoal = false;
				//false = syncrounus
				xhttp.open("GET", "<?= base_url(); ?>api/getsoal/" + nomorSoal, false);
				xhttp.send();
				console.log(xhttp.responseText);
				var soalJSON = JSON.parse(xhttp.responseText);
				// console.log(soalJSON.data[0].id_soal);
				// console.log(soalJSON.data[0].a);
				// console.log(soalJSON.data[0].b);
				// console.log(soalJSON.data[0].c);
				// console.log(soalJSON.data[0].d);
				// console.log(soalJSON.data[0].e);
				document.getElementById("a").innerHTML = soalJSON.data[0].a;
				document.getElementById("b").innerHTML = soalJSON.data[0].b;
				document.getElementById("c").innerHTML = soalJSON.data[0].c;
				document.getElementById("d").innerHTML = soalJSON.data[0].d;
				document.getElementById("e").innerHTML = soalJSON.data[0].e;

				dataSoalAsli[0] = soalJSON.data[0].a;
				dataSoalAsli[1] = soalJSON.data[0].b;
				dataSoalAsli[2] = soalJSON.data[0].c;
				dataSoalAsli[3] = soalJSON.data[0].d;
				dataSoalAsli[4] = soalJSON.data[0].e;

				console.log(dataSoalAsli);

				acakSoal();
			}
		}

		function acakSoal() {
			randomSoal[0] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			randomSoal[1] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			while (randomSoal[1] == randomSoal[0]) {
				randomSoal[1] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			}

			randomSoal[2] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			while (randomSoal[2] == randomSoal[0] || randomSoal[2] == randomSoal[1]) {
				randomSoal[2] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			}

			randomSoal[3] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			while (randomSoal[3] == randomSoal[0] || randomSoal[3] == randomSoal[1] || randomSoal[3] == randomSoal[2]) {
				randomSoal[3] = dataSoalAsli[Math.floor(Math.random() * dataSoalAsli.length)];
			}

			document.getElementById("1").innerHTML = randomSoal[0];
			document.getElementById("2").innerHTML = randomSoal[1];
			document.getElementById("3").innerHTML = randomSoal[2];
			document.getElementById("4").innerHTML = randomSoal[3];
		}

		window.onload = ChangeSoal();

		function startTimer(duration, display) {
			timer = duration;
			var minutes;
			var seconds;
			setInterval(function() {
				minutes = parseInt(timer / 60, 10);
				seconds = parseInt(timer % 60, 10);

				minutes = minutes < 10 ? "0" + minutes : minutes;
				seconds = seconds < 10 ? "0" + seconds : seconds;

				display.textContent = minutes + ":" + seconds;

				if (--timer < 0) {
					timer = duration;
					timer--;
					flagChangeSoal = true;
					nomorSoal++;
					ChangeSoal();
					jmlSoal = 1;
					console.log("waktu habis, ganti soal");
				}
			}, 1000);
		}

		function startTimerTotal(durationTotal, displayTotal) {
			timerTotal = durationTotal;
			var minutesTotal;
			var secondsTotal;
			setInterval(function() {
				minutesTotal = parseInt(timerTotal / 60, 10);
				secondsTotal = parseInt(timerTotal % 60, 10);

				minutesTotal = minutesTotal < 10 ? "0" + minutesTotal : minutesTotal;
				secondsTotal = secondsTotal < 10 ? "0" + secondsTotal : secondsTotal;

				displayTotal.textContent = minutesTotal + ":" + secondsTotal;

				if (--timerTotal < 0) {
					timerTotal = durationTotal;
					console.log("Total waktu habis");
					//save ujian
					var jml = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
					let benar = 1;
					let salah = 1;
					let jwbBenar = 1;
					let jwbSalah = 1;
					let soal_no = 1;
					let jum = 1;
					let dataujian = '';
					let countskor = '';
					// const dataujian = {
					// 	skor: "soal 1 : benar " + jawabanBenar[1] + ", salah " + jawabanSalah[1] + ", jumlah soal " + jml[1] +
					// 		"#soal 2 : benar " + jawabanBenar[2] + ", salah " + jawabanSalah[2] + ", jumlah soal " + jml[2] +
					// 		"#soal 3 : benar " + jawabanBenar[3] + ", salah " + jawabanSalah[3] + ", jumlah soal " + jml[3] +
					// 		"#soal 4 : benar " + jawabanBenar[4] + ", salah " + jawabanSalah[4] + ", jumlah soal " + jml[4] +
					// 		"#soal 5 : benar " + jawabanBenar[5] + ", salah " + jawabanSalah[5] + ", jumlah soal " + jml[5] +
					// 		"#soal 6 : benar " + jawabanBenar[6] + ", salah " + jawabanSalah[6] + ", jumlah soal " + jml[6] +
					// 		"#soal 7 : benar " + jawabanBenar[7] + ", salah " + jawabanSalah[7] + ", jumlah soal " + jml[7] +
					// 		"#soal 8 : benar " + jawabanBenar[8] + ", salah " + jawabanSalah[8] + ", jumlah soal " + jml[8] +
					// 		"#soal 9 : benar " + jawabanBenar[9] + ", salah " + jawabanSalah[9] + ", jumlah soal " + jml[9] +
					// 		"#soal 10 : benar " + jawabanBenar[10] + ", salah " + jawabanSalah[10] + ", jumlah soal " + jml[10]
					// };

					for (let i = 1; i <= totalSoal; i++) {
						jml[i] = jawabanBenar[jwbBenar++] + jawabanSalah[jwbSalah++];
						countskor += "soal " + soal_no++ + " : benar " + jawabanBenar[benar++] + ", salah " + jawabanSalah[salah++] + ", jumlah soal " + jml[jum++] + "#"
					}

					dataujian = {
						skor: countskor
					}

					$.post("<?= base_url(); ?>ujian/save_ujian", dataujian, function(data, status) {
						console.log(`${data} and status is ${status}`)
					});

					// jml[1] = jawabanBenar[1] + jawabanSalah[1];
					// jml[2] = jawabanBenar[2] + jawabanSalah[2];
					// jml[3] = jawabanBenar[3] + jawabanSalah[3];
					// jml[4] = jawabanBenar[4] + jawabanSalah[4];
					// jml[5] = jawabanBenar[5] + jawabanSalah[5];
					// jml[6] = jawabanBenar[6] + jawabanSalah[6];
					// jml[7] = jawabanBenar[7] + jawabanSalah[7];
					// jml[8] = jawabanBenar[8] + jawabanSalah[8];
					// jml[9] = jawabanBenar[9] + jawabanSalah[9];
					// jml[10] = jawabanBenar[10] + jawabanSalah[10];

					// $.post("<?= base_url(); ?>ujian/save_ujian", dataujian, function(data, status) {
					// 	console.log(`${data} and status is ${status}`);
					// });
					window.location.replace("<?= base_url(); ?>ujian/hasiltest?token=<?= $token; ?>");
				}
			}, 1000);
		}

		window.onload = function() {
			dataMinutes = 60 * angkaMin;
			dataMinutesTotal = 60 * angkaMinTotal;
			display = document.querySelector('#time');
			displayTotal = document.querySelector('#totaltime');
			startTimer(dataMinutes, display);
			startTimerTotal(dataMinutesTotal, displayTotal);
		};

		function funcRadio() {
			const form = document.forms.jawaban;
			const checked = form.querySelector('input[name=radio]:checked');

			//console.log(checked.value);

			if (dataSoalAsli[checked.value] == randomSoal[0] || dataSoalAsli[checked.value] == randomSoal[1] || dataSoalAsli[checked.value] == randomSoal[2] || dataSoalAsli[checked.value] == randomSoal[3]) {
				jawabanSalah[nomorSoal]++;
			} else {
				jawabanBenar[nomorSoal]++;
			}

			console.log("jawaban benar " + jawabanBenar[nomorSoal]);
			console.log("jawaban salah " + jawabanSalah[nomorSoal]);

			setTimeout(function() {
				document.getElementById("radioA").checked = false;
				document.getElementById("radioB").checked = false;
				document.getElementById("radioC").checked = false;
				document.getElementById("radioD").checked = false;
				document.getElementById("radioE").checked = false;
			}, 500);

			//timer = dataMinutes = 60 * angkaMin;
			acakSoal();
			jmlSoal++;

			if (jmlSoal > 100) {
				jmlSoal = 1;
				console.log("sudah mencapai 100 soal");
			}
		}

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