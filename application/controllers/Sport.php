<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sport extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->model('SportAdmin');
		
	}

    public function get_all(){
        $data['data'] = $this->SportAdmin->get_list_sport();
        $this->load->view('admin/sport/liste',$data);
    }

    public function delete(){
        $id = $_GET['id'];
		$this->SportAdmin->deleteSport($id);
		redirect('Sport/get_all');
    }

    public function Ajout_Sport(){
        $data['data'] = $this->SportAdmin->get_type();
        $this->load->view('admin/Sport/ajout',$data);
    }

    public function traitement_ajout(){

        $data = array(
            'nom' => $this->input->post('nom'),
            'type' =>$this->input->post('type')
        );
        $this->SportAdmin->ajout_sport($data);
        redirect('Sport/get_all');
    }

    public function update(){
        $id = $_GET['id'];
        $data['data'] = $this->SportAdmin->get_type();
        $data['da'] = $this->SportAdmin->get_sport($id);
        $this->load->view('admin/Sport/update',$data);
    }

    public function traitement_update(){
        $id = $_GET['id'];
        $data = array(
            'nom' => $this->input->post('nom'),
            'type' =>$this->input->post('type')
        );
        $this->SportAdmin->update_sport($data,$id);
        redirect('Sport/get_all');
    }

}