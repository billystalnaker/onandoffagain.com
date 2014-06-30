<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function get_markers(){
		$this->load->model('modules');
		$lights	 = $this->modules->get_st_lights(true);
		//var_dump($lights);
		$json	 = array();
		foreach($lights as $k=> $light){
			$json[$k]['id']			 = $light['id'];
			$json[$k]['position']	 = array('lat'=>$light['lat'], 'long'=>$light['long']);
			$json[$k]['title']		 = $light['description'];
			$json[$k]['defect']		 = $light['defect_id'];
		}
		//$json	 = array(array('position'=>array('lat'=>'34.23289745655375', 'long'=>'-77.81651951372623'), 'title'=>'TITLE'));
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
	}
	public function update_marker(){
		$json = $this->input->post();
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
	}
}

?>