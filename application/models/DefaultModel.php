<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DefaultModel extends CI_Model {

	public function menu()
	{
		$session_id = $this->session->userdata('data')['id'];
		$where = array(
			'b.menu_menu_id' => 0,
			'b.menu_status' => 'Aktif',
			'd.rolu_user_id' => $session_id
		);
		$query = $this->db->select('*')
						  ->join('menu b','b.menu_id = a.rola_menu_id')
						  ->join('level c','c.lev_id = a.rola_lev_id')
						  ->join('role_users d','d.rolu_lev_id = c.lev_id')
				          ->order_by('b.menu_index','asc')
				          ->get_where('role_aplikasi a',$where)
				          ->result_array();
		return $query;
	}

	public function sub_menu($menu_id=null)
	{
		$session_id = $this->session->userdata('data')['id'];
		$where = array(
			'b.menu_menu_id' => $menu_id,
			'b.menu_status' => 'Aktif',
			'd.rolu_user_id' => $session_id
		);
		$query = $this->db->select('*')
						  ->join('menu b','b.menu_id = a.rola_menu_id')
						  ->join('level c','c.lev_id = a.rola_lev_id')
						  ->join('role_users d','d.rolu_lev_id = c.lev_id')
				          ->order_by('b.menu_index','asc')
				          ->get_where('role_aplikasi a',$where)
				          ->result_array();
		return $query;
	}
}
