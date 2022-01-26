<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, b.*, c.*, d.*, e.*");
		$this->db->from("kelas_kelas_detail_jurusan_angkatan a");
		$this->db->join("kelas b", "b.kela_id 			= a.kkdj_kela_id");
		$this->db->join("kelas_detail c", "c.kede_id 	= a.kkdj_kede_id");
		$this->db->join("jurusan d", "d.juru_id 		= a.kkdj_juru_id");
		$this->db->join("angkatan e", "e.angk_id 		= a.kkdj_angk_id");

		$this->db->where("(b.kela_nama LIKE '%".$cari."%' or c.kede_detail LIKE '%".$cari."%' or d.juru_nama LIKE '%".$cari."%' or e.angk_nama LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($kela, $kede, $angkatan, $jurusan) {
		$sql = "INSERT INTO kelas_kelas_detail_jurusan_angkatan (kkdj_kela_id, kkdj_kede_id, kkdj_angk_id, kkdj_juru_id) VALUES (?, ?, ?, ?);";			

		$q = $this->db->query($sql, [$kela, $kede, $angkatan, $jurusan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kela, $kede, $angkatan, $jurusan){
		$sql = "UPDATE kelas_kelas_detail_jurusan_angkatan SET kkdj_kela_id=?, kkdj_kede_id=?, kkdj_angk_id=?, kkdj_juru_id=? WHERE kkdj_id=?;";

		$q = $this->db->query($sql, [$kela, $kede, $angkatan, $jurusan, $id]);
		
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM kelas_kelas_detail_jurusan_angkatan WHERE kkdj_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}