<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends LF_Controller{
	public function index(){
		$content						 = $this->load->view('welcome', array(), true);
		$this->content_array['content']	 = $content;
		$this->load->view('tpl/structure', $this->content_array);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
