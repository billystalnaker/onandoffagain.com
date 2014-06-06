<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounts extends LF_Controller{
    public function index(){
	$this->load->config('form_validation');
	$this->load->library('form_validation', $this->config)
		->set_error_delimiters('<div class="alert alert-danger form-signin">', '</div>');
	if($this->form_validation->run() == FALSE){
	    $content = $this->load->view('account/login', array(), true);
	}else{
//form is good-> set session data
	    $employee_info		 = $this->load->model('Employee')->Employee->get_info();
	    $employee_info['logged'] = true;
	    $this->session->set_userdata($employee_info);
	    redirect('home');
	}
	$this->content_array['content'] = $content;
	$this->load->view('tpl/structure', $this->content_array);
    }
    function check_login(){
	$username	 = trim($this->input->post('username'));
	$password	 = trim($this->input->post('password'));
	if($username == '' && $password == ''){
	    return true;
	}else{
	    $valid = $this->load->model('Employee')->check_login($username, $password);

	    if($valid){
		return true;
	    }else{
		$this->form_validation->set_message('check_login', 'That login information is not correct.');
		return false;
	    }
	}
    }
    public function logout(){
	$this->session->sess_destroy();
	$this->content_array['content'] = $this->load->view('account/logout', $this->content_array, true);
	$this->load->view('tpl/structure', $this->content_array);
    }
}
