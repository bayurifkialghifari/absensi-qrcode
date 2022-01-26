<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeOtomatis extends CI_Controller {

	// public function referensiKategori()
	// {
	// 	$this->db->select('RIGHT(kategori.id,5) as id', FALSE);
	// 	$this->db->order_by('id','DESC');    
	// 	$this->db->limit(1);    
	// 	$query = $this->db->get('kategori');  //cek dulu apakah ada sudah ada kode di tabel.    
	// 	if($query->num_rows() <> 0){      

	// 	   $data = $query->row();      
	// 	   $kode = intval($data->id) + 1; 
	// 	}
	// 	else{      
	// 	   $kode = 1; 
	// 	}
	//   	$tgl = date('Y'); 
	//   	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	//   	$kodetampil = "KTG-".$tgl."-".$batas;  
	// 	$output['id'] = $kodetampil;
	// 	$this->output->set_content_type('js');
	// 	$this->output->set_output(json_encode($output));
	// }
}	


		