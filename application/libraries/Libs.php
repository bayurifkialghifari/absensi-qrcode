<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Libs
{
    public function __construct()
    {
        //parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->helper(array('url','language'));
        
        date_default_timezone_set("Asia/Jakarta");

    }


    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function bycrypt($text){
        $options = [
            'cost' => 8,
        ];
        return password_hash($text, PASSWORD_DEFAULT, $options);
    }

    function timestamp(){
        $time       = date("H:i:s");
        $date       = date("Y-m-d");
        return $date." ".$time;
    }

    function format_tanggal($tanggal){
        $time       = date("H:i:s");
        $date       = date("Y-m-d");
        return $date." ".$time;
    }

    function set_config($name=null){
        $this->config->set_item('app_title', $name);
        return true;
    }

    function breadcrumb($name_1=null,$name_2=null,$name_3=null,$name_4=null){

    }
}


	