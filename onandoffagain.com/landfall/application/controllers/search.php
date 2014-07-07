<?php

if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class Search extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function _remap($method, $args){
		switch($method){
			case '':
				break;
			default:
				break;
		}
	}
}
