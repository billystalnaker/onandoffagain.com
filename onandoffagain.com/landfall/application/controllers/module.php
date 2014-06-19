<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Module extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function users($action = NULL, $id = NULL){
		$action	 = (!is_null($action))?$action:'view';
		$id		 = (!is_null($id))?$id:0;
		if($action === 'edit' && $id <= 0){
			$action = 'view';
		}
		if((false && !$this->flexi_auth->is_privileged('Users')) || (false && !$this->flexi_auth->is_privileged(ucfirst($action).' Users'))){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		switch($action){
			case 'add':
				break;
			case 'edit':
				break;
			case 'view':
			default:
				$this->modules->get_users();
				// Set any returned status/error messages.
				$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];

				$this->data['content'] = $this->load->view('module/user/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function view($object = '', $id = ''){
		if($id === ''){
			redirect('modules/add');
		}
		$params						 = array('id'=>$id);
		$module_info				 = $this->load->model('module')->get_info($params);
		$this->data['module_info']	 = $module_info[0];
		$this->load->config('form_validation');
		$this->load->library('form_validation', $this->config)
				->set_error_delimiters('<div class="alert alert-danger form-signin">', '</div>');
		if($this->form_validation->run() == FALSE){
			$this->data['content'] = $this->load->view('modules/view', $this->data, true);
		}else{
			$params					 = array();
			$params['id']			 = $this->input->post('module_id');
			$params['description']	 = $this->input->post('module_description');
			$params['active']		 = $this->input->post('module_active');

			$this->load->model('module')->add($params);
			redirect("modules/view/id/{$params['id']}");
			//insert module into db redirect to display page of that module
		}
		$this->load->view('tpl/structure', $this->data);
	}
}
