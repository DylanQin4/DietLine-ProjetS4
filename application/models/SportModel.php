<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SportModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_sport_by_type_regime($id_type_regime){
        $this->db->from('sport');
        $this->db->where('id_type_regime', $id_type_regime);
        return $this->db->get();
    }

    public function get_sport_by_id($id){
        $this->db->from('sport');
        $this->db->where('id', $id);
        return $this->db->get();
    }

    public function get_all_sport_ids_by_type($id_type_regime){
        $this->db->select('id');
        $this->db->from('sport');
        $this->db->where('id_type_regime', $id_type_regime);
        $query = $this->db->get();
        
        $sportIds = array();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $sportIds[] = $row['id'];
            }
        }
        
        return $sportIds;
    }
}