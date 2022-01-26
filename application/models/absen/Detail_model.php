<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $id){
		$this->db->select(" a.*, b.*, c.* ");
		$this->db->from("kelas_kelas_detail_jurusan_angkatan_siswa a");
		$this->db->join("kelas_kelas_detail_jurusan_angkatan b", "b.kkdj_id = a.kksi_kkdj_id");
		$this->db->join("siswa c", "c.sisw_id = a.kksi_sisw_id");
		// $this->db->join("kelas d", "d.kela_id = b.kkdj_kela_id");
		// $this->db->join("kelas_detail e", "e.kede_id = b.kkdj_kede_id");
		// $this->db->join("jurusan f", "f.juru_id = b.kkdj_juru_id");
		// $this->db->join("angkatan g", "g.angk_id = b.kkdj_angk_id");
		$this->db->order_by('c.sisw_nama ASC');
		$this->db->where("a.kksi_kkdj_id", $id);
		$this->db->where("(c.sisw_nama LIKE '%".$cari."%' or c.sisw_nis LIKE '%".$cari."%' or c.sisw_nisn LIKE '%".$cari."%' )");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}

		return $return;
	}

	public function absen($siswa, $kksi_kkdj_id) {

		$cek = $this->db->where('sisw_id', $siswa)
						->where('sisw_kela_id', $kksi_kkdj_id)
						->get('siswa')
						->num_rows();

		$cek2 = $this->db->select('a.*, b.*')
						->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
						->where('a.sisw_id', $siswa)
						->where('a.sisw_kela_id', $kksi_kkdj_id)
						->where('b.abse_tanggal', psql_date_format())
						->get('siswa a')
						->num_rows();

		if($cek > 0)
		{

			$get = $this->db->where('sisw_id', $siswa)
							->get('siswa')
							->row_array();

			$matp_id = $this->session->userdata('data')['mataPelajaran_id'];
			// $juru_id = $this->session->userdata('data')['jurusan_id'];

			if($get['sisw_status'] != 'Terabsen')
			{
				if($cek2 < 1)
				{
					$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_hadir, abse_matp_id, abse_seme_id, abse_tanggal, abse_jam) VALUES (?, ?, ?, ?, ?, ?, ?);";
					$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, 0, semester(), psql_date_format(), psql_time_format()]);
				}

				$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_hadir, abse_matp_id, abse_seme_id, abse_tanggal, abse_jam) VALUES (?, ?, ?, ?, ?, ?, ?);";
				$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, $matp_id, semester(), psql_date_format(), psql_time_format()]);

				$id_siswa = $this->input->post('siswa');
				$data['sisw_status'] = 'Terabsen';

				$exe = $this->db->where('sisw_id', $id_siswa)->update('siswa', $data);

				$return = $get;
			}
			else
			{
				$return['sisw_nama'] = 'Sudah Terabsen';
			}
		}
		else
		{
			$return['sisw_nama'] = 'Siswa Tidak Terdaftar';
		}

		return $return;
	}

	public function sakit($siswa, $kksi_kkdj_id, $keterangan)
	{
		$get = $this->db->where('sisw_id', $siswa)
						->get('siswa')
						->row_array();

		$cek2 = $this->db->select('a.*, b.*')
						->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
						->where('a.sisw_id', $siswa)
						->where('a.sisw_kela_id', $kksi_kkdj_id)
						->where('b.abse_tanggal', psql_date_format())
						->get('siswa a')
						->num_rows();

		$matp_id = $this->session->userdata('data')['mataPelajaran_id'];

		if($get['sisw_status'] != 'Terabsen')
		{ 
			if($cek2 < 1)
			{
				$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_sakit, abse_matp_id, abse_seme_id, abse_sakit_keterangan, abse_tanggal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			
				$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, 0, semester(), $keterangan, psql_date_format()]);
			}

			$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_sakit, abse_matp_id, abse_seme_id, abse_sakit_keterangan, abse_tanggal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			
			$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, $matp_id, semester(), $keterangan, psql_date_format()]);

			$id_siswa = $this->input->post('siswa');
			$data['sisw_status'] = 'Terabsen';

			$exe = $this->db->where('sisw_id', $id_siswa)->update('siswa', $data);

			$return = $get['sisw_nama'];
		}
		else
		{
			$return = 'Sudah Terabsen';
		}

		return $return;		
	}

	public function izin($siswa, $kksi_kkdj_id, $keterangan) {

		$get = $this->db->where('sisw_id', $siswa)
						->get('siswa')
						->row_array();

		$cek2 = $this->db->select('a.*, b.*')
						->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
						->where('a.sisw_id', $siswa)
						->where('a.sisw_kela_id', $kksi_kkdj_id)
						->where('b.abse_tanggal', psql_date_format())
						->get('siswa a')
						->num_rows();

		$matp_id = $this->session->userdata('data')['mataPelajaran_id'];

		if($get['sisw_status'] != 'Terabsen')
		{ 
			if($cek2 < 1)
			{
				$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_izin, abse_matp_id, abse_seme_id, abse_izin_keterangan, abse_tanggal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			
				$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, 0, semester(), $keterangan, psql_date_format()]);
			}

			$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_izin, abse_matp_id, abse_seme_id, abse_izin_keterangan, abse_tanggal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			
			$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, $matp_id, semester(), $keterangan, psql_date_format()]);

			$id_siswa = $this->input->post('siswa');
			$data['sisw_status'] = 'Terabsen';

			$exe = $this->db->where('sisw_id', $id_siswa)->update('siswa', $data);

			$return = $get['sisw_nama'];
		}
		else
		{
			$return = 'Sudah Terabsen';
		}

		return $return;
	}

	public function alpa($siswa, $kksi_kkdj_id, $keterangan) {

		$get = $this->db->where('sisw_id', $siswa)
						->get('siswa')
						->row_array();
		
		$cek2 = $this->db->select('a.*, b.*')
						->join('absensi_masuk b', 'b.abse_sisw_id = a.sisw_id', 'right')
						->where('a.sisw_id', $siswa)
						->where('a.sisw_kela_id', $kksi_kkdj_id)
						->where('b.abse_tanggal', psql_date_format())
						->get('siswa a')
						->num_rows();

		$matp_id = $this->session->userdata('data')['mataPelajaran_id'];

		if($get['sisw_status'] != 'Terabsen')
		{
			if($cek2 < 1)
			{
				$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_alpa, abse_matp_id, abse_seme_id, abse_alpa_keterangan, abse_tanggal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			
				$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, 0, semester(), $keterangan, psql_date_format()]);
			}

			$sql = "INSERT INTO absensi_masuk (abse_sisw_id, abse_kkdj_id, abse_alpa, abse_matp_id, abse_seme_id, abse_alpa_keterangan, abse_tanggal) VALUES (?, ?, ?, ?, ?, ?, ?);";
			$q = $this->db->query($sql, [$siswa, $kksi_kkdj_id, 1, $matp_id, semester(), $keterangan, psql_date_format()]);

			$id_siswa = $this->input->post('siswa');
			$data['sisw_status'] = 'Terabsen';

			$exe = $this->db->where('sisw_id', $id_siswa)->update('siswa', $data);

			$return = $get['sisw_nama'];
		}
		else
		{
			$return = 'Sudah Terabsen';
		}
		return $return;
	}		

	public function ChangeStatus($kksi_kkdj_id)
	{
		$get = $this->db->select('b.*')
						->from('kelas_kelas_detail_jurusan_angkatan_siswa a')
						->join('siswa b', 'a.kksi_sisw_id = b.sisw_id', 'right')
						->where('a.kksi_kkdj_id', $kksi_kkdj_id)
						->get()->result_array();

		foreach($get as $r)
		{
			$id = $r['sisw_id'];
			$data['sisw_status'] = '';

			$exe = $this->db->where('sisw_id', $id)->update('siswa', $data);
		}

		// $execute = $this->db->where('kkdj_id', $kksi_kkdj_id)->update('kelas_kelas_detail_jurusan_angkatan', ['kkdj_status' => '']);

		return $exe;
	}
}

/* End of file jurusan_model.php */
/* Location: ./application/models/referensi/jurusan_model.php */