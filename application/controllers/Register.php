<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Register extends Render_Controller {

	public function index() {
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title = 'Register';
		$this->content = 'daftar';
		$this->navigation = [];
		$this->render();
	}

	public function register()
	{
		$exe 		= $this->model->register();

		echo "<script>alert('Daftar Success !')</script>";
		redirect('login','refresh');
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/daftar';
		$this->load->model('registerModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');
		
	}
}