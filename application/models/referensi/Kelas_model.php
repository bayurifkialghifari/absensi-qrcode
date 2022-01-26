<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("kelas a");
		if($status != null){
			$this->db->where('kela_status',$status);
		}
		$this->db->where("(a.kela_nama LIKE '%".$cari."%' or a.kela_keterangan LIKE '%".$cari."%' or a.kela_status LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $keterangan, $status) {

		$sql = "INSERT INTO kelas (kela_nama, kela_keterangan, kela_status) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $keterangan, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $keterangan, $status){
		$sql = "UPDATE kelas SET kela_nama=?, kela_keterangan=?, kela_status=? WHERE kela_id=?;";
		$q = $this->db->query($sql, [$nama, $keterangan, $status, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM kelas WHERE kela_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file Kelas_model.php */
/* Location: ./application/models/referensi/Kelas_model.php */