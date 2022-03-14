<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->library('bcrypt');
		date_default_timezone_set("asia/jakarta");
	}


	public function index()
	{
		redirect(base_url() . 'admin/dashboard');
	}

	public function dashboard()
	{
		$data['set'] = "dashboard";

		$this->load->view('v_dashboard', $data);
	}

	public function soal()
	{
		$data['set'] = "list-soal";
		$data['datasoal'] = $this->m_admin->get_all_soal();

		$this->load->view('v_soal', $data);
	}

	public function quiz()
	{
		$data['set'] = "list-quiz";
		$data['dataquiz'] = $this->m_admin->get('quiz');

		$this->load->view('v_quiz', $data);
	}

	public function add_quiz()
	{
		$data['set'] = "add-quiz";
		$this->load->view('v_quiz', $data);
	}

	public function save_quiz()
	{
		if ($this->session->userdata('userlogin')) {
			$nama = $this->input->post('nama');
			$minute = $this->input->post('minute');
			$data = array(
				'nama_quiz'  => $nama,
				'minute'  => $minute,
			);

			if ($this->m_admin->insert('quiz', $data)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
			}

			redirect(base_url() . 'admin/quiz');
		}
	}

	public function edit_quiz($id)
	{
		if ($this->session->userdata('userlogin')) {
			// mencegah akses langsung tanpa login
			if (isset($id)) {

				$quiz = $this->m_admin->find('quiz', ['id' => $id]);

				if (isset($quiz)) {
					$data['set'] = "edit-quiz";
					$data['quiz'] = $quiz;

					$this->load->view('v_quiz', $data);
				}
			} else {
				redirect(base_url() . 'admin/quiz');
			}
		} else {
			redirect(base_url() . 'admin');
		}
	}

	public function save_edit_quiz()
	{
		if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
			if (isset($_POST['id'])) {
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$minute = $this->input->post('minute');

				$data = array(
					'nama_quiz'  => $nama,
					'minute'  => $minute,
				);

				$this->m_admin->update('quiz', 'id', $id, $data);
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");

				redirect(base_url() . 'admin/quiz');
			}
		} else {
			redirect(base_url() . 'admin');
		}
	}

	public function show_quiz($id)
	{
		$data['set'] = "show-quiz";
		$data['datasoal'] = $this->m_admin->getWhere('soal', ['id_quiz' => $id]);
		$data['quiz'] = $id;

		$this->load->view('v_quiz', $data);
	}

	public function add_soal($idQuiz)
	{
		if ($this->session->userdata('userlogin')) {
			$data['quiz_id'] = $idQuiz;   // mencegah akses langsung tanpa login
			$data['set'] = "add-soal";

			$this->load->view('v_soal', $data);
		} else {
			redirect(base_url() . 'admin');
		}
	}

	public function save_add_soal()
	{
		if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
			$id_quiz = $this->input->post('id_quiz');
			$a = $this->input->post('a');
			$b = $this->input->post('b');
			$c = $this->input->post('c');
			$d = $this->input->post('d');
			$e = $this->input->post('e');

			$lastNumber = $this->m_admin->getLastSoal($id_quiz);
			$no_soal = intval($lastNumber) + 1;

			$data = array(
				'id_quiz' => $id_quiz,
				'no_soal' => $no_soal,
				'a' => $a,
				'b' => $b,
				'c' => $c,
				'd' => $d,
				'e' => $e,
			);

			if ($this->m_admin->insert('soal', $data)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
			}
			redirect(base_url() . 'admin/show_quiz/' . $id_quiz);
		} else {
			redirect(base_url() . 'admin');
		}
	}

	public function edit_soal($id)
	{
		if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
			$data['soal'] = $this->m_admin->find('soal', ['id_soal' => $id]);

			$data['set'] = "edit-soal";
			$this->load->view('v_soal', $data);
		} else {
			redirect(base_url() . 'admin');
		}
	}

	public function save_edit_soal()
	{
		if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
			if (isset($_POST['id'])) {
				$id = $this->input->post('id');
				$id_quiz = $this->input->post('id_quiz');
				$a = $this->input->post('a');
				$b = $this->input->post('b');
				$c = $this->input->post('c');
				$d = $this->input->post('d');
				$e = $this->input->post('e');

				$data = array(
					'id_quiz' => $id_quiz,
					'a' => $a,
					'b' => $b,
					'c' => $c,
					'd' => $d,
					'e' => $e,
				);

				$where = 'id_soal';

				if ($this->m_admin->update('soal', $where, $id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
				}
				redirect(base_url() . 'admin/show_quiz/' . $id_quiz);
			}
		} else {
			redirect(base_url() . 'admin');
		}
	}

	public function delete_soal($id, $quiz)
	{
		if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
			;
			if ($this->m_admin->delete('soal', ['id_soal' => $id])) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
			}
			redirect(base_url() . 'admin/show_quiz/' . $quiz);
		} else {
			redirect(base_url() . 'admin');
		}
	}


	public function test()
	{
		$data['set'] = "list-test";
		$data['datatest'] = $this->m_admin->get_all_test();
		$this->load->view('v_test', $data);
	}

	public function add_test()
	{
		$data['set'] = "add-test";
		$data['quiz'] = $this->m_admin->get('quiz');

		$this->load->view('v_test', $data);
	}

	public function save_test()
	{
		if ($this->session->userdata('userlogin')) {
			$token = $this->input->post('token');
			$nama = $this->input->post('nama');
			$quiz = $this->input->post('quiz');

			$duplicate = $this->m_admin->get_token_row($token);
			//print_r($duplicate);


			if ($duplicate > 0) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Token sudah terdaftar, ganti Token</div>");
			} else {
				$data = array(
					'nama'  => $nama, 'token'  => $token, 'id_quiz'  => $quiz, 'status' => 'Belum Test'
				);

				if ($this->m_admin->insert_test($data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}
			}

			redirect(base_url() . 'admin/test');
		}
	}

	public function hapus_test($id = null)
	{
		if ($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			if ($this->m_admin->hapus_test($id)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
			}

			redirect(base_url() . 'admin/test');
		}
	}

	// public function list_users()
	// {
	// 	$data['set'] = "list-users";
	// 	$data['data'] = $this->m_admin->get_users();
	// 	$this->load->view('v_users', $data);
	// }

	// public function add_users()
	// {
	// 	$data['set'] = "add-users";
	// 	$this->load->view('v_users', $data);
	// }


	// public function save_users()
	// {
	// 	if ($this->session->userdata('userlogin')) {
	// 		$users = $this->input->post('users');
	// 		$email = $this->input->post('email');
	// 		$username = $this->input->post('username');
	// 		$pass = $this->input->post('pass');
	// 		$hash = $this->bcrypt->hash_password($pass);

	// 		$type = explode('.', $_FILES["image"]["name"]);
	// 		$type = strtolower($type[count($type) - 1]);
	// 		$imgname = uniqid(rand()) . '.' . $type;
	// 		$url = "components/dist/img/" . $imgname;
	// 		if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
	// 			if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
	// 				if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
	// 					$data = array(
	// 						'nama'    => $users,
	// 						'email'   => $email,
	// 						'username' => $username,
	// 						'password' => $hash,
	// 						'avatar'  => $imgname,
	// 					);
	// 					$this->m_admin->insert_users($data);
	// 					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
	// 				}
	// 			}
	// 		} else {
	// 			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
	// 		}

	// 		redirect(base_url() . 'admin/list_users');
	// 	} else {
	// 		redirect(base_url() . 'admin');
	// 	}
	// }


	// public function hapus_users($id = null)
	// {
	// 	if ($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
	// 	{
	// 		$path = "";
	// 		$filename = $this->m_admin->get_user_byid($id);
	// 		foreach ($filename as $key) {
	// 			$file = $key->avatar;
	// 			$path = "components/dist/img/" . $file;
	// 		}

	// 		//echo $path;

	// 		if (file_exists($path)) {
	// 			unlink($path);
	// 			if ($this->m_admin->users_del($id)) {
	// 				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
	// 			} else {
	// 				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
	// 			}
	// 		} else {
	// 			if ($this->m_admin->users_del($id)) {
	// 				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus image gagal dihapus</div>");
	// 			} else {
	// 				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
	// 			}
	// 		}

	// 		redirect(base_url() . 'admin/list_users');
	// 	} else {
	// 		redirect(base_url() . 'admin');
	// 	}
	// }


	// public function edit_users($id = null)
	// {
	// 	if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
	// 		if (isset($id)) {
	// 			$user = $this->m_admin->get_user_byid($id);
	// 			foreach ($user as $key => $value) {
	// 				//print_r($value);
	// 				$data['id'] = $id;
	// 				$data['nama'] = $value->nama;
	// 				$data['email'] = $value->email;
	// 				$data['username'] = $value->username;
	// 				$data['password'] = $value->password;
	// 				$data['avatar'] = $value->avatar;
	// 			}
	// 			$data['set'] = "edit-users";
	// 			$this->load->view('v_users', $data);
	// 		} else {
	// 			redirect(base_url() . 'admin/list_users');
	// 		}
	// 	} else {
	// 		redirect(base_url() . 'admin');
	// 	}
	// }

	// public function save_edit_users()
	// {
	// 	if ($this->session->userdata('userlogin')) {     // mencegah akses langsung tanpa login
	// 		if (isset($_POST['id']) && isset($_POST['email'])) {
	// 			$id = $this->input->post('id');
	// 			$email = $this->input->post('email');
	// 			$nama = $this->input->post('users');
	// 			$username = $this->input->post('username');
	// 			$pass = $this->input->post('pass');
	// 			$hash = $this->bcrypt->hash_password($pass);


	// 			$type = explode('.', $_FILES["image"]["name"]);
	// 			$type = strtolower($type[count($type) - 1]);
	// 			$imgname = uniqid(rand()) . '.' . $type;
	// 			$url = "components/dist/img/" . $imgname;
	// 			if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
	// 				if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
	// 					if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
	// 						$data = array(
	// 							'nama'    => $users,
	// 							'email'   => $email,
	// 							'username' => $username,
	// 							'avatar'  => $imgname,
	// 						);
	// 						$file = $this->input->post('img');
	// 						$path = "components/dist/img/" . $file;

	// 						if (file_exists($path)) {
	// 							unlink($path);
	// 						}
	// 						$this->m_admin->updateUser($id, $data);
	// 						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
	// 					}
	// 				}
	// 			} else {
	// 				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
	// 			}

	// 			if (isset($_POST['changepass'])) {
	// 				$data = array(
	// 					'email' => $email,
	// 					'nama' => $nama,
	// 					'username' => $username,
	// 					'password' => $hash,
	// 				);
	// 				if ($this->m_admin->updateUser($id, $data)) {
	// 					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
	// 				} else {
	// 					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
	// 				}
	// 			} else {
	// 				$data = array(
	// 					'email' => $email,
	// 					'nama' => $nama,
	// 					'username' => $username,
	// 				);
	// 				if ($this->m_admin->updateUser($id, $data)) {
	// 					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
	// 				} else {
	// 					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
	// 				}
	// 			}

	// 			redirect(base_url() . 'admin/list_users');
	// 		}
	// 	} else {
	// 		redirect(base_url() . 'admin');
	// 	}
	// }

	// public function setting()
	// {
	// 	$data['set'] = "setting";
	// 	$data['key'] = $this->m_admin->getkey();
	// 	//print_r($data);
	// 	$this->load->view('v_setting', $data);
	// }


	// public function lastabsensi()
	// {
	// 	if ($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
	// 	{
	// 		if (isset($_POST['tanggal'])) {
	// 			$tgl = $this->input->post('tanggal');
	// 			//echo $tgl;
	// 			$split1 = explode("-", $tgl);
	// 			$x = 0;
	// 			foreach ($split1 as $key => $value) {
	// 				$date[$x] = $value;
	// 				$x++;
	// 			}

	// 			$ts1 = strtotime($date[0]);
	// 			$ts2 = strtotime($date[1]);

	// 			$tgl1 = date("d-M-Y", $ts1);
	// 			$tgl2 = date("d-M-Y", $ts2);

	// 			$ts2 += 86400;	// tambah 1 hari (hitungan detik)

	// 			// $data['tgl1'] = $tgl1;
	// 			// $data['tgl2'] = $tgl2;

	// 			if ($x == 2) {
	// 				$data['datamasuk'] = $this->m_admin->get_absensi("masuk", $ts1, $ts2);
	// 				$data['datakeluar'] = $this->m_admin->get_absensi("keluar", $ts1, $ts2);
	// 				$data['tanggal'] = $tgl1 . " - " . $tgl2;
	// 				$data['waktuabsensi'] = $tgl1 . "_" . $tgl2;

	// 				$data['set'] = "last-absensi";
	// 				$this->load->view('v_absensi', $data);
	// 			} else {
	// 				redirect(base_url() . 'admin/absensi');
	// 			}
	// 		} else {
	// 			redirect(base_url() . 'admin/absensi');
	// 		}
	// 	}
	// }


	// public function export2excel()
	// {
	// 	if ($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
	// 	{
	// 		if (isset($_GET['tanggal'])) {
	// 			$tanggal = $this->input->get('tanggal');
	// 			//echo $tanggal;

	// 			$split = explode("_", $tanggal);
	// 			$x = 0;
	// 			foreach ($split as $key => $value) {
	// 				$date[$x] = $value;
	// 				$x++;
	// 			}

	// 			$ts1 = strtotime($date[0]);
	// 			$ts2 = strtotime($date[1]);

	// 			$ts2 += 86400;	// tambah 1 hari (hitungan detik)

	// 			$datamasuk = $this->m_admin->get_absensi("masuk", $ts1, $ts2);
	// 			$datakeluar = $this->m_admin->get_absensi("keluar", $ts1, $ts2);

	// 			$spreadsheet = new Spreadsheet;

	// 			$spreadsheet->setActiveSheetIndex(0)
	// 				->setCellValue('A1', 'No')
	// 				->setCellValue('B1', 'Alat Absensi')
	// 				->setCellValue('C1', 'Nama')
	// 				->setCellValue('D1', 'Jabatan/Kelas')
	// 				->setCellValue('E1', 'Keterangan')
	// 				->setCellValue('F1', 'Waktu');

	// 			$baris = 2;
	// 			$spreadsheet->setActiveSheetIndex(0)
	// 				->setCellValue('A' . $baris, "ABSENSI MASUK");
	// 			$baris++;
	// 			$nomor = 1;

	// 			if (isset($datamasuk)) {
	// 				foreach ($datamasuk as $masuk) {

	// 					$waktu = date("H:i:s d M Y", $masuk->created_at);

	// 					$spreadsheet->setActiveSheetIndex(0)
	// 						->setCellValue('A' . $baris, $nomor)
	// 						->setCellValue('B' . $baris, $masuk->nama_devices)
	// 						->setCellValue('C' . $baris, $masuk->nama)
	// 						->setCellValue('D' . $baris, $masuk->jabatan)
	// 						->setCellValue('E' . $baris, $masuk->keterangan)
	// 						->setCellValue('F' . $baris, $waktu);

	// 					$baris++;
	// 					$nomor++;
	// 				}
	// 			}

	// 			$baris++;
	// 			$spreadsheet->setActiveSheetIndex(0)
	// 				->setCellValue('A' . $baris, "ABSENSI KELUAR");
	// 			$baris++;
	// 			$nomor = 1;

	// 			if (isset($datakeluar)) {
	// 				foreach ($datakeluar as $keluar) {

	// 					$waktu = date("H:i:s d M Y", $keluar->created_at);

	// 					$spreadsheet->setActiveSheetIndex(0)
	// 						->setCellValue('A' . $baris, $nomor)
	// 						->setCellValue('B' . $baris, $keluar->nama_devices)
	// 						->setCellValue('C' . $baris, $keluar->nama)
	// 						->setCellValue('D' . $baris, $keluar->jabatan)
	// 						->setCellValue('E' . $baris, $keluar->keterangan)
	// 						->setCellValue('F' . $baris, $waktu);

	// 					$baris++;
	// 					$nomor++;
	// 				}
	// 			}

	// 			$writer = new Xlsx($spreadsheet);

	// 			header('Content-Type: application/vnd.ms-excel');
	// 			header('Content-Disposition: attachment;filename="Absensi_' . $tanggal . '.xlsx"');
	// 			header('Cache-Control: max-age=0');

	// 			$writer->save('php://output');
	// 		} else {
	// 			redirect(base_url() . 'admin/absensi');
	// 		}
	// 	}
	// }
}
