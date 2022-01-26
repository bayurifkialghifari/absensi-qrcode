<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

	public function getValuePengaturanMenuParent()
	{
		$get = $this->db->select('menu_id,menu_name')->order_by('menu_index','asc')->where('menu_menu_id',0)->get('menu')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}	
		
	public function getValuePengaturanPenggunaLevel()
	{
		$get = $this->db->select('lev_id,lev_nama')->order_by('lev_id','asc')->get('level')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueMenu()
	{
		$get = $this->db->select('*')
										->where('menu_menu_id',0)
										->get('menu a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueLevel()
	{
		$get = $this->db->select('*')
										// ->where('menu_menu_id',0)
										->get('level a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueSubMenu()
	{
		$menu_id = $this->input->post('menu_id');
		$get = $this->db->select('*')
										->where('menu_menu_id',$menu_id)
										->get('menu a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueKelas()
	{
		$get = $this->db->get('kelas')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueKelasDetail()
	{
		$get = $this->db->get('kelas_detail')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueJurusan()
	{
		$get = $this->db->get('jurusan')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueAngkatan()
	{
		$get = $this->db->get('angkatan')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueSiswa()
	{
		// ->where('sisw_kela_id', 0)
		$get = $this->db->where('sisw_kela_id', 0)->get('siswa')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueGuru()
	{
		$get = $this->db->select('b.*')
		                 ->from('role_users a')
		                 ->join('users b', 'b.user_id = a.rolu_user_id')
		                 ->join('level c', 'c.lev_id = a.rolu_lev_id')
		                 ->where('rolu_lev_id', 5)
		                 ->get()->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueMataPelajaran()
	{
		$get = $this->db->get('mata_pelajaran')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueKelasYangDiajar()
	{
		$get = $this->db->select(" a.*, b.*, c.*, d.*, e.*")->from("kelas_kelas_detail_jurusan_angkatan a")->join("kelas b", "b.kela_id 			= a.kkdj_kela_id")->join("kelas_detail c", "c.kede_id 	= a.kkdj_kede_id")->join("jurusan d", "d.juru_id 		= a.kkdj_juru_id")->join("angkatan e", "e.angk_id 		= a.kkdj_angk_id")->get()->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}
}	
