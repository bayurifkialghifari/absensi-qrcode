<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Keluar extends Render_Controller {

	public function siswa($id) {

		// Page config:
		$this->title = 'Absen Siswa Keluar';
		$this->content = 'absen-keluar'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Absen'];
		$this->data['id'] = $id;

		// Commit render:
		$this->render();
	}

	public function ajax_data($id)
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->Absen->getAllIsi($length, $start, $cari['value'], $id)->result_array();
		$count 	= $this->Absen->getAllIsi(null,null, $cari['value'], $id)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function absen() 
	{

		$siswa = $this->input->post('siswa');
		$kksi_kkdj_id = $this->input->post('kksi_kkdj_id');

		$r = $this->Absen->absen($siswa, $kksi_kkdj_id);

		if($r !== FALSE) {

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($r));
		}
	}

	
	public function sakit()
	{
		$siswa = $this->input->post('siswa');
		$kksi_kkdj_id = $this->input->post('kksi_kkdj_id');
		$keterangan = $this->input->post('keterangan');

		$r = $this->Absen->sakit($siswa, $kksi_kkdj_id, $keterangan);

		if($r !== FALSE) {

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($r));
		}		
	}

	public function izin() 
	{

		$siswa = $this->input->post('siswa');
		$kksi_kkdj_id = $this->input->post('kksi_kkdj_id');
		$keterangan = $this->input->post('keterangan');

		$r = $this->Absen->izin($siswa, $kksi_kkdj_id, $keterangan);

		if($r !== FALSE) {

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($r));
		}
	}

	public function alpa() 
	{

		$siswa = $this->input->post('siswa');
		$kksi_kkdj_id = $this->input->post('kksi_kkdj_id');
		$keterangan = $this->input->post('keterangan');

		$r = $this->Absen->alpa($siswa, $kksi_kkdj_id, $keterangan);

		if($r !== FALSE) {

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($r));
		}
	}

	public function ChangeStatusKeluar()
	{
		$kksi_kkdj_id = $this->input->post('id');

		$r =  $this->Absen->ChangeStatusKeluar($kksi_kkdj_id);

		if($r !== FALSE)
		{
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($r));	
		}
	}

	public function getDataSiswa()
	{
		$id 	= $this->input->post('id');

		$exe 	= $this->db->get_where('siswa', ['sisw_id' => $id])->row_array();

		$exe 	= $exe['sisw_nama'];

		if($exe !== FALSE)
		{
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($exe));	
		}
	}

	private function output_json($data) {
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('absen/keluar_model', 'Absen');
		// cek session
		$this->sesion->cek_session();
	}
}