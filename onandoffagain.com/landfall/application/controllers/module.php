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
		if(!$this->flexi_auth->is_privileged('Users') || !$this->flexi_auth->is_privileged(ucfirst($action).' Users')){
			//set flashdata saying you dont have access to this
			if(USER_ID !== $id){
				redirect('home/dashboard');
			}
		}
		$this->load->model('modules');
		$groups				 = $this->modules->get_groups(true);
		$group_options		 = array();
		$group_options['']	 = 'Please Select...';
		foreach($groups as $group){
			$group_options[$group['ugrp_id']] = $group['ugrp_name'];
		}
		$this->data['group_options'] = $group_options;
		$this->data['message']		 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		switch($action){
			case 'add':
				$this->modules->insert_user();
				$this->data['content']	 = $this->load->view('module/user/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_user($id);
				$this->modules->update_user_account($id);
				$this->data['content']	 = $this->load->view('module/user/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_users();
				$this->modules->update_users();
				// Set any returned status/error messages.

				$this->data['content'] = $this->load->view('module/user/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function groups($action = NULL, $id = NULL){
		$action	 = (!is_null($action))?$action:'view';
		$id		 = (!is_null($id))?$id:0;
		if($action === 'edit' && $id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/groups/view');
		}
		if(!$this->flexi_auth->is_privileged('Groups') || !$this->flexi_auth->is_privileged(ucfirst($action).' Groups')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		switch($action){
			case 'add':
				$this->modules->insert_group();
				$this->data['content']	 = $this->load->view('module/group/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_group($id);
				$this->modules->update_group($id);
				$this->data['content']	 = $this->load->view('module/group/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_groups();
				$this->modules->update_groups();
				// Set any returned status/error messages.

				$this->data['content'] = $this->load->view('module/group/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function privileges($action = NULL, $id = NULL){
		$action	 = (!is_null($action))?$action:'view';
		$id		 = (!is_null($id))?$id:0;
		if($action === 'edit' && $id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/privileges/view');
		}
		if(!$this->flexi_auth->is_privileged('Privileges') || !$this->flexi_auth->is_privileged(ucfirst($action).' Privileges')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		switch($action){
			case 'add':
				$this->modules->insert_privilege();
				$this->data['content']	 = $this->load->view('module/privilege/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_privilege($id);
				$this->modules->update_privilege($id);
				$this->data['content']	 = $this->load->view('module/privilege/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_privileges();
				$this->modules->update_privileges();
				// Set any returned status/error messages.

				$this->data['content'] = $this->load->view('module/privilege/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function st_lights($action = NULL, $id = NULL){
		$action	 = (!is_null($action))?$action:'view';
		$id		 = (!is_null($id))?$id:0;
		if($action === 'edit' && $id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/st_lights/view');
		}
		if(!$this->flexi_auth->is_privileged('St Lights') || !$this->flexi_auth->is_privileged(ucfirst($action).' St Lights')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$defects			 = $this->db->get('defect')->result_array();
		$defect_options		 = array();
		$defect_options['']	 = 'Please Select...';
		foreach($defects as $defect){
			$defect_options[$defect['id']] = $defect['name'];
		}
		$this->data['defect_options']	 = $defect_options;
		$this->data['message']			 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		switch($action){
			case 'add':
				$this->modules->insert_st_light();
				$this->data['content']	 = $this->load->view('module/st_light/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_st_light($id);
				$this->modules->update_st_light($id);
				$this->data['content']	 = $this->load->view('module/st_light/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_st_lights();
				$this->modules->update_st_lights();
				// Set any returned status/error messages.

				$this->data['content'] = $this->load->view('module/st_light/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function defects($action = NULL, $id = NULL){
		$action	 = (!is_null($action))?$action:'view';
		$id		 = (!is_null($id))?$id:0;
		if($action === 'edit' && $id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/defects/view');
		}
		if(!$this->flexi_auth->is_privileged('Defects') || !$this->flexi_auth->is_privileged(ucfirst($action).' Defects')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$defect_types			 = $this->db->get('defect_type')->result_array();
		$defect_type_options	 = array();
		$defect_type_options[''] = 'Please Select...';
		foreach($defect_types as $defect_type){
			$defect_type_options[$defect_type['id']] = $defect_type['name'];
		}
		$this->data['defect_types']	 = $defect_type_options;
		$this->load->model('modules');
		$this->data['message']		 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		switch($action){
			case 'add':
				$this->modules->insert_defect();
				$this->data['content']	 = $this->load->view('module/defect/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_defect($id);
				$this->modules->update_defect($id);
				$this->data['content']	 = $this->load->view('module/defect/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_defects();
				$this->modules->update_defects();
				// Set any returned status/error messages.

				$this->data['content'] = $this->load->view('module/defect/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function defect_types($action = NULL, $id = NULL){
		$action	 = (!is_null($action))?$action:'view';
		$id		 = (!is_null($id))?$id:0;
		if($action === 'edit' && $id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/defect_types/view');
		}
		if(!$this->flexi_auth->is_privileged('Defect Types') || !$this->flexi_auth->is_privileged(ucfirst($action).' Defect Types')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		switch($action){
			case 'add':
				$this->modules->insert_defect_type();
				$this->data['content']	 = $this->load->view('module/defect_type/add', $this->data, true);
				break;
			case 'edit':
				$this->modules->get_defect_types($id);
				$this->modules->update_defect_types($id);
				$this->data['content']	 = $this->load->view('module/defect_type/edit', $this->data, true);
				break;
			case 'view':
			default:
				$this->modules->get_defect_types();
				$this->modules->update_defects();
				// Set any returned status/error messages.

				$this->data['content'] = $this->load->view('module/defect_type/view', $this->data, true);
				break;
		}
		$this->load->view('tpl/structure', $this->data);
	}
	public function user_privileges($id = NULL){
		$id = (!is_null($id))?$id:0;
		if($id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/users/view');
		}
		if(!$this->flexi_auth->is_privileged('User Privileges')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		$this->modules->update_user_privileges($id);
		$this->data['content']	 = $this->load->view('module/user_privilege/edit', $this->data, true);

		$this->load->view('tpl/structure', $this->data);
	}
	public function group_privileges($id = NULL){
		$id = (!is_null($id))?$id:0;
		if($id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/groups/view');
		}
		if(!$this->flexi_auth->is_privileged('Group Privileges')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		$this->modules->update_group_privileges($id);
		$this->data['content']	 = $this->load->view('module/group_privilege/edit', $this->data, true);

		$this->load->view('tpl/structure', $this->data);
	}
	public function st_light_defects($id = NULL){
		$id = (!is_null($id))?$id:0;
		if($id <= 0){
			//set flashdata sayign you must have id in order to edit
			redirect('module/st_lights/view');
		}
		if(!$this->flexi_auth->is_privileged('St Light Defects')){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		$this->modules->update_st_light_defect($id);
		$this->data['content']	 = $this->load->view('module/st_light_defect/edit', $this->data, true);

		$this->load->view('tpl/structure', $this->data);
	}
	public function reports($report){
		$priv = ucwords(str_replace('_', ' ', $report));
		if(!$this->flexi_auth->is_privileged('Reports') || !$this->flexi_auth->is_privileged($priv)){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$report = "_".$report;
		if(!method_exists($this, $report) || !is_callable(array($this, $report))){
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$defects				 = $this->db->get('defect')->result_array();
		$this->data['defects']	 = $defects;
		$this->modules->make_select('report', 'defect');
		$defect_types			 = $this->db->get('defect_type')->result_array();
		$defect_type_options	 = array();
		foreach($defect_types as $defect_type){
			$defect_type_options[$defect_type['id']] = $defect_type['name'];
		}
		$this->data['defect_types'] = $defect_type_options;
		$this->$report();
	}
	private function _st_light_map(){
		$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		$this->data['content']	 = $this->load->view('module/reports/st_light_map', $this->data, true);

		$this->load->view('tpl/structure', $this->data);
	}
	private function _st_light_report(){
		$this->modules->get_st_light_report();
		$this->data['content'] = $this->load->view('module/reports/st_light_report', $this->data, true);
		$this->load->view('tpl/structure', $this->data);
	}
}
