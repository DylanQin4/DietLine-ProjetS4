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

	public function get_periode_regime($id_user, $etat){
		$date = new DateTime();
		$this->db->from('periode_regime');
		$this->db->where('periode_regime.etat', $etat);
		$this->db->where('periode_regime.id_user', $id_user);
		$this->db->where('periode_regime.date_fin >=', $date->format('Y-m-d'));

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	private function get_last_poids($id_user, $datetime){
		$datetime = new DateTime($datetime);
		$this->db->select('poids');
		$this->db->from('histo_morphology');
		$this->db->where('histo_morphology.id_user', $id_user);
		$this->db->where('histo_morphology.updated_at >=', $datetime->format('Y-m-d H:i:s'));
		$this->db->order_by('histo_morphology.id', 'ASC');
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->poids;
		} else {
			return null;
		}
	}

	
}