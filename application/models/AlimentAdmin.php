<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlimentAdmin extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_list() {
        $sql = "SELECT p.id as id_plat, p.nom as nom, p.ingredients as ingredients,p.prix as prix,rt.type as type_regime FROM plat as p join 
        regime_type as rt on p.id_type_regime = rt.id";
        $query = $this->db->query($sql); 
        return $query->result_array(); 
    }

    public function l() {
        $sql = "SELECT * from type_plat";
        $query = $this->db->query($sql); 
        return $query->fetchone(); 
    }

        
     public function liste($id) {
        $sql = "SELECT * from plat where id = $id";
        $query = $this->db->query($sql); 
        return $query->result_array(); 
    }

    public function get_compose($id) {
        $sql = "SELECT p.id as id, p.nom as nom, p.ingredients as ingredients, p.prix as prix,tv.nom as type_viande,pv.poucentage
        from pourcentage_viande as pv join plat as p on pv.id_plat=p.id join type_viande as tv on pv.id_viande = tv.id where p.id = $id";
        $query = $this->db->query($sql); 
        return $query->result_array(); 
    }

    public function get_type_regime() {
        $sql = "SELECT * FROM regime_type";
        $query = $this->db->query($sql); 
        return $query->result_array(); 
    }

    public function ajout_aliment($data){
        $this->db->insert('plat', $data);
       $insert_id =$this->db->insert_id();
       return $insert_id;

    }
    public function ajout_pourcentage($datas){
        $this->db->insert('pourcentage_viande', $datas);
    }

    public function delete_Aliment($id){
        $query = "DELETE from plat where id = $id";
        $this->db->query(sprintf($query));
    }

    public function updateAliment($data,$id){
        $sql="UPDATE plat SET id_type_plat ='%s',id_type_regime ='%s',nom ='%s',ingredients='%s', prix=%s WHERE id =%s";
        $sql = sprintf($sql,$data['plat'],$data['regime'],$data['nom'],$data['ingredients'],$data['prix'],$id);
        $this->db->query($sql);
    }
}