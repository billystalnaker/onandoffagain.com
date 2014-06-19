<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		if($this->flexi_auth->is_logged_in()){
			redirect('home/home');
		}else{
			$this->login();
		}
	}
	public function login(){
		if($this->input->post('login_user')){
			$this->load->model('flexi_auth_model');
			$identity	 = $this->input->post('login_identity');
			$password	 = $this->input->post('login_password');
			$remember_me = $this->input->post('remember_me');
			//var_dump($this->flexi_auth->is_logged_in(), $this->flexi_auth_model->login($identity, $password, $remember_me));
			if($this->flexi_auth_model->login($identity, $password, $remember_me)){
				redirect('home/dashboard');
			}else{
				$this->data['message'] = "We're sorry, we could not log you in with those credentials.";
			}
		}
		$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		$content				 = $this->load->view('account/login', $this->data, true);
		$this->data['content']	 = $content;
		$this->load->view('tpl/structure', $this->data);
	}
	public function logout(){
		$this->flexi_auth->logout();
		redirect('account');
	}
}
