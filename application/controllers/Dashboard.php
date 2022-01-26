<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Dashboard extends Render_Controller {
	
	public function index() 
	{
		// Page Settings
		$this->title = 'Dashboard';
		$this->content = 'home';
		$this->navigation = ['Dashboard'];
		$this->data['menu_home'] = TRUE;
		$this->data['siswa'] = $this->model->getSiswa()->row_array();
		$this->data['guru'] = $this->model->getGuru()->row_array();
		$this->data['kelas'] = $this->model->getKelas()->row_array();
		$this->render();
	}

	public function getDataKehadiran()
	{
		$data = $this->db->select('sum(b.abse_hadir) as hadir, sum(b.abse_izin) as izin, sum(b.abse_sakit) as sakit, sum(b.abse_alpa) as alpa, b.*')
					->from('siswa a')
					->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
					->where('b.abse_tanggal', psql_date_format())
					->where('b.abse_matp_id', 0)
					->get()
					->row_array();

		$this->output_json($data);
	}

	public function getDataKehadiranMinggu()
	{
		$data = $this->db->select('sum(b.abse_hadir) as hadir, sum(b.abse_izin) as izin, sum(b.abse_sakit) as sakit, sum(b.abse_alpa) as alpa, b.*')
					->from('siswa a')
					->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
					->where('YEARWEEK(b.abse_tanggal)=YEARWEEK(NOW())')
					->where('b.abse_matp_id', 0)
					->get()
					->row_array();

		$this->output_json($data);	
	}

	public function getDataKehadiranBulan()
	{
		$data = $this->db->select('sum(b.abse_hadir) as hadir, sum(b.abse_izin) as izin, sum(b.abse_sakit) as sakit, sum(b.abse_alpa) as alpa, b.*')
					->from('siswa a')
					->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
					->where('MONTH(b.abse_tanggal)=MONTH(NOW())')
					->where('b.abse_matp_id', 0)
					->get()
					->row_array();

		$this->output_json($data);	
	}

	private function output_json($data) {
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() 
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->model('dashboardModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
}