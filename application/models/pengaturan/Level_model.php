<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("level a");
		if($status != null){
			$this->db->where('lev_status',$status);
		}
		$this->db->where("(a.lev_nama LIKE '%".$cari."%' or a.lev_deskripsi LIKE '%".$cari."%' or a.lev_status LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $deskripsi, $status) {

		$sql = "INSERT INTO level (lev_nama, lev_deskripsi, lev_status, created_date) VALUES (?, ?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $deskripsi, $status, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $deskripsi, $status){
		$sql = "UPDATE level SET lev_nama=?, lev_deskripsi=?, lev_status=?, created_date=? WHERE lev_id=?;";
		$q = $this->db->query($sql, [$nama, $deskripsi, $status, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM level WHERE lev_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}