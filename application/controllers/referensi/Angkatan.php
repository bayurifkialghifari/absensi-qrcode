<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Angkatan extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Referensi Angkatan';
		$this->content = 'referensi-angkatan'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['referensi'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$status 	= $this->input->post('status');
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->angkatan->getAllIsi($length, $start, $cari['value'], $status)->result_array();
		$count 	= $this->angkatan->getAllIsi(null,null, $cari['value'], $status)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$nama = $this->input->post('nama');
		$keterangan = $this->input->post('keterangan');

		// Check values
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'keterangan tidak boleh kosong']);

		$r = $this->angkatan->insert($nama, $keterangan);

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
		$nama = $this->input->post('nama');
		$keterangan = $this->input->post('keterangan');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'keterangan tidak boleh kosong']);

		$r = $this->angkatan->update($id, $nama, $keterangan);

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

		$r = $this->angkatan->delete($id);

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
		$this->load->model('referensi/angkatan_model', 'angkatan');
		// cek session
		$this->sesion->cek_session();
	}
}