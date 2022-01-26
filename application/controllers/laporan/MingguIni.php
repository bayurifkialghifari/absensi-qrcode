<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';
require_once APPPATH. 'libraries/dompdf/dompdf_config.inc.php';

class MingguIni extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Laporan';
		$this->content = 'laporan-mingguIni'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengaturan'];
		$this->data['kelas'] = $this->model->getAllIsi()->result_array();
		// Commit render:
		$this->render();
	}

	public function detail($id)
	{
		// Page config:
		$this->title = 'Laporan';
		$this->content = 'laporan-mingguIni-detail'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengaturan'];
		$this->data['siswa'] = $this->model->getAllIsiDetail($id)->result_array();
		// var_dump($this->data['siswa']);exit;
		$this->data['id'] = $id;
		// Commit render:
		$this->render();	
	}

	public function getDataDetail()
	{
		$id = $this->input->post('id');

		$get = $this->db->where('sisw_id', $id)->get('siswa')->row_array();

		$this->output_json($get);
	}

	public function getDataDetailAbsenMasuk($matp = null, $sisw = null, $seme = null)
	{
		$id = $this->input->post('id');

        if($matp == null)
        {
        	$where 	= 0;
        }

        if($matp != null)
        {
        	$where 	= (int)$matp;
        }

        if($sisw != null)
        {
        	$id 	= $sisw;
        }

		$get = $this->db->select('sum(b.abse_hadir) as hadir, sum(b.abse_izin) as izin, sum(b.abse_sakit) as sakit, sum(b.abse_alpa) as alpa, b.*')
														->from('siswa a')
														->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
														->where('b.abse_sisw_id', $id)
														->where('YEARWEEK(b.abse_tanggal)=YEARWEEK(NOW())')
							                            ->where('b.abse_matp_id', $where)
														->get()
														->row_array();

		$this->output_json($get);
	}

	public function getDataDetailAbsenKeluar($matp = null, $sisw = null, $seme = null)
	{
		$id = $this->input->post('id');

		if($matp == null)
        {
        	$where 	= 0;
        }

        if($matp != null)
        {
        	$where 	= (int)$matp;
        }

        if($sisw != null)
        {
        	$id 	= $sisw;
        }

		$get = $this->db->select('sum(b.absk_hadir) as hadir, sum(b.absk_izin) as izin, sum(b.absk_sakit) as sakit, sum(b.absk_alpa) as alpa, b.*')
														->from('siswa a')
														->join('absensi_keluar b', 'b.absk_sisw_id = a.sisw_id', 'right')
														->where('b.absk_sisw_id', $id)
														->where('YEARWEEK(b.absk_tanggal)=YEARWEEK(NOW())')
							                            ->where('b.absk_matp_id', $where)
														->get()
														->row_array();

		$this->output_json($get);
	}

	public function exportExcel($id)
	{
		$r 				= $this->model->getKelas($id)->row_array();
		$data['kelas'] 	= $r['kela_nama'] . ' ' . $r['juru_nama'] . ' ' . $r['kede_detail'];
		$data['siswa'] 	= $this->model->getAllIsiDetail($id)->result_array();
		$data['id'] 	= $id;

		$this->load->view('laporan/excel/mingguIni', $data);
	}

	public function exportPDF($id)
	{	
		$r 				= $this->model->getKelas($id)->row_array();

		$data['kelas'] 	= $r['kela_nama'] . ' ' . $r['juru_nama'] . ' ' . $r['kede_detail'];
		$data['siswa'] 	= $this->model->getAllIsiDetail($id)->result_array();
		$data['id'] 	= $id;

		$html 			= $this->load->view('laporan/pdf/mingguIni', $data, true);

		$dompdf 		= new Dompdf();

	    $dompdf->load_html($html);
	    
	    $dompdf->set_paper('A4' , 'landscape');

		$dompdf->render();

		$filename 		= 'laporan_absen_'.$data['kelas']."_minggu_ini";

		$pdf  			=  $dompdf->output();

		$dompdf->stream($filename, array('Attachment' => false));
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
		$this->load->model('laporan/mingguIni_model', 'model');
		// cek session
		$this->sesion->cek_session();
	}
}