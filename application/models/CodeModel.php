<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeModel extends CI_Model {
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('userModel');
		
	}

    public function get_valeur($valeur_id) {
		$this->db->from('valeur');
		$this->db->where('id', $valeur_id);
		return $this->db->get()->row();
	}

    public function get_code() {
		$query = $this->db->get('codes');
        return $query->result();
	}

    public function get_idCode_by_correspondantCode($id_code){
        $this->db->from('validation_codes');
        $this->db->where('id_code', $id_code);
        $result = $this->db->get()->row();
    
        return $result;
    }

    public function get_code_enAttente($id_code) {
        $query = $this->db->get('validation_codes');
        $results = $query->result();
		foreach ($results as $row) {
            if ($id_code == $row->id_code) {
                return true;
            }
        }
        return false;
	}

    public function attente_validation($id_code, $user_id){
		$query = $this->db->get('validation_codes');
        $results = $query->result(); 

        foreach ($results as $row) {
            if ($row->id_code == $id_code && $row->id_user == $user_id) {
                return true;
            }
        }
        return false;
    }

    public function correspondant_code($code) {
        $this->db->from('codes');
        $this->db->where('codes', $code);
        $result = $this->db->get()->row();
    
        return $result;
    }    

    public function getCountRow($code) {
        $this->db->from('codes');
        $this->db->where('codes', $code);
        $result = $this->db->get()->num_rows();
    
        return $result;
    }  
    
    public function get_id_by_codes($codes){
        $this->db->select('id');
        $this->db->from('codes');
        $this->db->where('codes', $codes);
        return $this->db->get()->row();
    }

    public function insert_validation_code($id_code, $id_user){
        $data = array(
			'id_code'   => $id_code,
			'id_user'   => $id_user
		);
		
		return $this->db->insert('validation_codes', $data);
    }

    //---------ADMIN
    public function code_en_attente(){
        $query = $this->db->select('validation_codes.id as id_val, validation_codes.*, codes.*')
                  ->from('validation_codes')
                  ->join('codes', 'validation_codes.id_code = codes.id')
                  ->where('validation_codes.is_valide', 0)
                  ->where('codes.is_valide', 1)
                  ->get();

        $results = $query->result();
        return $results;
    }

    public function get_refus_code(){
		$query = $this->db->get('refus_codes');
        $result = $query->result();
        $rep = array();
        foreach($result as $row){
            $rep[] = $row->id_validation_codes;
        }
        return $rep;
    }

    public function get_user_wallet($id_user){
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $result = $this->db->get()->row();
    
        return $result;
    }

    public function transaction_validation($id_user, $id_code, $valeur){
        $this->db->trans_start(); // Début de la transaction
        try {
            // Étape 1 : Effectuer les opérations nécessaires
            //Valider zany le depot anle user selectionner
            $data = array(
                'is_valide' => 1
            );
            $this->db->where('id_user', $id_user);
            $this->db->where('id_code', $id_code);
            $this->db->update('validation_codes', $data);
            
            //D lasa tsy valide tsony zany iny code efa novalideny iny
            $data = array(
                'is_valide' => 0
            );
            $this->db->where('id', $id_code);
            $this->db->update('codes', $data);

            $user = $this->userModel->get_user($id_user);
            $wallet = $user->wallet;
            $new_wallet = $wallet + $valeur;
            $data = array(
                'wallet' => $new_wallet
            );
            $this->db->where('id', $id_user);
            $this->db->update('users', $data);

            $users = $this->userModel->get_user($id_user);
			$_SESSION['wallet'] = $users->wallet;

            // Étape 2 : Vérifier si tout s'est bien passé
            $transaction_status = $this->db->trans_status();
            
            if ($transaction_status === FALSE) {
                $this->db->trans_rollback(); // Annuler la transaction
                return false;
            } else {
                $this->db->trans_commit(); // Valider la transaction
                return true;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback(); // Annuler la transaction en cas d'erreur
            return false;
        }
    }

    public function delete_validation_code($indice_valid_code){
        $this->db->where('id', $indice_valid_code);
        $this->db->delete('validation_codes');
    }

    public function deleteCode($id_code){
            $this->db->where('id', $id_code);
            $this->db->delete('codes');
    }

    public function get_idValeur_by_valeur($valeur) {
        $this->db->from('valeur');
        $this->db->where('valeur', $valeur);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
        
    }   

    // public function updateCode($id_valeur, $id_code){
	// 	$data = array(
	// 		'id_valeur' => $id_valeur
	// 	);
	// 	$this->db->where('id', $id_code);
	// 	$this->db->update('codes', $data);
	// }

    // public function generate_code(){
    //     $code = '';
    //     $chiffres = '0123456789';
    //     $longueur = 10;
        
    //     for ($i = 0; $i < $longueur; $i++) {
    //         $index = rand(0, strlen($chiffres) - 1);
    //         $code .= $chiffres[$index];
    //     }
        
    //     return $code;
    // }

    public function add_code($code, $id_valeur){
        $data = array(
            'codes'   => $code,
            'id_valeur'   => $id_valeur
        );
        
        return $this->db->insert('codes', $data);
    }

    public function transaction_valeur_code($code, $valeur){
        $this->db->trans_start(); // Début de la transaction
        try {
            //Ra mbola tsisy le valeur ampidiriny d mampiditra anaty table valeur aloha
            $data = array(
                'valeur' => $valeur
            );
            $this->db->insert('valeur', $data);
            
            // Récupérer l'ID de la dernière ligne insérée
            $dernier_id = $this->db->insert_id();
            
            //D zay vo maka anle farany no-inserena apidirina anaty table code
            $this->add_code($code, $dernier_id);

            // Étape 2 : Vérifier si tout s'est bien passé
            $transaction_status = $this->db->trans_status();
            
            if ($transaction_status === FALSE) {
                $this->db->trans_rollback(); // Annuler la transaction
                return false;
            } else {
                $this->db->trans_commit(); // Valider la transaction
                return true;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback(); // Annuler la transaction en cas d'erreur
            return false;
        }
    }
}
?>