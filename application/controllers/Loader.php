<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader extends CI_Controller {

	public function javascripts($filename) {

		$this->output->set_content_type('js');

		$file = $this->security->sanitize_filename($filename);

		if(file_exists(VIEWPATH."javascripts/$file.js")) {
			$this->load->view("javascripts/$file.js");
		}
		else {
			show_404();
		}
	}

	public function stylesheets($filename) {

		$this->output->set_content_type('css');

		$file = $this->security->sanitize_filename($filename);

		if(file_exists(VIEWPATH."stylesheets/$file.css")) {
			$this->load->view("stylesheets/$file.css");
		}
		else {
			show_404();
		}
	}

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}
}