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
			foreach($light as $key=> $v){
				switch($key){
					case 'lat':
					case'long':
						$json[$k]['position'][$key]	 = $v;
						break;
					case 'description':
						$json[$k]['title']			 = $v;
						break;
					default:
						$json[$k][$key]				 = $v;
						break;
				}
			}
		}
		//$json	 = array(array('position'=>array('lat'=>'34.23289745655375', 'long'=>'-77.81651951372623'), 'title'=>'TITLE'));
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
	}
	public function update_marker(){
		$this->load->model('modules');
		$this->output
				->set_content_type('application/json');
		if($post = $this->input->post()){
			if($this->input->post('st_light_id') > 0){
				$this->modules->update_st_light($this->input->post('st_light_id'), true);
				$this->output
						->set_output(true);
			}else{
				$this->output
						->set_output(false);
			}
		}else{
			$this->output
					->set_output(false);
		}
	}
}

?>