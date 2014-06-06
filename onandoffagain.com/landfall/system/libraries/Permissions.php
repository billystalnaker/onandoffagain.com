<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissions{

    public $CI;

    public function __construct(){
	$this->CI = & get_instance();
	log_message(3, 'CI_Permissions library loaded');
    }
}
