<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends LF_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->login();
	}
	function login(){

	}
	public function logout(){

	}
}
