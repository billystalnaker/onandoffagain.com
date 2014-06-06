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
	private static $instance;
	public $content_array	 = array();
	private $class_key		 = '';
	private $task_key		 = '';
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		$is_logged							 = $this->permissions->is_logged();
		$this->content_array['is_logged']	 = $is_logged;
		$this->class_key					 = $this->router->fetch_class();
		$this->task_key						 = $this->router->fetch_method();
		$this->content_array['class_key']	 = $this->class_key;
		$this->content_array['task_key']	 = $this->task_key;
		if(!$is_logged && $this->class_key != 'account'){
			// redirect('account');
		}
		$has_access = $this->permissions->check_access($this->class_key.$this->task_key);

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