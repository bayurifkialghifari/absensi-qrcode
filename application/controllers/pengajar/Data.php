<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengajar';
		$this->content = 'pengajar-data'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['pengajar'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->pengajar->getAllIsi($length, $start, $cari['value'])->result_array();
		$count 	= $this->pengajar->getAllIsi(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		$guru = $this->input->post('guru');
		$mataPelajaran = $this->input->post('mataPelajaran');
		$kelas = $this->input->post('kelas');
		$jurusan = $this->input->post('jurusan');

		$r = $this->pengajar->insert($guru, $mataPelajaran, $kelas, $jurusan);

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
		$guru = $this->input->post('guru');
		$mataPelajaran = $this->input->post('mataPelajaran');
		$kelas = $this->input->post('kelas');
		$jurusan = $this->input->post('jurusan');
		
		$r = $this->pengajar->update($id, $guru, $mataPelajaran, $kelas, $jurusan);

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

		$r = $this->pengajar->delete($id);

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
		$this->load->model('pengajar/data_model', 'pengajar');
		// cek session
		$this->sesion->cek_session();
	}
}