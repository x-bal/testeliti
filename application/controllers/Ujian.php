<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_api');
		date_default_timezone_set("asia/jakarta");
	}

	public function index()
	{
		echo "Please login with token";
	}

	public function tokencheck()
	{
		if (isset($_POST['token'])) {

			$token = $this->input->post('token');


			//ambil data dari database
			$check = $this->m_admin->token_login($token);
			//print_r($check);

			if ($check > 0) {
				if ($check->tanggal_selesai == 0) {
					$this->session->set_userdata('nama', $check->nama);
					$this->session->set_userdata('id_test', $check->id_test);
					$this->session->set_userdata('token', $token);
					$this->session->set_userdata('id_quiz', $check->id_quiz);

					redirect(base_url() . 'ujian/test');
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Token expired, sudah pernah melakukan Ujian</div>");
					redirect(base_url() . 'login/user');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Ujian, token tidak ditemukan</div>");
				redirect(base_url() . 'login/user');
			}
		} else {
			redirect(base_url() . 'login/user');
		}
	}

	public function test()
	{
		if ($this->session->userdata('nama')) {
			$idquiz = $this->session->userdata('id_quiz');

			$data['nama'] = $this->session->userdata('nama');
			$data['id_test'] = $this->session->userdata('id_test');
			$data['token'] = $this->session->userdata('token');

			$data['minute'] = intval($this->db->get_where('quiz', ['id' => $idquiz])->row()->minute);
			$data['totalSoal'] = $this->m_admin->getTotalSoal($idquiz);
			$data['no_soal'] = intval($this->m_admin->getNoSoal($idquiz));
			// var_dump($data['no_soal']);
			// die;
			$data['ujian'] = "Ujian";
			$this->load->view('v_ujian', $data);
		} else {
			redirect(base_url() . 'login/user');
		}
	}

	public function hasiltest()
	{
		if (isset($_GET['token'])) {
			$token = $this->input->get('token');

			$check = $this->m_admin->token_login($token);

			//print_r($check);
			// $hasil = 0;

			$data['totalSoal'] = $this->m_admin->getTotalSoal($check->id_quiz);
			$data['x'] = "x";
			$data['check'] = $check;
			$this->load->view('v_hasilujian', $data);
		} else {
			redirect(base_url() . 'login/user');
		}
	}

	public function save_ujian()
	{
		if ($this->session->userdata('id_test')) {
			if (isset($_POST['skor'])) {
				$id_test = $this->session->userdata('id_test');
				$skor = $this->input->post('skor');

				$datauser = $this->m_admin->get_idtest($id_test);
				//print_r($datauser);
				$hasil = 0;
				if (isset($datauser)) {
					foreach ($datauser as $key => $value) {
						$hasil++;
					}
				}

				if ($hasil == 0) {
					echo "tidak ada data ujian";
				} else {
					$data = array(
						'status'  => "Selesai Ujian", 'tanggal_selesai'  => time(), 'skor' => $skor
					);

					if ($this->m_admin->update_test($id_test, $data)) {
						echo "berhasil simpan ujian";
						//$this->session->sess_destroy();
						unset($_SESSION['id_test']);
						unset($_SESSION['nama']);
					} else {
						echo "gagal simpan ujian";
					}
				}
			} else {
				echo "tidak ada skor masuk";
			}
		}
	}
}
