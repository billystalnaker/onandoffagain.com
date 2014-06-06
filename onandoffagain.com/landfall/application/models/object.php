<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Object extends LF_Model{
    public function __construct(){

	parent::__construct(get_class());
    }
    /**
     *
     * @return type
     * SELECT * FROM `table`
     */
    public function get_info($params){
	$_info = parent::get_info('', $params);
	return $_info;
    }
    public function add($params){
	if(is_array($params)){
	    return $this->db->insert($this->table, $params);
	}
	return false;
    }
    public function edit(){

    }
}

?>