<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Siswa';
		$this->content = 'siswa-data'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['siswa'];
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
		$data 	= $this->siswa->getAllIsi($length, $start, $cari['value'], $status)->result_array();
		$count 	= $this->siswa->getAllIsi(null,null, $cari['value'], $status)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$nis = $this->input->post('nis');
		$nisn = $this->input->post('nisn');
		$nama = $this->input->post('nama');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$asal_sekolah = $this->input->post('asal_sekolah');

		$r = $this->siswa->insert($nis, $nisn, $nama, $no_hp, $email, $asal_sekolah);

		if($r !== FALSE) {

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
	 
	        $config['cacheable']    = true; //boolean, the default is true

	        // $config['cachedir']     = './assets/'; //string, the default is application/cache/
	        // $config['errorlog']     = './assets/'; //string, the default is application/logs/

	        $config['imagedir']     = './gambar/qr-code-siswa/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180); // array, default is array(0,0,0)

	        $this->ciqrcode->initialize($config);
	 
	        $image_name 			= $r['id'].'.png';
	 
	        $params['data'] 		= $r['id'];
	        $params['level'] 		= 'H';
	        $params['size'] 		= 10;
	        $params['savename'] 	= FCPATH . $config['imagedir'] . $image_name;

	        $this->ciqrcode->generate($params); // Execute QR CODE

	        $id 					= $r['id'];
	        $data_siswa['sisw_qrcode'] = $image_name;

	        $exe 					= $this->db->where('sisw_id', $id);
	        $exe 					= $this->db->update('siswa', $data_siswa);

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
		$nis = $this->input->post('nis');
		$nisn = $this->input->post('nisn');
		$nama = $this->input->post('nama');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$asal_sekolah = $this->input->post('asal_sekolah');

		$r = $this->siswa->update($id, $nis, $nisn, $nama, $no_hp, $email, $asal_sekolah);

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

		$get_qrCode = $this->db->where('sisw_id', $id)->get('siswa')->row_array();

		unlink('./gambar/qr-code-siswa/'.$get_qrCode['sisw_qrcode']);

		$r = $this->siswa->delete($id);


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
		$this->load->model('siswa/data_model', 'siswa');
		// cek session
		$this->sesion->cek_session();
	}
}