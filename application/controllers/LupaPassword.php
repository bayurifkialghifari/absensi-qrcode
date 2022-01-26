<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class lupaPassword extends Render_Controller {

	public function index() 
	{
		if($this->session->userdata('status') == true) 
		{
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title = 'Lupa Password';
		$this->content = 'lupaPassword';
		$this->navigation = [];
		$this->render();
	}

	public function reset()
	{
		if($this->session->userdata('status') == true)
		{
			redirect('dashboard','refresh');
		}
		
		$email 			= $this->input->post('email');
		$cek 			= $this->model->cekAkun($email);

		if($cek['status'] == 0)
		{
			$config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'gwp01070@gmail.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => '@Cimahi123',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "\r\n",
               'newline'   => "\r\n"
           ];

            // Load library email dan konfigurasinya
            $this->load->library('email', $config);

            // Email dan nama pengirim
            $this->email->from('absensiQRCODE@smktignc.com', 'Absensi QR-Code SMK TI GARUDA NUSANTARA CIMAHI');

            // Email penerima
            $this->email->to($email); // Ganti dengan email tujuan kamu

            // Subject email
            $this->email->subject('Password Baru Anda');

            // Isi email
            $this->email->message("Password baru anda adalah : <i>" . $cek['password'] . "</i> .<br><br> Klik <strong><a href='". base_url() ."' target='_blank'>Disini</a></strong> untuk melakukan login kembali.");

            if (!$this->email->send()) 
            {
                show_error($this->email->print_debugger());

                exit; 
            }
            else{}

			// echo "<script>alert('".$cek['password']."')</script>";
			echo "<script>alert('Silakan Cek Email Anda')</script>";

			redirect('login','refresh');
		}else
		{
			echo "<script>alert('Email tidak ditemukan')</script>";
			
			redirect('lupaPassword','refresh');
		}
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/lupaPassword';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');
		
	}
}