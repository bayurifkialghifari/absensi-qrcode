<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class KelasDetail extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Referensi Kelas Detail';
		$this->content = 'referensi-kelas-detail'; 
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
		$data 	= $this->kelasDetail->getAllIsi($length, $start, $cari['value'], $status)->result_array();
		$count 	= $this->kelasDetail->getAllIsi(null,null, $cari['value'], $status)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$detail = $this->input->post('detail');
		$status = $this->input->post('status');

		// Check values
		if(empty($detail)) $this->output_json(['message' => 'detail tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->kelasDetail->insert($detail, $status);

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
		$detail = $this->input->post('detail');
		$status = $this->input->post('status');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);
		if(empty($detail)) $this->output_json(['message' => 'detail tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->kelasDetail->update($id, $detail, $status);

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

		$r = $this->kelasDetail->delete($id);

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
		$this->load->model('referensi/kelasDetail_model', 'kelasDetail');
		// cek session
		$this->sesion->cek_session();
	}
}