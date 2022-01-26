<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Pengguna extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengaturan Pengguna';
		$this->content = 'pengaturan-pengguna'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengaturan'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$lev_id 	= $this->input->post('lev_id');

		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->pengguna->getAllIsi($length, $start, $cari['value'], $lev_id)->result_array();
		$count 	= $this->pengguna->getAllIsi(null,null, $cari['value'], $lev_id)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$lev_id = $this->input->post('lev_id');
		$password = $this->b_password->create_hash($this->input->post('pass'));
		// Check values
		if(empty($email)) $this->output_json(['message' => 'Email tidak boleh kosong']);
		if(empty($name)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($phone)) $this->output_json(['message' => 'No HP tidak boleh kosong']);
		if(empty($address)) $this->output_json(['message' => 'Alamat tidak boleh kosong']);
		if(empty($lev_id)) $this->output_json(['message' => 'Level tidak boleh kosong']);

		$r = $this->pengguna->insert($email, $password, $name, $phone, $address, $lev_id);

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
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$lev_id = $this->input->post('lev_id');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);
		if(empty($email)) $this->output_json(['message' => 'Email tidak boleh kosong']);
		if(empty($name)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($phone)) $this->output_json(['message' => 'No HP tidak boleh kosong']);
		if(empty($address)) $this->output_json(['message' => 'Alamat tidak boleh kosong']);
		if(empty($lev_id)) $this->output_json(['message' => 'Level tidak boleh kosong']);

		$r = $this->pengguna->update($id, $email, $name, $phone, $address, $lev_id);

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

		$r = $this->pengguna->delete($id);

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
		$this->load->model('pengaturan/pengguna_model', 'pengguna');
		// cek session
		$this->sesion->cek_session();
	}
}