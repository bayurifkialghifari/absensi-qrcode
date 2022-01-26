<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class RoleAplikasi extends Render_Controller {

	public function index() {

		// Page Settings
		$this->title 						= 'Role Aplikasi';
		$this->content 					= 'pengaturan/roleAplikasi';
		$this->navigation 			= ['Pengaturan'];
		$this->data['records']	= $this->model->getData();
		$this->render();
	}

	function __construct() {
		parent::__construct();
		$this->load->model('pengaturan/roleAplikasiModel','model');
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
}