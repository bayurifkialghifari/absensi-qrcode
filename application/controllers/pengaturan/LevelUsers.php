<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class LevelUsers extends Render_Controller {

	public function index() {

		// Page Settings
		$this->title = 'Level Users';
		$this->content = 'pengaturan/levelUsers';
		$this->navigation = ['Pengaturan'];
		$this->plugins = ['datatables'];
		$this->data['records']	= $this->model->getData();
		$this->render();
	}

	function __construct() {
		parent::__construct();
		$this->load->model('pengaturan/levelUsersModel','model');
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
}