<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {
	
	public function getSiswa()
	{
		$sql 	= " SELECT count(sisw_id) as siswa
					FROM siswa;";

		$exe 	= $this->db->query($sql);

		return $exe;
	}

	public function getGuru()
	{
		$sql 	= " SELECT count(rolu_user_id) as guru
					FROM role_users WHERE rolu_lev_id = 5";

		$exe 	= $this->db->query($sql);

		return $exe;
	}

	public function getKelas()
	{
		$sql 	= " SELECT count(kkdj_id) as kelas
					FROM kelas_kelas_detail_jurusan_angkatan";

		$exe 	= $this->db->query($sql);

		return $exe;	
	}
}

/* End of file DashboardModel.php */
/* Location: ./application/models/DashboardModel.php */