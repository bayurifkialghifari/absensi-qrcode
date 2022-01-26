<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataPelajaran_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("mata_pelajaran a");
		if($status != null){
			$this->db->where('matp_status',$status);
		}
		$this->db->where("(a.matp_nama LIKE '%".$cari."%' or a.matp_keterangan LIKE '%".$cari."%' or a.matp_status LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $keterangan, $status) {

		$sql = "INSERT INTO mata_pelajaran (matp_nama, matp_keterangan, matp_status) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $keterangan, $status]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $keterangan, $status){
		$sql = "UPDATE mata_pelajaran SET matp_nama=?, matp_keterangan=?, matp_status=? WHERE matp_id=?;";
		$q = $this->db->query($sql, [$nama, $keterangan, $status, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM mata_pelajaran WHERE matp_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file mata_pelajaran_model.php */
/* Location: ./application/models/referensi/mata_pelajaran_model.php */