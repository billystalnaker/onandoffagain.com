<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class LF_Controller extends CI_Controller{
	private $data = array();
	private $class_key;
	private $task_key;
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		//$this->auth = new stdClass;
		$is_logged				 = true;
		$this->data['is_logged'] = $is_logged;
		$this->class_key		 = $this->router->fetch_class();
		$this->task_key			 = $this->router->fetch_method();
		$this->data['class_key'] = $this->class_key;
		$this->data['task_key']	 = $this->task_key;

		// IMPORTANT! This global must be defined BEFORE the flexi auth library is loaded!
		// It is used as a global that is accessible via both models and both libraries, without it, flexi auth will not work.
		$this->auth = new stdClass;
		// Load 'standard' flexi auth library by default.
		$this->load->library('flexi_auth');
		if(!$is_logged && $this->class_key != 'account'){
			// redirect('account');
		}
		$has_access = true;
		if(!$has_access){
			log_message('info', "User {user id goes here} tried to access  {$this->class_key}_$this->task_key.");
			redirect('restricted');
		}
		log_message('debug', "Controller Class ({$this->class_key}_$this->task_key) Initialized");
	}
}

// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */