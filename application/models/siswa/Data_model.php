<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("siswa a");
		$this->db->where("(a.sisw_nis LIKE '%".$cari."%' or a.sisw_nisn LIKE '%".$cari."%' or a.sisw_nama LIKE '%".$cari."%' or a.sisw_asal_sekolah LIKE '%".$cari."%' or a.sisw_no_hp LIKE '%".$cari."%' or a.sisw_email LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nis, $nisn, $nama, $no_hp, $email, $asal_sekolah) {

		$sql = "INSERT INTO siswa (sisw_nis, sisw_nisn, sisw_nama, sisw_no_hp, sisw_email, sisw_asal_sekolah) VALUES (?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$nis, $nisn, $nama, $no_hp, $email, $asal_sekolah]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nis, $nisn, $nama, $no_hp, $email, $asal_sekolah){
		$sql = "UPDATE siswa SET sisw_nis=?, sisw_nisn=?, sisw_nama=?, sisw_no_hp=?, sisw_email=?, sisw_asal_sekolah=? WHERE sisw_id=?;";
		$q = $this->db->query($sql, [$nis, $nisn, $nama, $no_hp, $email, $asal_sekolah, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM siswa WHERE sisw_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file jurusan_model.php */
/* Location: ./application/models/referensi/jurusan_model.php */