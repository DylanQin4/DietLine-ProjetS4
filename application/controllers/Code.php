<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		// $this->load->library(array('session'));
		// $this->load->helper(array('url'));
		$this->load->model('codeModel');
		
	}

    private function insertCodesIntoData(){
        $codes = $this->codeModel->get_code();
        foreach ($codes as $code) {
            $data['id_code'][] = $code->id;
            $data['code'][] = $code->codes;
            $data['status'][] = $this->getStatus($code);
            $valeur = $this->codeModel->get_valeur($code->id_valeur);
            $data['valeur'][] = $valeur->valeur;
        }
        return $data;
    }

    private function getStatus($code){
        $id_code = $this->codeModel->get_idCode_by_correspondantCode($this->codeModel->correspondant_code($code->codes)->id);
        if ($this->codeModel->correspondant_code($code->codes)->is_valide == 1 && !$this->codeModel->get_code_enAttente($id_code)) {
            return 1;//valide
        } elseif($this->codeModel->correspondant_code($code->codes)->is_valide == 1 && $this->codeModel->get_code_enAttente($id_code)) {
            return 2;//en attente
        } else {
            return 0;//non valide
        }
        
    }

    public function get_all(){
        $data['list_codes'] = $this->insertCodesIntoData();
        $this->load->view('admin/code/codes', $data);
    }

    public function delete_code(){
        if (isset($_GET['id'])) {
            $id_code = $_GET['id'];
            $this->codeModel->deleteCode($id_code);
        }
        $this->get_all();
    }

    // public function update_user(){
	// 	$valeur = $this->input->post('valeur');
    //     $id_valeur = $this->userModel->get_idValeur_by_valeur($valeur)->id;

    //     $this->userModel->updateCode($form_data, $user_id);
    // }

    public function generer_code(){
        $code_genere = $this->codeModel->generate_code();
        echo $code_genere;
        $_SESSION['code_genere'] = $code_genere;
    }
}
?>