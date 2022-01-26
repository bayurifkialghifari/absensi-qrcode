<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model {

	public function getAllData()
	{
		$id 		= $this->session->userdata('data')['id'];

		$exe 		= $this->db->where('user_id', $id);
		$exe 		= $this->db->get_where('users');

		return $exe;
	}

	public function ubah()
	{
		$id = $this->input->post('id');

		$data['user_name'] = $this->input->post('nama');
		$data['user_phone'] = $this->input->post('notelp');
		$data['user_address'] = $this->input->post('alamat');

		$exe = $this->db->where('user_id', $id);
		$exe = $this->db->update('users', $data);

		$session = array
		(
				'status' => true,
				'data'	 => array
							(
								'id' => $id,
								'nama' => $data['user_name'],
								'email' => $this->session->userdata('data')['email'], 
								'level' => $this->session->userdata('data')['level']
							)
		);
		
		$this->session->set_userdata($session);
	}
}

/* End of file ProfileModel.php */
/* Location: ./application/models/ProfileModel.php */