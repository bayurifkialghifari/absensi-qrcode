<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class HakAkses extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengaturan Hak Akses';
		$this->content = 'pengaturan-hak-akses'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengaturan'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$lev_id 	= $this->input->post('lev_id');
		$menu_id 	= $this->input->post('menu_id');

		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$data 	= $this->hakAkses->getAllIsi($length, $start, $cari['value'], $lev_id, $menu_id)->result_array();
		$count 	= $this->hakAkses->getAllIsi(null,null, $cari['value'], $lev_id, $menu_id)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$lev_id = $this->input->post('lev_id');
		$menu_id = $this->input->post('menu_id');
		$menu_menu_id = $this->input->post('menu_menu_id');
		
		// Check values
		if(empty($lev_id)) $this->output_json(['message' => 'Level tidak boleh kosong']);
		if(empty($menu_id)) $this->output_json(['message' => 'Menu tidak boleh kosong']);
		if(empty($menu_menu_id)) $this->output_json(['message' => 'Sub Menu tidak boleh kosong']);

		$r = $this->hakAkses->insert($lev_id, $menu_id, $menu_menu_id);

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
		// Input values
		$lev_id = $this->input->post('lev_id');
		$menu_id = $this->input->post('menu_id');
		$menu_menu_id = $this->input->post('menu_menu_id');
		
		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);
		if(empty($lev_id)) $this->output_json(['message' => 'Level tidak boleh kosong']);
		if(empty($menu_id)) $this->output_json(['message' => 'Menu tidak boleh kosong']);
		if(empty($menu_menu_id)) $this->output_json(['message' => 'Sub Menu tidak boleh kosong']);
		$r = $this->hakAkses->update($id, $lev_id, $menu_id, $menu_menu_id);

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

		$r = $this->hakAkses->delete($id);

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
		$this->load->model('pengaturan/hakAkses_model', 'hakAkses');
		// cek session
		$this->sesion->cek_session();
	}
}