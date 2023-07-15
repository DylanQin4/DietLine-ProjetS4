<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class User extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('userModel');
        $this->load->model('UsersAdmin');
		$this->load->model('codeModel');
		
	}

    public function profil(){
        $this->load->view('home/profil');
    }

    public function histo_morphology($user_id, $poids){
		$user = $this->userModel->get_user($user_id);
        if ((float)$user->poids != $poids) {
            $this->userModel->insert_histo_morphology((float)$user->poids, $user_id);
        }
    }

    public function update_profil(){
		$form_data = $this->input->post();
        $user_id = $_SESSION['user_id'];

        $this->histo_morphology($user_id, $poids);

        $this->userModel->update_user($form_data, $user_id);
		$user    = $this->userModel->get_user($user_id);
        // set session user datas
        $_SESSION['username']     = (string)$user->username;
        $_SESSION['email']        = (string)$user->email;
        $_SESSION['avatar']       = (string)$user->avatar;
        $_SESSION['logged_in']    = (bool)true;
        $_SESSION['poids']        = (float)$user->poids;
        $_SESSION['taille']       = (float)$user->taille;
        $this->load->view('home/profil');
    }

    public function updatePoids(){
        $poids = $this->input->post('poids');
        $user_id = $_SESSION['user_id'];

        $this->histo_morphology($user_id, $poids);
        $this->userModel->evolution_poids($poids, $user_id);
		$user    = $this->userModel->get_user($user_id);

        $_SESSION['poids']        = (float)$user->poids;
        $this->load->view('home/accueil');
    }

    private function insertCodesIntoData(){
        $codes = $this->codeModel->get_code();
        foreach ($codes as $code) {
            $data['code'][] = $code->codes;
            $data['status'][] = $this->getStatus($code);
            $valeur = $this->codeModel->get_valeur($code->id_valeur);
            $data['valeur'][] = $valeur->valeur;
        }
        return $data;
    }

    private function getStatus($code){
        if ($this->codeModel->correspondant_code($code->codes)->is_valide == 1 && !$this->codeModel->attente_validation($code->id, $_SESSION['user_id'])) {
            return 1;//valide
        } elseif($this->codeModel->correspondant_code($code->codes)->is_valide == 1 && $this->codeModel->attente_validation($code->id, $_SESSION['user_id'])) {
            return 2;//en attente
        } else {
            return 0;//non valide
        }
        
    }

    public function wallet(){
        $data['list_codes'] = $this->insertCodesIntoData();
        $this->load->view('home/wallet', $data);
    }

    public function validation_user(){
		$code = $this->input->post('code');
        $code = trim($code);
        if ($this->codeModel->getCountRow($code) == 0) {
            $data['error'] = "Le code saisi n'existe pas";
            $data['value'] = $code;
        } else {
            $id_code = $this->codeModel->correspondant_code($code)->id;
            if ($this->codeModel->correspondant_code($code)->is_valide == 0) {
                $data['error'] = "Le code saisi n'est plus valide";
            } elseif ($this->codeModel->attente_validation($id_code, $_SESSION['user_id'])) {
                $data['error'] = "Le code saisi est deja en attente de validation";
            } else {
                $this->codeModel->insert_validation_code($id_code, (int)$_SESSION['user_id']);
            }
        }
        $data['list_codes'] = $this->insertCodesIntoData();
        
        $this->load->view('home/wallet', $data);
    }

    //--------------ADMIN--------------------
    public function wallet_user(){
        $wallet_user = $this->codeModel->code_en_attente();
        $count_walletEnAttente = count($wallet_user);
        if ($count_walletEnAttente == 0) {
            $this->load->view('admin/null_validation');
        } else{
            foreach ($wallet_user as $wallet) {
                $data['attente'][] = $wallet;
                $data['username'][] = $this->codeModel->get_user_wallet($wallet->id_user);
                $valeur = $this->codeModel->get_valeur($wallet->id_valeur);
                $data['valeur'][] = $valeur->valeur;
            }
            $this->load->view('admin/validation_wallet', $data);
        }
        
    }

    public function validation_admin(){
        $wallet_user = $this->codeModel->code_en_attente();
        if (isset($_GET['id_user'])) {
            $id_user = $_GET['id_user'];
        }
        if (isset($_GET['id_code'])) {
            $id_code = $_GET['id_code'];
        }
        if (isset($_GET['valeur'])) {
            $valeur = $_GET['valeur'];
        }
        $this->codeModel->transaction_validation($id_user, $id_code, $valeur);
        $this->wallet_user();
    }

    public function refus_admin(){
        if (isset($_GET['indice_valid_code'])) {
            $indice_valid_code = $_GET['indice_valid_code'];
            $this->codeModel->delete_validation_code($indice_valid_code);
        }
        $this->wallet_user();
    }

    public function list_user(){
        $data['data'] = $this->UsersAdmin->get_list_user();
        $this->load->view('admin/utilisateur/liste',$data);
    }

	public function delete_user(){
		$id = $_GET['id'];
		$this->UsersAdmin->deleteUser($id);
		redirect('User/list_user');
    }

	public function updateUser(){
		$id = $_GET['id'];
		$data['data'] = $this->UsersAdmin->get_list($id);
		$this->load->view('admin/utilisateur/update',$data);
	}

	public function traitement_update(){
		$id = $_GET['id'];
        // var_dump($id);

		// $a = $this->input->post('username');
		// $b = $this->input->post('email');
		// $c = $this->input->post('taille');
		// $d = $this->input->post('poids');
		// var_dump($id,$a,$b,$c,$d);
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'taille' => $this->input->post('taille'),
			'poids' => $this->input->post('poids')
	);


	$this->UsersAdmin->update_user($data,$id);
	redirect('User/list_user');
	}

    public function regime_user(){
        $this->load->view('admin/validation_regime');
    }
}
?>