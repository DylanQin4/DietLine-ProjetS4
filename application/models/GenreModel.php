<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenreModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function getAll(){
		$query = $this->db->get('genre');
        return $query->result();
    }
}