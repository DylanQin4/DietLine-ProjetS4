<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlatModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_plat_by_type_regime($id_type_regime){
        $this->db->from('plat');
        $this->db->where('id_type_regime', $id_type_regime);
        return $this->db->get();
    }

    public function get_plat_by_id($id){
        $this->db->from('plat');
        $this->db->where('id', $id);
        return $this->db->get();
    }

    public function get_nb_type_plat(){
        $this->db->from('type_plat');
        return $this->db->count_all_results();
    }

    public function get_all_plat_ids_by_type($id_type_regime){
        $this->db->select('id');
        $this->db->from('plat');
        $this->db->where('id_type_regime', $id_type_regime);
        $query = $this->db->get();
        
        $platIds = array();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $platIds[] = $row['id'];
            }
        }
        
        return $platIds;
    }

    
}