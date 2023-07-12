<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Admin extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('userModel');
		
	}

    // public function index(){
    //     $user = new UserModel();
    //     $this->userModel->is_admin(1);
    //     if (isset($_SESSION['user_id'])) {
    //         $this->userModel->is_admin($_SESSION['user_id']);
    //     } else {
    //         redirect('auth/login');
    //     }
    //     $this->load->view('admin/dashboard');
    // }

    public function index(){
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
            $this->load->view('admin/dashboard');
        } else {
            redirect('auth/login');
        }
    }

	public function get_list_user() {
		$this->load->view('admin/liste_user');
	}

    // public function dashboard(){
	// 	$this->load->view('admin/liste_user');
    // }
}