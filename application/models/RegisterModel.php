<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends CI_Model {

	public function register()
	{
		$data1['user_email'] 			= $this->input->post('email');
		$data1['user_password'] 		= $this->b_password->create_hash($this->input->post('password'));
		$data1['user_name'] 			= $this->input->post('nama');
		$data1['user_phone'] 			= $this->input->post('notelp');
		$data1['user_address'] 			= $this->input->post('alamat');

		$exe1 							= $this->db->insert('users', $data1);

		$data2['rolu_user_id'] 			= $this->db->insert_id();
		$data2['rolu_lev_id'] 			= 3;

		$exe2 							= $this->db->insert('role_users', $data2);
	}	

}

/* End of file RegisterModel.php */
/* Location: ./application/models/RegisterModel.php */