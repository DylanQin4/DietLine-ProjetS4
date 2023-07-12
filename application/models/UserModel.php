<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

	public function calculIMC($id){
		$user = $this->get_user($id);
		if ($user->taille == 0) {
			return 0;
		}
		return $user->poids/($user->taille*$user->taille);
	}
	
	public function create_user($username, $email, $id_genre, $password, $taille, $poids) {
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'id_genre' => $id_genre,
			'password'   => $password,
			'taille' => $taille,
			'poids' => $poids,
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('users', $data);
	}

	public function update_user($form_data, $id_user){
		$data = array(
			'username' => $form_data['nom'],
			'email' => $form_data['email'],
			'taille' => $form_data['taille'],
			'poids' => $form_data['poids']
		);
		$this->db->where('id', $id_user);
		$this->db->update('users', $data);
	}

	public function insert_histo_morphology($poids, $user_id){
		$data = array(
			'id_user' => $user_id,
			'poids' => $poids,
			'updated_at' => date('Y-m-j H:i:s')
		);
		$this->db->insert('histo_morphology', $data);
	}
	
	public function resolve_user_login($email, $password) {
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$id = $this->db->get()->row('id');
		if (!empty($id)) {
			return true;
		}
		return false;
	}

	public function get_user_id_from_email($email) {
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email', $email);

		return $this->db->get()->row('id');
		
	}
	
	public function get_user($user_id) {
		$this->db->from('users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
	}

	public function get_genre($id_genre) {
		$this->db->from('genre');
		$this->db->where('id', $id_genre);
		return $this->db->get()->row();
	}
	
	private function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}
	
	private function verify_password_hash($password, $hash) {
		return password_verify($password, $hash);
	}

	public function is_admin($id){
		$this->db->from('users');
		$this->db->where('id', $id);
		$user = $this->db->get()->row();
		if ($user->is_admin == 1) {
			return true;
		}
		return false;
	}
	
}
