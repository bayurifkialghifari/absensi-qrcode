<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render_Controller extends CI_Controller {

	protected $default_template;
	protected $app_name;
	protected $title;
	protected $content;
	protected $navigation = array();
	protected $data = array();
	protected $plugins = array();
	private $plugin_scripts = array();
	private $plugin_styles = array();

	protected function getTitle() {
		if($this->title === NULL) return $this->app_name;
		elseif($this->app_name === NULL) return $this->title;
		else return $this->title . ' | ' . $this->app_name;
	}

	protected function preRender() { }

	protected function render($template = NULL) {
		$this->preRender();
		$this->loadPlugins();
		if($template == NULL) {
			$template = $this->default_template;
		}
		$data = array(
			'title' => $this->getTitle(),
			'navigation' => $this->navigation,
			'plugin_styles' => $this->plugin_styles,
			'plugin_scripts' => $this->plugin_scripts,
			'content' => $this->content,
		);
		$data = array_merge($data, $this->data);
		$this->load->view($template, $data);
	}

	private function loadPlugins() {
		if(empty($this->plugins)) return;

		$result = $this->plugin->load_plugins($this->plugins);

		$this->plugin_styles = $result['styles'];
		$this->plugin_scripts = $result['scripts'];
	}

	function __construct() {
		parent::__construct();
		$this->app_name = $this->config->item('app_name');
		$this->load->library('plugin');

	}
}