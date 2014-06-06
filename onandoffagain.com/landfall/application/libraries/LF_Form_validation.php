<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class LF_Form_validation extends CI_Form_validation{
    public function __construct($rules = array()){
	parent::__construct($rules);
	log_message(3, "LF_Form_validation loaded");
    }
    public function run($group = ''){
	// Do we even have any data to process?  Mm?
	if(count($_POST) == 0){
	    return FALSE;
	}

	// Does the _field_data array containing the validation rules exist?
	// If not, we look to see if they were assigned via a config file
	if(count($this->_field_data) == 0){
	    // No validation rules?  We're done...
	    if(count($this->_config_rules) == 0){
		return FALSE;
	    }
	    //only get rules for the class/method and first parameter
	    $uri = $this->CI->uri->total_rsegments();
	    if($this->CI->uri->total_rsegments() > 3){
		$extra_params		 = $this->CI->uri->ruri_to_assoc();
		$extra_params_string	 = implode('/', $extra_params);
		$uri			 = str_replace($extra_params_string, '', $this->CI->uri->ruri_string());
		//implode('/', $this->rsegment_array())
	    }
	    $uri = ($group == '')?trim($uri, '/'):$group;
	    // Is there a validation rule for the particular URI being accessed?
	    if($uri != '' AND isset($this->_config_rules[$uri])){
		$this->set_rules($this->_config_rules[$uri]);
	    }else{
		$this->set_rules($this->_config_rules);
	    }

	    // We're we able to set the rules correctly?
	    if(count($this->_field_data) == 0){
		log_message('debug', "Unable to find validation rules");
		return FALSE;
	    }
	}
	// Load the language file containing error messages
	$this->CI->lang->load('form_validation');

	// Cycle through the rules for each field, match the
	// corresponding $_POST item and test for errors

	foreach($this->_field_data as $field=> $row){
	    // Fetch the data from the corresponding $_POST array and cache it in the _field_data array.
	    // Depending on whether the field name is an array or a string will determine where we get it from.

	    if($row['is_array'] == TRUE){
		$this->_field_data[$field]['postdata'] = $this->_reduce_array($_POST, $row['keys']);
	    }else{
		if(isset($_POST[$field]) AND $_POST[$field] != ""){
		    $this->_field_data[$field]['postdata'] = $_POST[$field];
		}
	    }
	    $this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);
	}

	// Did we end up with any errors?
	$total_errors = count($this->_error_array);

	if($total_errors > 0){
	    $this->_safe_form_data = TRUE;
	}

	// Now we need to re-set the POST data with the new, processed data
	$this->_reset_post_array();

	// No errors, validation passes!
	if($total_errors == 0){
	    return TRUE;
	}

	// Validation fails
	return FALSE;
    }
    public function set_select($field = '', $value = '', $default = FALSE){
	if(!isset($this->_field_data[$field]) OR !isset($this->_field_data[$field]['postdata'])){
	    if(($default === TRUE || $default == $value) AND count($this->_field_data) === 0){
		return ' selected="selected"';
	    }
	    return '';
	}
	$field = $this->_field_data[$field]['postdata'];

	if(is_array($field)){
	    if(!in_array($value, $field)){
		return '';
	    }
	}else{
	    if(($field == '' OR $value == '') OR ($field != $value)){
		return '';
	    }
	}
	return ' selected="selected"';
    }
}
