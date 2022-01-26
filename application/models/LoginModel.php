<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function cekLogin($email,$password)
	{
		$where = array(
			'user_email'		=> $email
		);

		$query = $this->query($where);

		if($query->num_rows() == 1){
			$cek = $this->b_password->verify($password,$query->result_array()[0]['user_password']);
			if($cek == true){
				$return['status'] = 0;
				$return['data'] 	= $query->result_array();
			}else{
				$return['status'] = 1;
				$return['data'] 	= null;
			}
		}else{
			$return['status'] = 1;
			$return['data'] 	= null;
		}
		return $return;
	}

	function cekAkun($email='')
	{
		$this->load->library('random_string');
		$where = array(
			'user_email'		=> $email
		);
		$query = $this->db->get_where('users',$where);
		
		if($query->num_rows() == 1)
		{
			$get_password						= $this->random_string->generate();
			$password 							= $this->b_password->create_hash($get_password);
			
			$return['status'] 					= 0;
			$return['password'] 				= $get_password;
			$return['encrypt_password'] 		= $password;

			$upd['user_password'] 				= $password;
			
			$this->db->where('user_email', $email);
			$this->db->update('users', $upd);
		}else
		{
			$return['status'] 					= 1;
			$return['password'] 				= null;
			$return['encrypt_password'] 		= null;
		}
		return $return;
	}

	function query($where){
		return $this->db->select('user_id,user_name,user_password,user_email,c.lev_nama')->join('role_users b','b.rolu_user_id = a.user_id')->join('level c','c.lev_id = b.rolu_lev_id')->get_where('users a',$where);
	}
}
