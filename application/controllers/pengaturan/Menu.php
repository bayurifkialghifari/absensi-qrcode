<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Menu extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengaturan Menu';
		$this->content = 'pengaturan-menu'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengaturan'];
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
		$data 	= $this->menu->getAllIsi($length, $start, $cari['value'], $status)->result_array();
		$count 	= $this->menu->getAllIsi(null,null, $cari['value'], $status)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$menu_menu_id = $this->input->post('menu_menu_id');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$index = $this->input->post('index');
		$icon = $this->input->post('icon');
		$url = $this->input->post('url');
		$status = $this->input->post('status');

		// Check values
		if(empty($name)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($description)) $this->output_json(['message' => 'Deskripsi tidak boleh kosong']);
		if(empty($index)) $this->output_json(['message' => 'Index tidak boleh kosong']);
		if(empty($icon)) $this->output_json(['message' => 'Icon tidak boleh kosong']);
		if(empty($url)) $this->output_json(['message' => 'Url tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->menu->insert($menu_menu_id, $name, $description, $index, $icon, $url, $status);

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
		$menu_menu_id = $this->input->post('menu_menu_id');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$index = $this->input->post('index');
		$icon = $this->input->post('icon');
		$url = $this->input->post('url');
		$status = $this->input->post('status');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);
		if(empty($name)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($description)) $this->output_json(['message' => 'Deskripsi tidak boleh kosong']);
		if(empty($index)) $this->output_json(['message' => 'Index tidak boleh kosong']);
		if(empty($icon)) $this->output_json(['message' => 'Icon tidak boleh kosong']);
		if(empty($url)) $this->output_json(['message' => 'Url tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->menu->update($id, $menu_menu_id, $name, $description, $index, $icon, $url, $status);

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

		$r = $this->menu->delete($id);

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
		$this->load->model('pengaturan/menu_model', 'menu');
		// cek session
		$this->sesion->cek_session();
	}
}