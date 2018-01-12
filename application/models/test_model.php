<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_my_data(){
        $rows = $this->db->from('counterparty')->get()->result();
        return $rows;
    }

    function get_report_client($data){

        $rows = $this->db->from('contract')->where('id',$data);
    }

}