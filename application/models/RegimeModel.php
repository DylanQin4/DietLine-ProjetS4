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

	public function get_all_periode_regime(){
		$this->db->from('periode_regime');
		$this->db->where('etat', 0);
		return $this->db->get()->result();
	}

	public function get_user_regime($id_user){
        $this->db->from('users');
        $this->db->where('id', $id_user);
        $result = $this->db->get()->row();
    
        return $result;
    }

	public function get_type_regime($id_type) {
		$this->db->from('regime_type');
		$this->db->where('id', $id_type);
		return $this->db->get()->row();
	}

	public function get_last_regime_ofThisUser($id_user){
		$this->db->select('*');
		$this->db->from('periode_regime');
		$this->db->where('id_user', $id_user);
		$this->db->where('etat', 1);
		$this->db->order_by('date_fin', 'desc');
		$this->db->limit(1);
		$result = $this->db->get()->row();
		return $result;
	}

	public function validation_regime($id_user, $id_periode_regime, $dateDebut, $dateFin, $montant){
            //Valider zany le regime eo @ le user sy id_periode_regime selectionner
			//D lasa le date ni-validena azy iny zany vo tena manomboka le regime
            $data = array(
                'etat' => 1,
				'date_debut' => $dateDebut,
				'date_fin' => $dateFin
            );
            $this->db->where('id', $id_periode_regime);
            $this->db->where('id_user', $id_user);
            $this->db->update('periode_regime', $data);
    }

	public function refus_regime($id_user, $id_periode_regime, $montant){
        $this->db->trans_start();
		try {
            //Refuser d atao 2 ny etat any @ zay tsy mipotra n'aiza n'aiza izy fa ao anaty table foana
			$data = array(
                'etat' => 2
            );
            $this->db->where('id', $id_periode_regime);
            $this->db->where('id_user', $id_user);
            $this->db->update('periode_regime', $data);
            
            //D lasa plus anle montant total ana regima teo ndray ny wallet any user 
            $user = $this->userModel->get_user($id_user);
            $wallet = $user->wallet;
            $new_wallet = $wallet + $montant;
            $data = array(
                'wallet' => $new_wallet
            );
            $this->db->where('id', $id_user);
            $this->db->update('users', $data);

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