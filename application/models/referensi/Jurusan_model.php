<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("jurusan a");
		$this->db->where("(a.juru_nama LIKE '%".$cari."%' or a.juru_keterangan LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $keterangan) {

		$sql = "INSERT INTO jurusan (juru_nama, juru_keterangan) VALUES (?, ?);";
		$q = $this->db->query($sql, [$nama, $keterangan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $keterangan){
		$sql = "UPDATE jurusan SET juru_nama=?, juru_keterangan=? WHERE juru_id=?;";
		$q = $this->db->query($sql, [$nama, $keterangan, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM jurusan WHERE juru_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file jurusan_model.php */
/* Location: ./application/models/referensi/jurusan_model.php */