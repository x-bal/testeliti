<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
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
		echo "REST API for Device";
	}

	public function getsoal($id = null)
	{
		if (isset($id)) {
			$id_quiz = $this->session->userdata('id_quiz');
			$datasoal = $this->m_admin->get_soal_byid($id, $id_quiz);
			$x = 0;
			if (isset($datasoal)) {
				foreach ($datasoal as $key => $value) {
					//print_r($value);
					$x++;
				}
			}

			if ($x > 0) {
				$notif = array('status' => 'success', 'msg' => 'ok', 'data' => $datasoal);
				Header('Content-Type: application/json');
				Header("HTTP/1.0 200 OK");
				echo json_encode($notif);
			} else {
				$notif = array('status' => 'error', 'msg' => 'id soal tidak ada');
				Header('Content-Type: application/json');
				Header("HTTP/1.0 200 OK");
				echo json_encode($notif);
			}
		} else {
			$notif = array('status' => 'error', 'msg' => 'id null');
			Header('Content-Type: application/json');
			Header("HTTP/1.0 200 OK");
			echo json_encode($notif);
		}
	}
}
