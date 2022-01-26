<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*");
		$this->db->from("pengajar a");
		$this->db->join("users b", "b.user_id 			= a.pena_user_id");
		$this->db->join("mata_pelajaran c", "c.matp_id 	= a.pena_matp_id");
		$this->db->join("jurusan d", "d.juru_id 		= a.pena_juru_id");
		$this->db->join("kelas_kelas_detail_jurusan_angkatan e", "e.kkdj_id 		= a.pena_kkdj_id");
		$this->db->join("kelas f", "f.kela_id 				= e.kkdj_kela_id");
		$this->db->join("kelas_detail g", "g.kede_id 		= e.kkdj_kede_id");
		$this->db->join("jurusan h", "h.juru_id 			= e.kkdj_juru_id");

		$this->db->where("(b.user_name LIKE '%".$cari."%' or c.matp_nama LIKE '%".$cari."%' or d.juru_nama LIKE '%".$cari."%' or f.kela_nama LIKE '%".$cari."%' or g.kede_detail LIKE '%".$cari."%' or h.juru_nama LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($guru, $mataPelajaran, $kelas, $jurusan) {
		$sql = "INSERT INTO pengajar (pena_user_id, pena_matp_id, pena_kkdj_id, pena_juru_id) VALUES (?, ?, ?, ?);";			

		$q = $this->db->query($sql, [$guru, $mataPelajaran, $kelas, $jurusan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $guru, $mataPelajaran, $kelas, $jurusan){
		$sql = "UPDATE pengajar SET pena_user_id=?, pena_matp_id=?, pena_kkdj_id=?, pena_juru_id=? WHERE pena_id=?;";

		$q = $this->db->query($sql, [$guru, $mataPelajaran, $kelas, $jurusan, $id]);
		
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM pengajar WHERE pena_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}