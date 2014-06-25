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
			//set flashdata sayign you must have id in order to edit
			redirect('module/users/view');
		}
		if((false && !$this->flexi_auth->is_privileged('Users')) || (false && !$this->flexi_auth->is_privileged(ucfirst($action).' Users'))){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');

		$filters			 = array('ugrp_id !='=>1);
		$groups				 = $this->flexi_auth->get_groups(FALSE, $filters)->result_array();
		$group_options		 = array();
		$group_options['']	 = 'Please Select...';
		foreach($groups as $group){
			$group_options[$group['ugrp_id']] = $group['ugrp_name'];
		}
		$this->data['group_options'] = $group_options;
		switch($action){
			case 'add':
				$this->modules->insert_user();
				$this->data['content']	 = $this->load->view('module/user/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_user($id);
				$this->data['content']	 = $this->load->view('module/user/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_users();
				// Set any returned status/error messages.
				$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];

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
