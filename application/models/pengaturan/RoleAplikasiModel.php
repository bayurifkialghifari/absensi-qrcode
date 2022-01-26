<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleAplikasiModel extends CI_Model {

	public function getData()
	{
		$where = array();
		$query = $this->db->select('a.cats_name as kategori,b.*')->join('categories a','b.cats_id = a.cats_cats_id','left')->order_by('a.created_date','desc')->get_where('categories b',$where)->result_array();
		return $query;
	}
}
