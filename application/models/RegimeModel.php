<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegimeModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_regime_by_id($id){
		$this->db->from('regime');
		$this->db->where('id_user', $id);

		return $this->db->get();
    }

	
}