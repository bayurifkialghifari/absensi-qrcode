<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("semester a");
		$this->db->where("(a.seme_nama LIKE '%".$cari."%' or a.seme_keterangan LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $keterangan) {

		$sql = "INSERT INTO semester (seme_nama, seme_keterangan) VALUES (?, ?);";
		$q = $this->db->query($sql, [$nama, $keterangan]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $keterangan, $status){
		$get = $this->db->where('seme_status', 1)->get('semester')->num_rows();

		if($status == 2)
		{
			$sql = "UPDATE semester SET seme_nama=?, seme_keterangan=?, seme_status=? WHERE seme_id=?;";
			$q = $this->db->query($sql, [$nama, $keterangan, $status, $id]);
		}
		else
		{
			if($get > 0)
			{
				return FALSE;
			}
			else
			{
				$sql = "UPDATE semester SET seme_nama=?, seme_keterangan=?, seme_status=? WHERE seme_id=?;";
				$q = $this->db->query($sql, [$nama, $keterangan, $status, $id]);
			}
		}

		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM semester WHERE seme_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file semester_model.php */
/* Location: ./application/models/referensi/semester_model.php */