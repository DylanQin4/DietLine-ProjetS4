<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IMCModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_imc_by_id($id){
		$this->db->from('imc');
		$this->db->where('id', $id);

		return $this->db->get();
    }

    public function getIMC(){
        $query = $this->db->get('imc');
        return $query->result();
    }
}