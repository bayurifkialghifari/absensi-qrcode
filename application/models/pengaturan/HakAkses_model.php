<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HakAkses_model extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $lev_id=null, $menu_id=null){
		$this->db->select(" a.*, b.*, c.menu_id as parent_id, c.menu_name as parent, a.created_date as created_date, d.lev_nama ");
		$this->db->from("role_aplikasi a");
		$this->db->join("menu b", "b.menu_id = a.rola_menu_id");
		$this->db->join("menu c", "c.menu_id = b.menu_menu_id","left");
		$this->db->join("level d", "d.lev_id = a.rola_lev_id");
		if($lev_id != null){
			$this->db->where('d.lev_id',$lev_id);
		}
		if($menu_id != null){
			$this->db->where('c.menu_id',$menu_id);
		}
		$this->db->where("(b.menu_name LIKE '%".$cari."%' or c.menu_name LIKE '%".$cari."%' or d.lev_nama LIKE '%".$cari."%' or a.created_date LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($lev_id, $menu_id, $menu_menu_id=null) {
		$sql = "INSERT INTO role_aplikasi (rola_lev_id, rola_menu_id, created_date) VALUES (?, ?, ?);";			

		if($menu_menu_id != null){
			$q = $this->db->query($sql, [$lev_id, $menu_menu_id, psql_datetime_format()]);
		}else{
			$q = $this->db->query($sql, [$lev_id, $menu_id, psql_datetime_format()]);
		}

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $lev_id, $menu_id, $menu_menu_id=null){
		$sql = "UPDATE role_aplikasi SET rola_lev_id=?, rola_menu_id=?, created_date=? WHERE rola_id=?;";
		if($menu_menu_id != null){
			$q = $this->db->query($sql, [$lev_id, $menu_menu_id, psql_datetime_format(), $id]);
		}else{
			$q = $this->db->query($sql, [$lev_id, $menu_id, psql_datetime_format(), $id]);
		}
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM role_aplikasi WHERE rola_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}