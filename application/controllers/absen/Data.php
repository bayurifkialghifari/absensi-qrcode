<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Kelas';
		$this->content = 'absen-data'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['absen'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->absen->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->absen->getAllIsi(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		$kela = $this->input->post('kela');
		$kede = $this->input->post('kede');
		$angkatan = $this->input->post('angkatan');
		$jurusan = $this->input->post('jurusan');

		$r = $this->absen->insert($kela, $kede, $angkatan, $jurusan);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function update() {

		// Input values
		$id = $this->input->post('id');
		$kela = $this->input->post('kela');
		$kede = $this->input->post('kede');
		$angkatan = $this->input->post('angkatan');
		$jurusan = $this->input->post('jurusan');
		
		$r = $this->absen->update($id, $kela, $kede, $angkatan, $jurusan);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $r,
				]
			);
		}
	}

	public function delete() {

		$id = $this->input->post('id');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->absen->delete($id);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
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
		$this->load->model('absen/data_model', 'absen');
		// cek session
		$this->sesion->cek_session();
	}
}