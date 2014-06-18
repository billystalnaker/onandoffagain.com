<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Objects extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function add($object = NULL){
		if(is_null($object)){
			show_error('Invalid URL, please contact your system administrator if you feel this is an error.');
		}elseif(!$this->load->model('object')->set_table($object)->table_exists()){
			show_error('Invalid URL, please contact your system administrator if you feel this is an error.');
		}
		$this->load->helper('object_helper');
		$this->load->config('form_validation');
		$this->load->library('form_validation', $this->config)
				->set_error_delimiters('<div class="alert alert-danger form-signin">', '</div>');
		$info						 = $this->object->describe();
		$this->data['object_info']	 = array('object'=>$object, 'info'=>$info); //get the field info);
		if($this->form_validation->run() == FALSE){
			$this->data['content'] = $this->load->view('objects/add', $this->data, true);
		}else{
			$this->object->add($params);
			redirect("objects/view/$object/{$params['id']}");
			//insert module into db redirect to display page of that module
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
