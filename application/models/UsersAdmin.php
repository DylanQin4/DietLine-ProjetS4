<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersAdmin extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_list_user() {
        $sql = "SELECT u.id as id_users,u.username as username, u.email as email, u.poids as poids,
        u.taille as taille,u.wallet as wallet, g.genre as genre from users as u join genre as g on u.id_genre = g.id";
        $query = $this->db->query($sql); 
        return $query->result_array(); 
   }

   public function get_list($id) {
    $sql = "SELECT * FROM users where id = $id";
    $query = $this->db->query($sql); 
    return $query->result_array(); 
}

   public function deleteUser($id){
    $query = "DELETE from users where id = $id";
    $this->db->query(sprintf($query));
   }

   public function update_user($data,$id){
	$query="UPDATE users SET username = %s,email = %s,taille = %s,poids = %s WHERE id = $id";
	$query = sprintf($query,$this->db->escape($data['username']),
    $this->db->escape($data['email']),
    $this->db->escape($data['taille']),
    $this->db->escape($data['poids'])
    );
	$this->db->query($query);
}

}