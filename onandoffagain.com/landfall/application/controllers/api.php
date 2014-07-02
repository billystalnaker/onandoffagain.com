<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function get_markers($id = 0, $ajax = true){
		$this->load->model('modules');
		if($id <= 0){
			$lights = $this->modules->get_st_lights(true);
		}else{
			$lights = $this->modules->get_st_light($id, true);
		}
		//var_dump($lights);
		$json = array();
		foreach($lights as $k=> $light){
			foreach($light as $key=> $v){
				switch($key){
					case 'lat':
					case 'long':
						$json[$k]['position'][$key]	 = $v;
						break;
					case 'description':
						$json[$k]['title']			 = $v;
						$json[$k]['description']	 = $v;
						break;
					case 'defect_id':
						$base_img_path				 = 'http://onandoffagain.com/landfall/public/img/';
						switch($v){
							//instead of doing it this way do it by priority set limits maybe and for each limit group change the color of the marker
							case '2':
								$img = $base_img_path.'red-marker.png';
								break;
							case'3':
								$img = $base_img_path.'yellow-marker.png';
								break;
							default:
								$img = $base_img_path.'green-marker.png';
								break;
						}
						$img					 = ($light['active'] == 'y')?$img:($base_img_path.'red-marker.png');
						$json[$k]['icon_image']	 = $img;
						$json[$k]['defect_id']	 = $v;
					default:
						$json[$k][$key]			 = $v;
						break;
				}
			}
		}
		if($ajax){
			$this->output
					->set_content_type('application/json')
					->set_output(json_encode($json));
		}
		return $json;
	}
	public function update_marker(){
		$this->load->model('modules');
		$this->output
				->set_content_type('application/json');
		$ret	 = false;
		if($post	 = $this->input->post()){
			if($this->input->post('st_light_id') > 0){
				$this->modules->update_st_light($this->input->post('st_light_id'), true);
				$ret = json_encode($this->get_markers($this->input->post('st_light_id'), false));
			}else{
				$ret = false;
			}
		}
		$this->output
				->set_output($ret);
	}
	public function insert_marker(){
		$this->load->model('modules');
		$this->output
				->set_content_type('application/json');
		$ret	 = false;
		if($post	 = $this->input->post()){
			$ret = $this->modules->insert_st_light(true);
		}
		$this->output
				->set_output($ret);
	}
}

?>