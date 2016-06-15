<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class user extends CI_Model{

	public function all()
	{
		return $this->db->query("SELECT * FROM users")->result_array();
	}

	function create($post)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('register_name', 'name', 'trim|required|alpha|');
		$this->form_validation->set_rules('register_alias', 'alias', 'trim|required|alpha|');
		$this->form_validation->set_rules('register_email', 'email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('register_password', 'password', 'required|min_length[8]|alpha_dash');
		$this->form_validation->set_rules('register_confirm', 'password confirmation', 'required|matches[register_password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("registration_error", validation_errors());
			redirect('/loginReg');
			exit;
		}
		else
		{
			$query = "INSERT INTO users (email, first_name, last_name, password, user_level, created_at) VALUES (?, ?, ?, ?, ?, ?)";
			$values = array($post['register_email'], $post['register_first_name'], $post['register_last_name'], $post['register_password'], "Normal", date('Y-m-d H:i:s'));
			return $this->db->query($query, $values);
		}
	}
	function login($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login_email', 'Email', 'required');
		$this->form_validation->set_rules('login_password', 'Password', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("login_error", validation_errors());
			redirect('/loginReg');
			exit;
		}
		else
		{
			$query = "SELECT * FROM users WHERE email =? AND password=?";
			$values = array($post['login_email'], $post['login_password']);
			return $this->db->query($query, $values)->row_array();
		}
	}
	function find_by($email){
		$query = "SELECT * FROM users WHERE email=?";
		$value = array($email);
		return $this->db->query($query, $value)->row_array();
	}
}