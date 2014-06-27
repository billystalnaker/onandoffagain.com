<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module extends LF_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function users($action = NULL, $id = NULL) {
        $action = (!is_null($action)) ? $action : 'view';
        $id     = (!is_null($id)) ? $id : 0;
        if($action === 'edit' && $id <= 0) {
            //set flashdata sayign you must have id in order to edit
            redirect('module/users/view');
        }
        if((false && !$this->flexi_auth->is_privileged('Users')) || (false && !$this->flexi_auth->is_privileged(ucfirst($action) . ' Users'))) {
            //set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');

        $filters           = array ('ugrp_id !=' => 1);
        $groups            = $this->flexi_auth->get_groups(FALSE, $filters)->result_array();
        $group_options     = array ();
        $group_options[''] = 'Please Select...';
        foreach($groups as $group) {
            $group_options[$group['ugrp_id']] = $group['ugrp_name'];
        }
        $this->data['group_options'] = $group_options;
        $this->data['message']       = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch($action) {
            case 'add':
                $this->modules->insert_user();
                $this->data['content'] = $this->load->view('module/user/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_user($id);
                $this->modules->update_user_account($id);
                $this->data['content'] = $this->load->view('module/user/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_users();
                // Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/user/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function groups($action = NULL, $id = NULL) {
        $action = (!is_null($action)) ? $action : 'view';
        $id     = (!is_null($id)) ? $id : 0;
        if($action === 'edit' && $id <= 0) {
            //set flashdata sayign you must have id in order to edit
            redirect('module/groups/view');
        }
        if((false && !$this->flexi_auth->is_privileged('Groups')) || (false && !$this->flexi_auth->is_privileged(ucfirst($action) . ' Groups'))) {
            //set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch($action) {
            case 'add':
                $this->modules->insert_user_group();
                $this->data['content'] = $this->load->view('module/group/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_user_group($id);
                $this->modules->update_user_group($id);
                $this->data['content'] = $this->load->view('module/group/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_user_groups();
                // Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/group/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function privileges($action = NULL, $id = NULL) {
        $action = (!is_null($action)) ? $action : 'view';
        $id     = (!is_null($id)) ? $id : 0;
        if($action === 'edit' && $id <= 0) {
            //set flashdata sayign you must have id in order to edit
            redirect('module/privileges/view');
        }
        if((false && !$this->flexi_auth->is_privileged('Privileges')) || (false && !$this->flexi_auth->is_privileged(ucfirst($action) . ' Privileges'))) {
            //set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch($action) {
            case 'add':
                $this->modules->insert_privilege();
                $this->data['content'] = $this->load->view('module/privilege/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_privilege($id);
                $this->modules->update_privilege($id);
                $this->data['content'] = $this->load->view('module/privilege/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_privileges();
                // Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/privilege/view', $this->data, true);
                break;
        }
        $this->load->view('tpl/structure', $this->data);
    }

    public function st_lights($action = NULL, $id = NULL) {
        $action = (!is_null($action)) ? $action : 'view';
        $id     = (!is_null($id)) ? $id : 0;
        if($action === 'edit' && $id <= 0) {
            //set flashdata sayign you must have id in order to edit
            redirect('module/st_lights/view');
        }
        if((false && !$this->flexi_auth->is_privileged('St Lights')) || (false && !$this->flexi_auth->is_privileged(ucfirst($action) . ' St Lights'))) {
            //set flashdata saying you dont have access to this
            redirect('home/dashboard');
        }
        $this->load->model('modules');
        $this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
        switch($action) {
            case 'add':
                $this->modules->insert_st_light();
                $this->data['content'] = $this->load->view('module/st_light/add', $this->data, true);
                break;
            case 'edit':
                $this->modules->get_st_light($id);
                $this->modules->update_st_light($id);
                $this->data['content'] = $this->load->view('module/st_light/edit', $this->data, true);
                break;
            case 'view':
            default:
                $this->modules->get_st_lights();
                // Set any returned status/error messages.

                $this->data['content'] = $this->load->view('module/st_light/view', $this->data, true);
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
		if((false && !$this->flexi_auth->is_privileged('User Privileges'))){
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
			redirect('module/users/view');
		}
		if((false && !$this->flexi_auth->is_privileged('Group Privileges'))){
			//set flashdata saying you dont have access to this
			redirect('home/dashboard');
		}
		$this->load->model('modules');
		$this->data['message']	 = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
		$this->modules->update_group_privileges($id);
		$this->data['content']	 = $this->load->view('module/group_privilege/edit', $this->data, true);

		$this->load->view('tpl/structure', $this->data);
	}
}
