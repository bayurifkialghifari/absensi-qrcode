<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasDetail_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("kelas_detail a");
		if($status != null){
			$this->db->where('kede_status',$status);
		}
		$this->db->where("(a.kede_detail LIKE '%".$cari."%' or a.kede_status LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($detail, $status) {

		$sql = "INSERT INTO kelas_detail (kede_detail, kede_status) VALUES (?, ?);";
		$q = $this->db->query($sql, [$detail, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $detail, $status){
		$sql = "UPDATE kelas_detail SET kede_detail=?, kede_status=? WHERE kede_id=?;";
		$q = $this->db->query($sql, [$detail, $status, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM kelas_detail WHERE kede_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file KelasDetail_model.php */
/* Location: ./application/models/referensi/KelasDetail_model.php */