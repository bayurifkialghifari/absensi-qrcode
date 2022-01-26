<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $lev_id=null){
		$this->db->select(" a.*, c.lev_id, c.lev_nama ");
		$this->db->from("users a");
		$this->db->join("role_users b", "b.rolu_user_id = a.user_id","left");
		$this->db->join("level c", "c.lev_id = b.rolu_lev_id","left");
		$this->db->where("c.lev_id",5);
		$this->db->where("(a.user_email LIKE '%".$cari."%' or a.user_name LIKE '%".$cari."%' or a.user_phone LIKE '%".$cari."%' or a.user_address LIKE '%".$cari."%' or c.lev_nama LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($email, $password, $name, $phone, $address, $lev_id) {

		$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone, user_address, created_date) VALUES (?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$email, $password, $name, $phone, $address, psql_datetime_format()]);

		$user_id = $this->db->insert_id();

		$sql2 = "INSERT INTO role_users (rolu_user_id, rolu_lev_id, created_date) VALUES (?, ?, ?);";
		$q2 = $this->db->query($sql2, [$user_id, $lev_id, psql_datetime_format()]);

		$return['id'] = $user_id;
		return $return;
	}

	public function update($id, $email, $name, $phone, $address, $lev_id){
		$sql = "UPDATE users SET user_email=?, user_name=?, user_phone=?, user_address=?, created_date=? WHERE user_id=?;";
		$q = $this->db->query($sql, [$email, $name, $phone, $address, psql_datetime_format(), $id]);

		$sql2 = "UPDATE role_users SET rolu_lev_id=?, created_date=? WHERE rolu_user_id=?;";
		$q2 = $this->db->query($sql2, [$lev_id, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql2 = "DELETE FROM role_users WHERE rolu_user_id=?;";
		$q2 = $this->db->query($sql2, [$id]);
		
		$sql = "DELETE FROM users WHERE user_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}