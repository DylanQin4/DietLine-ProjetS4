<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aliment extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		// $this->load->library(array('session'));
		// $this->load->helper(array('url'));
		$this->load->model('AlimentAdmin');
		
	}

    public function get_aliment(){
        $data['data'] = $this->AlimentAdmin->get_list();
        $this->load->view('admin/Aliment/liste',$data);
    }

    public function Ajout_Aliment(){
        $data['data'] = $this->AlimentAdmin->get_type_plat();
        $data['d'] = $this->AlimentAdmin->get_type_regime();
        $this->load->view('admin/Aliment/ajout',$data);
    }

    public function traitement_ajout(){
        $t = array(
            $this->input->post('viande'),
            $this->input->post('poisson'),
            $this->input->post('volaille')
        );
        
        $total = array_sum($t);
        if ($total <= 100) {
            $data = array(
                'nom' => $this->input->post('nom'),
                'ingredients' => $this->input->post('ingredients'),
                'prix' => $this->input->post('prix'),
                'id_type_regime' => $this->input->post('type')
            );
            $id = $this->AlimentAdmin->ajout_aliment($data); 
            for ($i = 0; $i < count($t); $i++) {
                $datas = array(
                    'id_plat' => $id,
                    'id_viande' => $i + 1,
                    'poucentage' => $t[$i]
                );
                $this->AlimentAdmin->ajout_pourcentage($datas);
            }

        redirect('Aliment/get_aliment');
        }else {
            redirect('Aliment/update');
        }
    }

    public function delete(){
		$id = $_GET['id'];
		$this->AlimentAdmin->delete_Aliment($id);
		redirect('Aliment/get_aliment');
   }

   public function composent(){
    $id = $_GET['id'];
    $data['data'] = $this->AlimentAdmin->get_compose($id);
    $this->load->view('admin/Aliment/composent',$data);
}

    public function update(){
        $id = $_GET['id'];
        $data['data'] = $this->AlimentAdmin->get_type_plat();
        $data['d'] = $this->AlimentAdmin->get_type_regime();
        $data['da'] = $this->AlimentAdmin->liste($id);
        $this->load->view('admin/Aliment/update',$data);
    }

    public function traitement_update(){
        $id = $_GET['id'];
        $data = array(
            'nom' => $this->input->post('nom'),
            'ingredients' => $this->input->post('ingredients'),
            'prix' => $this->input->post('prix'),
            'plat' => $this->input->post('plat'),
            'regime' => $this->input->post('regime')
        );
        $this->AlimentAdmin->updateAliment($data,$id);
        redirect('Aliment/get_aliment');
    }

}
