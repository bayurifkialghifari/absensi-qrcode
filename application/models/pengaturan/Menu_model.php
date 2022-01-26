<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.*, b.menu_name as parent ");
		$this->db->from("menu a");
		$this->db->join("menu b", "b.menu_id = a.menu_menu_id","left");
		if($status != null){
			$this->db->where("a.menu_status",$status);
		}
		$this->db->where("(a.menu_name LIKE '%".$cari."%' or a.menu_description LIKE '%".$cari."%' or a.menu_index LIKE '%".$cari."%' or a.menu_icon LIKE '%".$cari."%' or a.menu_url LIKE '%".$cari."%' or a.menu_status LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($menu_menu_id, $name, $description, $index, $icon, $url, $status) {

		$sql = "INSERT INTO menu (menu_menu_id, menu_name, menu_description, menu_index, menu_icon, menu_url, menu_status, created_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$menu_menu_id, $name, $description, $index, $icon, $url, $status, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $menu_menu_id, $name, $description, $index, $icon, $url, $status){
		$sql = "UPDATE menu SET menu_menu_id=?, menu_name=?, menu_description=?, menu_index=?, menu_icon=?, menu_url=?, menu_status=?, created_date=? WHERE menu_id=?;";
		$q = $this->db->query($sql, [$menu_menu_id, $name, $description, $index, $icon, $url, $status, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM menu WHERE menu_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}