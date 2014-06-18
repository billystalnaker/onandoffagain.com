<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$content				 = $this->load->view('home', array(), true);
		$this->data['content']	 = $content;
		$this->load->view('tpl/structure', $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
