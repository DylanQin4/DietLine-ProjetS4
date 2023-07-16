<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

class Auth extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('userModel');
		$this->load->model('genreModel');
		$this->load->model('regimeModel');
	}
	
	
	public function index() {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['is_admin'] == false) {
			$data['regime_en_attente'] = $this->regimeModel->get_periode_regime($_SESSION['user_id'], 0);
			$data['regime_en_cours'] = $this->regimeModel->get_periode_regime($_SESSION['user_id'], 1);

			$this->load->view('home/accueil', $data);
		} else if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['is_admin'] == true){
			redirect('admin');
		} else {
			redirect('auth/login');
		}
	}

	public function register() {
		$data = array();
		$data['genres'] = $this->genreModel->getAll();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// validation rules
		$this->form_validation->set_rules('username', 'Nom', 'trim|required|alpha_numeric|min_length[3]|is_unique[users.username]', array('is_unique' => 'Cet identifiant existe déjà. Veuillez en choisir un autre.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('genre', 'Genre', 'trim|required|numeric');
		$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('password_confirm', 'Confirmation Mot de passe', 'trim|required|min_length[5]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			// validation not ok
			$this->load->view('auth/register', $data);
			
		} else {
			
			// set variables from the form
			$_SESSION['username'] = $this->input->post('username');
			$_SESSION['email']    = $this->input->post('email');
			$_SESSION['genre']    = $this->input->post('genre');
			$_SESSION['password'] = $this->input->post('password');
			
			$this->load->view('auth/register2');
			
		}
		
	}
	public function register2() {
		$data = array();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// validation rules
		$this->form_validation->set_rules('taille', 'Taille', 'trim|required|numeric|greater_than_equal_to[0]|less_than_equal_to[3]', array('is_unique' => 'Cet identifiant existe déjà. Veuillez en choisir un autre.'));
		$this->form_validation->set_rules('poids', 'Poids', 'trim|required|numeric|greater_than_equal_to[0]|less_than_equal_to[300]');
		
		if ($this->form_validation->run() === false) {
			// validation not ok
			$this->load->view('auth/register2', $data);
			
		} else {
			
			// set variables from the form
			$username = $_SESSION['username'];
			$email = $_SESSION['email'];
			$id_genre = $_SESSION['genre'];
			$password = $_SESSION['password'];
			$taille = $this->input->post('taille');
			$poids    = $this->input->post('poids');

			
			if ($this->userModel->create_user($username, $email, $id_genre, $password, $taille, $poids)) {
				unset($_SESSION['username']);
				unset($_SESSION['email']);
				unset($_SESSION['genre']);
				unset($_SESSION['password']);
				// user creation ok
				$this->load->view('auth/login', $data);
				
			} else {
				// user creation failed
				$data->error = 'Un problème est survenu lors de la création de votre nouveau compte. Veuillez réessayer.';
				
				// send error to the view
				$this->load->view('auth/register2', $data);
				
			}
			
		}
		
	}
		
	public function login() {
		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required');
		
		if ($this->form_validation->run() == false) {
			// validation not ok
			$this->load->view('auth/login');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->userModel->resolve_user_login($email, $password)) {
				
				$user_id = $this->userModel->get_user_id_from_email($email);
				$user    = $this->userModel->get_user($user_id);
				$id_genre= (int)$user->id_genre;
				$genre   = $this->userModel->get_genre($id_genre);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['email']        = (string)$user->email;
				$_SESSION['avatar']       = (string)$user->avatar;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				$_SESSION['poids']        = (float)$user->poids;
				$_SESSION['taille']       = (float)$user->taille;
				$_SESSION['wallet']       = (float)$user->wallet;
				$_SESSION['genre']        = (string)$genre->genre;

				if ($_SESSION['is_admin']) {
					redirect('/admin');
				} else {
					redirect('/');
				}
				
			} else {
				// login failed
				$data->error = 'Nom d\'utilisateur ou mot de passe incorrecte.';
				
				// send error to the view
				$this->load->view('auth/login', $data);
				
			}
			
		}
		
	}

	public function logout() {
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$this->deleteSession();
			redirect('/');
		} else {
			redirect('/');
		}
		
	}

	private function deleteSession(){
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
		}
	}
	
}
