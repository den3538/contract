<?php

class Main_model  extends CI_Model  {
	
	public function __construct()
	{
			parent::__construct();
	}
	
	public function get($id)
	{
			$responsible = $this->db->from('responsible')->where('id', $id)->get()->result()[0]->contract_id;
			$contract = $this->db->from('contract')->where('id', $responsible)->get()->result()[0];
			$kind = $this->db->from('kind')->where('id', $contract->kind_id)->get()->result()[0];
			$contract->kind = $kind->name;
			return $contract;
	}

}
