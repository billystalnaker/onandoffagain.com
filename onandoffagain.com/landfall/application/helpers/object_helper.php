<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');
if(!function_exists('make_db_form_field')){
    function make_db_form_field($type, $params = array()){
	$set_values	 = isset($params['set_values']) && $params['set_values'] == true?true:false;
	$limit_str	 = strstr($type, '(');
	$limit		 = intval(str_replace(array('(', ')'), '', $limit_str));
	if($limit <= 0){
	    $limit = 50;
	}
	switch(substr($type, strpos($type, '('))){
	    case'text':
	    case'varchar':
		if($limit > 50){
		    return form_textarea($params, ($set_values)?set_value($params['name']):'');
		}else{
		    return form_input($params, ($set_values)?set_value($params['name']):'');
		}
		break;
	    case 'mediumint':
	    case'int':
	    case'float':
	    case'decimal':
		break;
	}
    }
}