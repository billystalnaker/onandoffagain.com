<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->login();
	}
	public function login(){
		$content				 = $this->load->view('account/login', array(), true);
		$this->data['content']	 = $content;
		if($this->input->post('login_user')){
			$this->load->model('flexi_auth_model');
			$this->flexi_auth_model->login($this->input->post('login_identity'), $this->input->post('login_password'), $this->input->post('remember_me'));
		}
		$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];

		$this->load->view('tpl/structure', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
