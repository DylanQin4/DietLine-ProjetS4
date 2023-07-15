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

    public function get_plat_by_id($id) {
        $this->db->from('plat');
        $this->db->where('id', $id);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function get_plat_with_pourcentage_viande($id) {
        $sql = "SELECT plat.*, pourcentage_viande.poucentage, type_viande.nom AS nom_viande
                FROM plat
                LEFT JOIN pourcentage_viande ON pourcentage_viande.id_plat = plat.id
                LEFT JOIN type_viande ON type_viande.id = pourcentage_viande.id_viande
                WHERE plat.id = ?";
    
        $query = $this->db->query($sql, array($id));
    
        if ($query->num_rows() > 0) {
            $plat = array(
                'id' => null,
                'nom' => null,
                'ingredients' => null,
                'prix' => null,
            );
    
            foreach ($query->result() as $row) {
                if ($plat['id'] === null) {
                    $plat['id'] = $row->id;
                    $plat['nom'] = $row->nom;
                    $plat['ingredients'] = $row->ingredients;
                    $plat['prix'] = $row->prix;
                }
            }
    
            return $plat;
        } else {
            return null;
        }
    }
    
        
    
    

    public function get_all_plat_ids_by_type($id_type_regime){
        $this->db->select('id');
        $this->db->from('plat');
        $this->db->where('id_type_regime', $id_type_regime);
        $query = $this->db->get();
        
        $platIds = array();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $platIds[] = intval($row['id']);
            }
        }
        
        return $platIds;
    }

    public function get_pourcentage_viande_by_plat($id_plat){
        $this->db->from('pourcentage_viande');
        $this->db->where('id_plat', $id_plat);
        return $this->db->get();
    }

    
}