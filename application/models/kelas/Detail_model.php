<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $id){
		$this->db->select(" a.*, b.*, c.* ");
		$this->db->from("kelas_kelas_detail_jurusan_angkatan_siswa a");
		$this->db->join("kelas_kelas_detail_jurusan_angkatan b", "b.kkdj_id = a.kksi_kkdj_id");
		$this->db->join("siswa c", "c.sisw_id = a.kksi_sisw_id", "left");
		// $this->db->join("kelas d", "d.kela_id = b.kkdj_kela_id");
		// $this->db->join("kelas_detail e", "e.kede_id = b.kkdj_kede_id");
		// $this->db->join("jurusan f", "f.juru_id = b.kkdj_juru_id");
		// $this->db->join("angkatan g", "g.angk_id = b.kkdj_angk_id");
		$this->db->where("a.kksi_kkdj_id", $id);
		$this->db->where("(c.sisw_nama LIKE '%".$cari."%' or c.sisw_nis LIKE '%".$cari."%' or c.sisw_nisn LIKE '%".$cari."%' ) ");
		$this->db->order_by('c.sisw_nis', 'asc');
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}

		return $return;
	}

	public function insert($siswa, $kksi_kkdj_id) {

		$sql = "INSERT INTO kelas_kelas_detail_jurusan_angkatan_siswa (kksi_sisw_id, kksi_kkdj_id) VALUES (?, ?);";
		$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id]);

		// $get = $this->db->select('b.*')
						 // ->from('kelas_kelas_detail_jurusan_angkatan a')
		                 // ->join('kelas b', 'b.kela_id = a.kkdj_kela_id')
		                 // ->where('kkdj_id', $kksi_kkdj_id)
		                 // ->get()->row_array();

		$id_siswa = $this->input->post('siswa');
		$data['sisw_kela_id'] = $kksi_kkdj_id;

		$exe = $this->db->where('sisw_id', $id_siswa)->update('siswa', $data);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function delete($id) {
		$get = $this->db->select('a.*')
						->from('kelas_kelas_detail_jurusan_angkatan_siswa a')
						->where('a.kksi_id', $id)
						->get()->row_array();

		$id_siswa = $get['kksi_sisw_id'];
		$data['sisw_kela_id'] = 0;

		$exe = $this->db->where('sisw_id', $id_siswa)->update('siswa', $data);

		$sql = "DELETE FROM kelas_kelas_detail_jurusan_angkatan_siswa WHERE kksi_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}	
}

/* End of file jurusan_model.php */
/* Location: ./application/models/referensi/jurusan_model.php */