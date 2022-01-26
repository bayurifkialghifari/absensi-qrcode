<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angkatan_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("angkatan a");
		$this->db->where("(a.angk_nama LIKE '%".$cari."%' or a.angk_keterangan LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $keterangan) {

		$sql = "INSERT INTO angkatan (angk_nama, angk_keterangan) VALUES (?, ?);";
		$q = $this->db->query($sql, [$nama, $keterangan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $keterangan){
		$sql = "UPDATE angkatan SET angk_nama=?, angk_keterangan=? WHERE angk_id=?;";
		$q = $this->db->query($sql, [$nama, $keterangan, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM angkatan WHERE angk_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file angkatan_model.php */
/* Location: ./application/models/referensi/angkatan_model.php */