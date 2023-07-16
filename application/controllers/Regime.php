<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Regime extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url'));
        $this->load->model('PlatModel');
        $this->load->model('SportModel');
        $this->load->model('RegimeModel');
        $this->load->model('userModel');
	}

    public function index(){
        
    }

    public function cancel(){
        if (isset($_SESSION['regime_genrated'])) {
            unset($_SESSION['regime_genrated']);
        }
        redirect('');
    }

    public function details_plat($id_periode_regime, $id_regime){
        $this->load->model('regimeModel');
        $this->load->model('platModel');
        
        $data['periode_regime'] = $this->regimeModel->get_periode_regime_by_id($id_periode_regime);
        $details_aliments = $this->regimeModel->get_details_aliments($id_regime);
        $j = 0;
        foreach ($details_aliments as $plat) {
            $data['regimes']['details_aliments'][$j] = $this->platModel->get_plat_by_id($plat->id_plat);
            $data['regimes']['details_viandes'][$j] = $this->regimeModel->get_pourcentage_viande($plat->id_plat);
            $j++;
        }
        $data['regimes']['details_sportif'] = $this->regimeModel->get_details_sportif($id_regime);
        
        $this->load->view('home/details-plat', $data);
    }

    public function details($id_periode_regime){
        $this->load->model('regimeModel');
        $this->load->model('platModel');
        $data['periode_regime'] = $this->regimeModel->get_periode_regime_by_id($id_periode_regime);
        $data['id_periode_regime'] = $id_periode_regime;
        $data['id_regimes'] = $this->regimeModel->get_regimes_by_periode_regime($id_periode_regime);
        $i = 0;
        foreach ($data['id_regimes'] as $regime) {
            $details_aliments = $this->regimeModel->get_details_aliments($regime->id);
            $j = 0;
            foreach ($details_aliments as $plat) {
                $data['regimes']['details_aliments'][$i][$j] = $this->platModel->get_plat_by_id($plat->id_plat);
                $j++;
            }
            $data['regimes']['details_sportif'][$i] = $this->regimeModel->get_details_sportif($regime->id);
            $i++;
        }
        
        $this->load->view('home/details', $data);
    }

    public function insert(){
        $this->db->trans_start();

        //Operation
        $wallet = $_SESSION['wallet'] - $_SESSION['regime_generated']['sum_prix'];
        $this->db->update('users', array(
            'wallet' => $wallet
        ));
        $_SESSION['wallet'] = $wallet;

        $this->db->insert('periode_regime', array(
            'id_user' => $_SESSION['user_id'],
            'id_type' => $_SESSION['regime_generated']['type_regime'],
            'poids_objectif' => $_SESSION['regime_generated']['poids_atteindre'],
            'date_debut' => $_SESSION['regime_generated']['date_debut'],
            'date_fin' => $_SESSION['regime_generated']['date_fin'],
            'montant_total' => $_SESSION['regime_generated']['sum_prix']
        ));
        $id_periode_regime = $this->db->insert_id();
        for ($i=0; $i < count($_SESSION['regime_generated']['ids_plats']); $i++) { 
            $this->db->insert('regime', array(
                'id_periode_regime' => $id_periode_regime
            ));
            $id_regime = $this->db->insert_id();
            //insert details aliments
            for ($j=0; $j < 3; $j++) { 
                $this->db->insert('details_aliments', array(
                    'id_regime' => $id_regime,
                    'id_plat' => $_SESSION['regime_generated']['ids_plats'][$i][$j]
                ));
            }
            //insert details sports
            $this->db->insert('details_sportif', array(
                'id_regime' => $id_regime,
                'id_sport' => $_SESSION['regime_generated']['ids_sports'][$i]
            ));
        }

        // Si la transaction a echoue
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            echo "rollback";
            
        } else {
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                // En cas d'echec de la transaction
                echo "La transaction a échoué. Action de secours nécessaire.";
            } else {
                unset($_SESSION['regime_genrated']);
                redirect('');
            }
        }
    }

    public function imc(){
        $futur_imc = $this->input->post('futur_imc');
        if (is_numeric($futur_imc) && 
            filter_var($futur_imc, FILTER_VALIDATE_FLOAT) !== false && 
            $futur_imc >= 0) 
        {
            $taille = $_SESSION['taille'];
            $this->load->model('userModel');
            $my_imc = $this->userModel->calculIMC($_SESSION['user_id']);
            $type_regime = ($my_imc > $futur_imc) ? 1 : 2;
            $poids_atteindre = round($futur_imc * ($taille * $taille), 2);
        
            $data['regime_generated'] = $this->generate($type_regime, $poids_atteindre);
            $data['type_regime'] = $type_regime;
            $data['poids_atteindre'] = $poids_atteindre;
            $this->load->view("home/generate", $data);
        } else {
            $error = "Ce champ est invalide";
            $error_value = $futur_imc;
            $this->imcideal($error, $error_value);
        }
    }

    public function generated(){
        if ($this->input->post('futur_imc') != NULL) {
            $futur_imc = $this->input->post('futur_imc');
            if (!is_numeric($futur_imc) && 
            !filter_var($futur_imc, FILTER_VALIDATE_FLOAT)){
                $error = "Ce champ est invalide";
                $error_value = $futur_imc;
                $this->imcideal($error, $error_value);
            } else {
                $taille = $_SESSION['taille'];
                $this->load->model('userModel');
                $my_imc = $this->userModel->calculIMC($_SESSION['user_id']);
                $type_regime = ($my_imc > $futur_imc) ? 1 : 2;
                $poids_atteindre = round($futur_imc * ($taille * $taille), 2);
            }
        } else {
            $type_regime = (int)$this->input->post('type_regime');
            $poids_atteindre = (int)$this->input->post('poids_atteindre');
        }
        $this->load->helper('url');
        $referrerURL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $my_poids = isset($_SESSION['poids']) ? $_SESSION['poids'] : 0;
        if ($my_poids > $poids_atteindre && $type_regime == 1 ||
            $my_poids < $poids_atteindre && $type_regime == 2) {
            $data['regime_generated'] = $this->generate($type_regime, $poids_atteindre);
            $data['type_regime'] = $type_regime;
            $data['poids_atteindre'] = $poids_atteindre;
            $_SESSION['regime_generated'] = array(
                'type_regime' => $type_regime,
                'poids_atteindre' => $poids_atteindre,
                'sum_prix' => $data['regime_generated']['sum_prix'],
                'date_debut' => $data['regime_generated']['date_debut'],
                'date_fin' => $data['regime_generated']['date_fin'],
                'ids_plats' => $data['regime_generated']['ids_plats'],
                'ids_sports' => $data['regime_generated']['ids_sports']
            );
            $this->load->view("home/generate", $data);
        } else {
            $data['error'] = "Vous devez saisir un poids superieur à votre poids actuel";
            if ($type_regime == 1) {
                $data['error'] = "Vous devez saisir un poids inférieur à votre poids actuel";
                $this->load->view("home/perdre", $data);
            }
            $this->load->view("home/avoir", $data);
        }
    }

    public function perdre(){
        $this->load->view('home/perdre');
    }

    public function avoir(){
        $this->load->view('home/avoir');
    }

    public function imcideal($error = "", $error_value = ""){
        $this->load->model('IMCModel');
        $this->load->model('userModel');
        $data['type_imc'] = $this->IMCModel->getIMC();
        $data['my_imc'] = $this->userModel->calculIMC($_SESSION['user_id']);
        $data['error'] = $error;
        $data['error_value'] = $error_value;
        $this->load->view("home/imcideal", $data);
    }

    public function showCalendar($year = NULL , $month = NULL){
        $prefs = array(
            'start_day'    => 'saturday',
            'month_type'   => 'long',
            'day_type'     => 'short',
            'show_next_prev' => TRUE,
            'next_prev_url'   => base_url().'/mycal/index/'
        );
        $this->load->library('calendar',$prefs);
        echo $this->calendar->generate($year , $month);
    }

    public function select_regime_aliment($details_aliments){
        $rep = array_fill(0, count($id_type, $poids_objectif), null);
        for ($i=0; $i < count($id_type, $poids_objectif); $i++) { 
            for ($j=0; $j < 3; $j++) {

            }
        }
    }

    public function generate($id_type, $poids_objectif){
        $this->load->model('platModel');
        $this->load->model('sportModel');
        $id_type = (int)$id_type;
        $arrayIdPlats = $this->PlatModel->get_all_plat_ids_by_type($id_type);
        $nb_plat = 3;
        $arrayIdSports = $this->SportModel->get_all_sport_ids_by_type($id_type);


        $difference = abs($_SESSION['poids'] - $poids_objectif);
        $periode = ($id_type == 1)? 7 : 4; // 7jours pour perdre et 4 pour avoir 2kg de poids
        $nbJours = intval(($difference % 2 != 0) ? (($difference -1)/2)*$periode : ($difference/2)*$periode);

        $dateDebut = new DateTime();
        $dateFin = clone $dateDebut;
        $dateFin->add(new DateInterval('P' . $nbJours . 'D'));

        $periode_regime['id_type'] = $id_type;
        $periode_regime['poids_objectif'] = round($poids_objectif, 2);
        $periode_regime['date_debut'] = $dateDebut->format('Y-m-d');
        $periode_regime['date_fin'] = $dateFin->format('Y-m-d');
        $periode_regime['details_plats'] = array_fill(0, $nbJours, null);
        $periode_regime['details_sports'] = array_fill(0, $nbJours, null);
        $sum_prix = 0;

        for ($i=0; $i < $nbJours; $i++) { 
            $platJournee = array();
            
            while (count($platJournee) < $nb_plat) {
                $id_plat = $arrayIdPlats[array_rand($arrayIdPlats)];
    
                if (!in_array($id_plat, $platJournee)) {
                    $platJournee[] = $id_plat;
                }
            }

            $random_id_sport = $arrayIdSports[array_rand($arrayIdSports)];
            $periode_regime['ids_sports'][$i] = $random_id_sport;
            $periode_regime['ids_plats'][$i] = $platJournee;
            list($periode_regime['details_plats'][$i], $sum_prix) = $this->getDetailsPlats($platJournee, $sum_prix);
            $periode_regime['details_sports'][$i] = $this->sportModel->get_name_sport_by_id($random_id_sport);
        }
        $periode_regime['sum_prix'] = $sum_prix;

        return $periode_regime;
    }

    private function getDetailsPlats($ids_plats, $sum_prix){
        $this->load->model('platModel');
        for ($i=0; $i < count($ids_plats); $i++) { 
            $rep[$i] = $this->platModel->get_plat_with_pourcentage_viande($ids_plats[$i]);
            $sum_prix = $sum_prix + $rep[$i]['prix'];
        }
        return array($rep, $sum_prix);
    }

    public function regime_user(){
        $regime_attente = $this->RegimeModel->get_all_periode_regime();
        $count_regimeEnAttente = count($regime_attente);
        if ($count_regimeEnAttente == 0) {
            $this->load->view('admin/null_validation');
        } else{
            foreach ($regime_attente as $regime) {
                $data['attente'][] = $regime;
                $data['username'][] = $this->RegimeModel->get_user_regime($regime->id_user);
                $type = $this->RegimeModel->get_type_regime($regime->id_type);
                $data['type'][] = $type->type;
            }
            $this->load->view('admin/validation_regime', $data);
        }
    }

    public function validation_regime(){
        if (isset($_GET['id_user']) && isset($_GET['id_periode_regime']) && 
                isset($_GET['date_debut']) && isset($_GET['date_fin']) && isset($_GET['montant'])) {
            $id_user = $_GET['id_user'];
            $id_periode_regime = $_GET['id_periode_regime'];
            $date_debut = new DateTime($_GET['date_debut']);
            $date_fin = new DateTime($_GET['date_fin']);
            $montant = $_GET['montant'];

            $diff = $date_fin->diff($date_debut);
            $nbJours = $diff->days;
            $last_regime_ofThisUser = $this->RegimeModel->get_last_regime_ofThisUser($id_user);

            if ($last_regime_ofThisUser != null) {
                $dateDebut = clone new DateTime($last_regime_ofThisUser->date_fin);
                $dateDebut->add(new DateInterval('P' . 1 . 'D'));
            } else{
                $dateDebut = new DateTime();
            }
            
            $dateFin = clone $dateDebut;
            $dateFin->add(new DateInterval('P' . $nbJours . 'D'));
            $dateDebut = $dateDebut->format('Y-m-d');
            $dateFin = $dateFin->format('Y-m-d');

            $this->RegimeModel->validation_regime($id_user, $id_periode_regime, $dateDebut, $dateFin, $montant);
        
        }
        $this->regime_user();
    }

    public function refus_regime(){
        if (isset($_GET['id_user']) && isset($_GET['id_periode_regime']) && isset($_GET['montant'])) {
            $id_user = $_GET['id_user'];
            $id_periode_regime = $_GET['id_periode_regime'];
            $montant = $_GET['montant'];
            $this->RegimeModel->refus_regime($id_user, $id_periode_regime, $montant);
        }
        $this->regime_user();
    }
}