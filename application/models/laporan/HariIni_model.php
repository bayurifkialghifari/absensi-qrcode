<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HariIni_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null){
		
		// $id = $this->session->userdata('data')['kkdj_id'];

		// $where = "a.kkdj_id = {$id}";

		$this->db->select(" a.*, b.*, c.*, d.*, e.*");
		$this->db->from("kelas_kelas_detail_jurusan_angkatan a");
		$this->db->join("kelas b", "b.kela_id 			= a.kkdj_kela_id");
		$this->db->join("kelas_detail c", "c.kede_id 	= a.kkdj_kede_id");
		$this->db->join("jurusan d", "d.juru_id 		= a.kkdj_juru_id");
		$this->db->join("angkatan e", "e.angk_id 		= a.kkdj_angk_id");
		// $this->db->where($where);
		$this->db->where("(b.kela_nama LIKE '%".$cari."%' or c.kede_detail LIKE '%".$cari."%' or d.juru_nama LIKE '%".$cari."%' or e.angk_nama LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}

		return $return;
	}

	public function getAllIsiDetail($id=null,$show=null, $start=null, $cari=null)
	{
		$this->db->select(" a.*, b.*, c.* ");
		$this->db->from("kelas_kelas_detail_jurusan_angkatan_siswa a");
		$this->db->join("kelas_kelas_detail_jurusan_angkatan b", "b.kkdj_id = a.kksi_kkdj_id");
		$this->db->join("siswa c", "c.sisw_id = a.kksi_sisw_id");
		// $this->db->join("kelas d", "d.kela_id = b.kkdj_kela_id");
		// $this->db->join("kelas_detail e", "e.kede_id = b.kkdj_kede_id");
		// $this->db->join("jurusan f", "f.juru_id = b.kkdj_juru_id");
		// $this->db->join("angkatan g", "g.angk_id = b.kkdj_angk_id");
		$this->db->order_by('c.sisw_nama ASC');
		$this->db->where("a.kksi_kkdj_id", $id);
		// $this->db->where("(c.sisw_nama LIKE '%".$cari."%' or c.sisw_nis LIKE '%".$cari."%' or c.sisw_nisn LIKE '%".$cari."%' )");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}

		return $return;
	}

	public function getKelas($id)
	{
		return $this->db->select('a.kela_nama, b.juru_nama, c.kede_detail')
							->from('kelas_kelas_detail_jurusan_angkatan d')
							->join('kelas a', 'd.kkdj_kela_id = a.kela_id') 
							->join('kelas_detail c', 'd.kkdj_kede_id = c.kede_id') 
							->join('jurusan b', 'd.kkdj_juru_id = b.juru_id')
							->where('kkdj_id', $id)
							->get();
	}
}

/* End of file HariIni_model.php */
/* Location: ./application/models/laporan/HariIni_model.php */