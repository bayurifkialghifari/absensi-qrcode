<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar {

	public function upload($gambar = null, $path = null, $return = null)
	{
		$config['upload_path'] 			= $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 2024;
		
		$this->load->library('upload', $config);

        if ($this->upload->do_upload($gambar)) 
        {
        	chmod($config['upload_path'].$this->upload->data($return), 0755);
            return $this->upload->data($return);
        }
	}
}

/* End of file Gambar.php */
/* Location: ./application/libraries/Gambar.php */