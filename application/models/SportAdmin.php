<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SportAdmin extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
    public function get_list_sport() {
        $sql = "SELECT s.id as id, s.id_type_regime as id_regime,s.nom as nom, r.type as type from sport as s join regime_type as r on s.id_type_regime = r.id";
        $query = $this->db->query($sql); 
        return $query->result_array(); 
   }

   public function get_sport($id) {
    $sql = "SELECT * FROM sport where id = $id";
    $query = $this->db->query($sql); 
    return $query->result_array(); 
}

public function get_type() {
    $sql = "SELECT * From regime_type";
    $query = $this->db->query($sql); 
    return $query->result_array(); 
}

public function deleteSport($id){
    $query = "DELETE from sport where id = $id";
    $this->db->query(sprintf($query));
   }

   
   public function ajout_sport($data){
    $query="INSERT INTO sport(id_type_regime,nom) values(%s,%s)";
    $query = sprintf(
        $query,
        $this->db->escape($data['type']),
        $this->db->escape($data['nom'])
    );
    $this->db->query($query);
}

public function update_sport($data,$id){
    $sql="UPDATE sport SET id_type_regime ='%s',nom ='%s' WHERE id =%s";
    $sql = sprintf($sql,$data['type'],$data['nom'],$id);
    $this->db->query($sql);
}

}