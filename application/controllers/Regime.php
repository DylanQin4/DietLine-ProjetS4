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
	}

    public function index(){
        
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
        $this->load->helper('url');
        $referrerURL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $type_regime = (int)$this->input->post('type_regime');
        $my_poids = isset($_SESSION['poids']) ? $_SESSION['poids'] : 0;
        $poids_atteindre = (int)$this->input->post('poids_atteindre');
        
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
}