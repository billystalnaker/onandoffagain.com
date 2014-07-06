<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends LF_Controller{

    public function __construct(){
        parent::__construct();
    }

//$this->input->is_ajax_request() should start using this!!!! instead of the optional parameter
    public function get_defects($id = 0, $ajax = true){
        $this->load->model('modules');
        if($id <= 0){
            $defects = $this->modules->get_defects(true);
        }else{
            $defects = $this->modules->get_defect($id, true);
        }
        $json = array();
        foreach($defects as $k => $defect){
            foreach($defect as $key => $v){
                switch($key){
                    default:
                        $json[$k][$key] = $v;
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

    public function get_st_light_defects($id = 0, $ajax = true){
        $this->load->model('modules');
        if($id <= 0){
            return false;
        }
        $sql_select       = array('defect_id', 'comment');
        $sql_where        = array('st_light_id' => $id);
        $st_light_defects = $this->modules->get_st_light_defects($sql_select, $sql_where)->result_array();
        // For the purposes of the example demo view, create an array of ids for all the privileges that have been assigned to a privilege group.
        // The array can then be used within the view to check whether the group has a specific privilege, this data allows us to then format form input values accordingly.
        $json             = array();
        foreach($st_light_defects as $st_light_defect){
            $json['defects']                     = $st_light_defect['defect_id'];
            $json[$st_light_defect['defect_id']] = $st_light_defect['comment'];
        }
        if($ajax){
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($json));
        }
        return $json;
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
        foreach($lights as $k => $light){
            foreach($light as $key => $v){
                switch($key){
                    case 'lat':
                    case 'long':
                        $json[$k]['position'][$key] = $v;
                        break;
                    case 'description':
                        $json[$k]['title']          = $v;
                        $json[$k]['description']    = $v;
                        break;
                    case 'id':
                        $base_img_path              = 'http://onandoffagain.com/landfall/public/img/';
                        $img                        = $base_img_path.'green-marker.png';
                        $flag_colors                = [];
                        $sql_where                  = ['st_light_id' => $v];
                        $st_light_defects           = $this->modules->get_st_light_defects('*', $sql_where)->result_array();
                        if(is_array($st_light_defects) && count($st_light_defects) > 0){
                            foreach($st_light_defects as $st_light_defect){
                                $defect        = $this->modules->get_defect($st_light_defect['defect_id'], true);
                                $this->modules->get_defect_types($defect['defect_type_id']);
                                $flag_colors[] = $this->data['defect_type'][0]['flag_color'];
                            }
                        }
                        $flag_color = '';
                        if(is_array($flag_colors) && count($flag_colors) > 0){
                            foreach(['Green', 'Yellow', 'Red'] as $color){
                                $flag_color = (in_array($color, $flag_colors))?$color:$flag_color;
                            }
                            $img = $base_img_path.strtolower($flag_color).'-marker.png';
                        }
                        $img                    = ($light['active'] == 'y')?$img:($base_img_path.'red-marker.png');
                        $json[$k]['icon_image'] = $img;
                    default:
                        $json[$k][$key]         = $v;
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
        $ret  = false;
        if($post = $this->input->post()){
            if($this->input->post('st_light_id') > 0){
                $this->modules->update_st_light_defect($this->input->post('st_light_id'), true);
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
        $ret  = false;
        if($post = $this->input->post()){
            $id = $this->modules->insert_st_light(true);
            if($id){
                $tmp = $this->modules->update_st_light_defect($id, true);
                $ret = ($tmp)?$id:$tmp;
            }
        }
        $this->output
                ->set_output($ret);
    }

}

?>