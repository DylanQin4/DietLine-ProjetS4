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

    public function perdre(){
        $this->load->view('home/perdre');
    }

    public function avoir(){
        $this->load->view('home/avoir');
    }

    public function imcideal(){
        $this->load->model('IMCModel');
        $this->load->model('userModel');
        $data['type_imc'] = $this->IMCModel->getIMC();
        $data['my_imc'] = $this->userModel->calculIMC($_SESSION['user_id']);
        $this->load->view('home/imcideal', $data);
    }

    public function showCalendar($year = NULL , $month = NULL)
    {
     $prefs = array(
           'start_day'    => 'saturday',
           'month_type'   => 'long',
           'day_type'     => 'short',
           'show_next_prev' => TRUE,
           'next_prev_url'   => base_url().'/mycal/index/'
     );
     $this->load->library('calendar',$prefs); // Load calender library
     echo $this->calendar->generate($year , $month);
    }

    public function generate($id_type, $poids_objectif){
        $id_type = (int)$id_type;
        $arrayIdPlats = $this->PlatModel->get_all_plat_ids_by_type($id_type);
        $nb_plat = 3;
        $arrayIdSports = $this->SportModel->get_all_sport_ids_by_type($id_type);

        $difference = abs($_SESSION['poids'] - $poids_objectif);
        $periode = 7; // 7jours pour perdre ou avoir 2kg de poids
        $nbJours = intval(($difference % 2 != 0) ? ($difference -1)*$periode : $difference*$periode);

        $dateDebut = new DateTime();
        $dateFin = clone $dateDebut;
        $dateFin->add(new DateInterval('P' . $nbJours . 'D'));

        $periode_regime['id_user'] = $_SESSION['user_id'];
        $periode_regime['id_type'] = $id_type;
        $periode_regime['poids_objectif'] = $poids_objectif;
        $periode_regime['date_debut'] = $dateDebut->format('Y-m-d');
        $periode_regime['date_fin'] = $dateFin->format('Y-m-d');
        $periode_regime['details_aliments'] = array_fill(0, $nbJours, null);
        $periode_regime['details_sports'] = array_fill(0, $nbJours, null);

        for ($i=0; $i < $nbJours; $i++) { 
            $platJournee = array(); //tableau avec 3 éléments null
            
            while (count($platJournee) < $nb_plat) {
                $id_plat = array_rand($arrayIdPlats);
    
                if (!in_array($id_plat, $platJournee)) {
                    $platJournee[] = $id_plat;
                }
            }

            $periode_regime['details_aliments'][$i] = $platJournee;
            $periode_regime['details_sports'][$i] = array_rand($arrayIdSports);
        }

        echo json_encode($periode_regime);
    }

}