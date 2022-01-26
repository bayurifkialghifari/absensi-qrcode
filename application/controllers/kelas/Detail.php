<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Detail extends Render_Controller {

	public function siswa($id) {

		// Page config:
		$this->title = 'Kelas Siswa';
		$this->content = 'kelas-detail'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['kelas'];
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
		$data 	= $this->kelas->getAllIsi($length, $start, $cari['value'], $id)->result_array();
		$count 	= $this->kelas->getAllIsi(null,null, $cari['value'], $id)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		$siswa = $this->input->post('siswa');
		$kksi_kkdj_id = $this->input->post('kksi_kkdj_id');

		$r = $this->kelas->insert($siswa, $kksi_kkdj_id);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function delete() {

		$id = $this->input->post('id');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->kelas->delete($id);

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
		$this->load->model('kelas/detail_model', 'kelas');
		// cek session
		$this->sesion->cek_session();
	}
}