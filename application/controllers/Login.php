<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Login extends Render_Controller {

	public function index() {
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title = 'Login';
		$this->content = 'login';
		$this->navigation = [];
		$this->render();
	}

	public function doLogin(){
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		$email 		= $this->input->post('email');
		$password = $this->input->post('password');
		$login 		= $this->model->cekLogin($email,$password);

		if($login['status'] == 0){
			
			if($login['data'][0]['lev_nama'] == 'Guru')
			{
				$id = $login['data'][0]['user_id'];

				$exe = $this->db->select('u.*, p.*, m.*, j.*')
								->from('pengajar p')
								->join('users u', 'p.pena_user_id = u.user_id')
								->join('mata_pelajaran m', 'p.pena_matp_id = m.matp_id')
								->join('jurusan j', 'p.pena_juru_id = j.juru_id')
								->where('p.pena_user_id', $id)
								->get()
								->row_array();

				$session = array(
					'status' => true,
					'data'	 => array
									(
										'id' => $exe['user_id'],
										'nama' => $exe['user_name'],
										'email' => $exe['user_email'],
										'jurusan' => $exe['juru_nama'],
										'jurusan_id' => $exe['juru_id'],
										'mataPelajaran' => $exe['matp_nama'], 
										'mataPelajaran_id' => $exe['matp_id'], 
										'kkdj_id' => $exe['pena_kkdj_id'],
										'level' => 'Guru'
									)
				);
			}
			else
			{
				$session = array(
					'status' => true,
					'data'	 => array
									(
										'id' => $login['data'][0]['user_id'],
										'nama' => $login['data'][0]['user_name'],
										'email' => $login['data'][0]['user_email'], 
										'level' => $login['data'][0]['lev_nama']
									)
				);	
			}

			$this->session->set_userdata($session);

			redirect('dashboard','refresh');
		}else{
			echo "<script>alert('Login gagal. email atau password')</script>";
			redirect('login','refresh');
		}
	}

	public function logout(){
		$session = array('status','data');
		$this->session->unset_userdata($session);
		redirect('login','refresh');
	}

	public function daftar() {
		// Page Settings
		$this->title = 'Daftar';
		$this->content = 'daftar';
		$this->navigation = [];
		$this->render();
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/login';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');
		// $insert['user_nip'] 			= '1234567890';
		// $insert['user_email']			= 'soni.setiawan.it07@gmail.com';
		// $insert['user_password']	= $this->b_password->create_hash('sonisetiawan');
		// $insert['user_nama']			= 'Soni Setiawan';
		// $insert['user_photo']			= 'soni.jpg';

		// $exe = $this->db->insert('users',$insert);
		// var_dump($exe);
		// exit();

	}
}