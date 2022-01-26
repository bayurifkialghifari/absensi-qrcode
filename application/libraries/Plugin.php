<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin {

	const RELATIVE_BASE = 'base';
	const RELATIVE_SITE = 'site';

	private $CI = NULL;

	public function load_plugins($plugins) {

		$plugin_styles = array();
		$plugin_scripts = array();

		foreach ($plugins as $plugin) {
			$p = $this->CI->config->item($plugin, 'plugins');
			if(!empty($p)) {
				if(isset($p['styles'])) {
					foreach ($p['styles'] as $style) {
						array_push($plugin_styles, $this->build_url($style));
					}
				}
				if(isset($p['scripts'])) {
					foreach ($p['scripts'] as $script) {
						array_push($plugin_scripts, $this->build_url($script));
					}
				}
			}
		}

		return array('scripts' => $plugin_scripts, 'styles' => $plugin_styles);
	}

	public function build_url($plugin, $cached = NULL, $version = NULL, $relative = self::RELATIVE_BASE) {

		if(is_string($plugin)) {
			$file = $plugin;
			$cached = ($cached === NULL) ? (ENVIRONMENT !== 'development') : $cached;
		}
		elseif(is_array($plugin) && isset($plugin['file'])) {
			$file = $plugin['file'];
			$relative = isset($plugin['relative']) ? $plugin['relative'] : self::RELATIVE_BASE;
			$version = isset($plugin['version']) ? $plugin['version'] : NULL;
			$cached = isset($plugin['cached']) ? $plugin['cached'] : (ENVIRONMENT !== 'development');
		}
		else {
			return;
		}

		$queries = array();

		if($version !== NULL) {
			$queries['v'] = $version;
		}

		if($cached === FALSE) {
			$queries['r'] = rand();
		}

		$q = empty($queries) ? NULL : ('?'.http_build_query($queries));
		$file .= $q;

		if($relative === self::RELATIVE_BASE) {
			return base_url($file);
		}
		elseif($relative === self::RELATIVE_SITE) {
			return site_url($file);
		}
	}

	function __construct() {
		$this->CI = &get_instance();

		$this->CI->load->helper('url');
		$this->CI->load->config('plugins', TRUE);
	}
}