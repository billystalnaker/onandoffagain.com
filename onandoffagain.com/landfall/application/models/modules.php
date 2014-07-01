<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modules extends LF_Model{
// The following method prevents an error occurring when $this->data is modified.
// Error Message: 'Indirect modification of overloaded property Demo_cart_admin_model::$data has no effect'.
    public function &__get($key){
	$CI = & get_instance();
	return $CI->$key;
    }
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
// User Accounts
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
    /**
     * get_user_accounts
     * Gets a paginated list of users that can be filtered via the user search form, filtering by the users email and first and last names.
     */
    function get_users(){
// Select user data to be displayed.
	$sql_select		 = array(
	    $this->flexi_auth->db_column('user_acc', 'id'),
	    $this->flexi_auth->db_column('user_acc', 'email'),
	    $this->flexi_auth->db_column('user_acc', 'username'),
	    $this->flexi_auth->db_column('user_group', 'name'),
	    'upro_first_name',
	    'upro_last_name',
	);
	$this->flexi_auth->sql_select($sql_select);
	$this->data['users']	 = $this->flexi_auth->get_user_array();
    }
    function get_user_groups(){
// Select user data to be displayed.
	$sql_select		 = array(
	    $this->flexi_auth->db_column('user_group', 'id'),
	    $this->flexi_auth->db_column('user_group', 'name'),
	    $this->flexi_auth->db_column('user_group', 'description'),
	);
	$this->flexi_auth->sql_select($sql_select);
	$this->data['groups']	 = $this->flexi_auth->get_user_group_array();
    }
    function get_privileges(){
// Select user data to be displayed.
	$sql_select			 = array(
	    $this->flexi_auth->db_column('user_privilege', 'id'),
	    $this->flexi_auth->db_column('user_privilege', 'name'),
	    $this->flexi_auth->db_column('user_privilege', 'description'),
	);
	$this->flexi_auth->sql_select($sql_select);
	$this->data['privileges']	 = $this->flexi_auth->get_privilege_array();
    }
    function get_st_lights($ajax = false){
// Select user data to be displayed.
	$sql_select = array('id', 'location', 'description', 'lat', 'long', 'defect_id', 'active');
	if($ajax){
	    return $this->db->select($sql_select)->get('st_light')->result_array();
	}
	$this->data['st_lights'] = $this->db->select($sql_select)->get('st_light')->result_array();
    }
    function get_defects(){
// Select user data to be displayed.
	$sql_select		 = array('id', 'name', 'description', 'active');
	$this->data['defects']	 = $this->db->select($sql_select)->get('defect')->result_array();
    }
    function get_user_group($group_id){
	$filters		 = array(
	    $this->flexi_auth->db_column('user_group', 'id')=>$group_id);
	$this->data['group']	 = array_shift($this->flexi_auth->get_user_group_array(FALSE, $filters));
    }
    function get_privilege($privilege_id){
	$filters		 = array(
	    $this->flexi_auth->db_column('user_privileges', 'id')=>$privilege_id);
	$this->data['privilege'] = array_shift($this->flexi_auth->get_privilege_array(FALSE, $filters));
    }
    function get_st_light($st_light_id, $ajax = false){
	$filters = array('id'=>$st_light_id);
	if($ajax){
	    return $this->db->where($filters)->get('st_light')->result_array();
	}
	$this->data['st_light'] = array_shift($this->db->where($filters)->get('st_light')->result_array());
    }
    function get_defect($defect_id){
	$filters		 = array('id'=>$defect_id);
	$this->data['defect']	 = array_shift($this->db->where($filters)->get('defect')->result_array());
    }
    function get_user($user_id){
	$filters[$this->flexi_auth->db_column('user_acc', 'id')] = $user_id;

	$this->data['user'] = array_shift($this->flexi_auth->get_users_query(FALSE, $filters)->result_array());
    }
    /**
     * update_user_account
     * Updates the account and profile data of a specific user.
     * Note: The user profile table ('demo_user_profiles') is used in this demo as an example of relating additional user data to the auth libraries account tables.
     */
    function update_user_account($user_id){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'update_user_first_name',
		'label'	=>'First Name',
		'rules'	=>'required'),
	    array(
		'field'	=>'update_user_last_name',
		'label'	=>'Last Name',
		'rules'	=>'required'),
	    array(
		'field'	=>'update_user_email',
		'label'	=>'Email Address',
		'rules'	=>'required|valid_email'),
	    array(
		'field'	=>'update_user_group_id',
		'label'	=>'User Group',
		'rules'	=>'required|integer')
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// 'Update User Account' form data is valid.
// IMPORTANT NOTE: As we are updating multiple tables (The main user account and user profile tables), it is very important to pass the
// primary key column and value in the $profile_data for any custom user tables being updated, otherwise, the function will not
// be able to identify the correct custom data row.
// In this example, the primary key column and value is 'upro_id' => $user_id.
	    $profile_data = array(
		'upro_first_name'					=>$this->input->post('update_user_first_name'),
		'upro_last_name'					=>$this->input->post('update_user_last_name'),
		$this->flexi_auth->db_column('user_acc', 'email')	=>$this->input->post('update_user_email'),
		$this->flexi_auth->db_column('user_acc', 'group_id')	=>$this->input->post('update_user_group_id')
	    );

// If we were only updating profile data (i.e. no email, username or group included), we could use the 'update_custom_user_data()' function instead.
	    $this->flexi_auth->update_user($user_id, $profile_data);

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/users/view');
	}

	return FALSE;
    }
    /**
     * update_user_group
     * Updates a specific user group.
     */
    function update_user_group($group_id){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'update_group_name',
		'label'	=>'Group Name',
		'rules'	=>'required'),
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get user group data from input.
	    $data = array(
		$this->flexi_auth->db_column('user_group', 'name')		=>$this->input->post('update_group_name'),
		$this->flexi_auth->db_column('user_group', 'description')	=>$this->input->post('update_group_desc'),
	    );

	    $this->flexi_auth->update_group($group_id, $data);

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/groups/view');
	}
    }
    /**
     * update_privilege
     * Updates a specific privilege.
     */
    function update_privilege($privilege_id){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'update_privilege_name',
		'label'	=>'Privilege Name',
		'rules'	=>'required')
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get privilege data from input.
	    $data = array(
		$this->flexi_auth->db_column('user_privileges', 'name')		=>$this->input->post('update_privilege_name'),
		$this->flexi_auth->db_column('user_privileges', 'description')	=>$this->input->post('update_privilege_desc')
	    );

	    $this->flexi_auth->update_privilege($privilege_id, $data);

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/privileges/view');
	}
    }
    /**
     * update_st_light
     * Updates a specific st_light.
     */
    function update_st_light($st_light_id, $ajax = false){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'update_st_light_desc',
		'label'	=>'St. Light Description',
		'rules'	=>'required'),
	    array(
		'field'	=>'update_st_light_location',
		'label'	=>'St. Light Location',
		'rules'	=>'required'
	    ),
	    array(
		'field'	=>'update_st_light_defect',
		'label'	=>'St. Light Defect',
		'rules'	=>'integer'
	    )
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run() || $ajax){
// Get st_light data from input.
	    if($ajax){
		$data = array(
		    'defect_id'	=>$this->input->post('st_light_defect_id'),
		    'active'	=>$this->input->post('st_light_active')
		);
	    }else{
		$data = array(
		    'location'	=>$this->input->post('update_st_light_location'),
		    'description'	=>$this->input->post('update_st_light_desc'),
		    'lat'		=>$this->input->post('update_st_light_lat_loc'),
		    'long'		=>$this->input->post('update_st_light_long_loc'),
		    'defect_id'	=>$this->input->post('update_st_light_defect'),
		    'active'	=>$this->input->post('update_st_light_active'),
		);
	    }
	    $sql_where = array('id'=>$st_light_id);
	    $this->db->update('st_light', $data, $sql_where);
	    if($this->db->affected_rows() == 1){
		$this->flexi_auth_model->set_status_message('update_successful', 'config');
	    }else{
		$this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
	    }
// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
	    if(!$ajax){
// Redirect user.
		redirect('module/st_lights/view');
	    }
	}
    }
    /**
     * update_defect
     * Updates a specific defect.
     */
    function update_defect($defect_id){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'update_defect_name',
		'label'	=>'Defect Name',
		'rules'	=>'required'
	    )
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get defect data from input.
	    $data = array(
		'name'		=>$this->input->post('update_defect_name'),
		'description'	=>$this->input->post('update_defect_desc'),
		'active'	=>$this->input->post('update_defect_active'),
	    );

	    $sql_where = array('id'=>$defect_id);

	    $this->db->update('defect', $data, $sql_where);
	    if($this->db->affected_rows() == 1){

		$this->flexi_auth_model->set_status_message('update_successful', 'config');
	    }else{
		$this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
	    }
// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/defects/view');
	}
    }
    /**
     * update_user_privileges
     * Updates the privileges for a specific user.
     */
    function update_user_privileges($user_id){
// If 'Update User Privilege' form has been submitted, update the user privileges.
	if($this->input->post('update_user_privilege')){
// Update privileges.
	    foreach($this->input->post('update') as $row){
		if($row['current_status'] != $row['new_status']){
// Insert new user privilege.
		    if($row['new_status'] == 1){
			$this->flexi_auth->insert_privilege_user($user_id, $row['id']);
		    }
// Delete existing user privilege.
		    else{
			$sql_where = array(
			    $this->flexi_auth->db_column('user_privilege_users', 'user_id')		=>$user_id,
			    $this->flexi_auth->db_column('user_privilege_users', 'privilege_id')	=>$row['id']
			);

			$this->flexi_auth->delete_privilege_user($sql_where);
		    }
		}
	    }
// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect("module/user_privileges/$user_id");
	}
// Get users profile data.
	$sql_select		 = array(
	    'upro_first_name',
	    'upro_last_name',
	    $this->flexi_auth->db_column('user_acc', 'group_id'),
	    $this->flexi_auth->db_column('user_group', 'name')
	);
	$sql_where		 = array(
	    $this->flexi_auth->db_column('user_acc', 'id')=>$user_id);
	$this->data['user']	 = $this->flexi_auth->get_users_row_array($sql_select, $sql_where);

// Get all privilege data.
	$sql_select			 = array(
	    $this->flexi_auth->db_column('user_privileges', 'id'),
	    $this->flexi_auth->db_column('user_privileges', 'name'),
	    $this->flexi_auth->db_column('user_privileges', 'description')
	);
	$this->data['privileges']	 = $this->flexi_auth->get_privileges_array($sql_select);
// Get user groups current privilege data.
	$sql_select			 = array(
	    $this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
	$sql_where			 = array(
	    $this->flexi_auth->db_column('user_privilege_groups', 'group_id')=>$this->data['user'][$this->flexi_auth->db_column('user_acc', 'group_id')]);
	$group_privileges		 = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);
	$this->data['group_privileges']	 = array();
	foreach($group_privileges as $privilege){
	    $this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
	}

// Get users current privilege data.
	$sql_select	 = array(
	    $this->flexi_auth->db_column('user_privilege_users', 'privilege_id'));
	$sql_where	 = array(
	    $this->flexi_auth->db_column('user_privilege_users', 'user_id')=>$user_id);
	$user_privileges = $this->flexi_auth->get_user_privileges_array($sql_select, $sql_where);

// For the purposes of the example demo view, create an array of ids for all the users assigned privileges.
// The array can then be used within the view to check whether the user has a specific privilege, this data allows us to then format form input values accordingly.
	$this->data['user_privileges'] = array();
	foreach($user_privileges as $privilege){
	    $this->data['user_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_users', 'privilege_id')];
	}

// Set any returned status/error messages.
	$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
    }
    /**
     * update_group_privileges
     * Updates the privileges for a specific user group.
     */
    function update_group_privileges($group_id){
// Update privileges.

	if($this->input->post('update_group_privilege')){
	    foreach($this->input->post('update') as $row){
		if($row['current_status'] != $row['new_status']){
// Insert new user privilege.
		    if($row['new_status'] == 1){
			$this->flexi_auth->insert_user_group_privilege($group_id, $row['id']);
		    }
// Delete existing user privilege.
		    else{
			$sql_where = array(
			    $this->flexi_auth->db_column('user_privilege_groups', 'group_id')	=>$group_id,
			    $this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')	=>$row['id']
			);
			$this->flexi_auth->delete_user_group_privilege($sql_where);
		    }
		}
	    }

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect("module/group_privileges/$group_id");
	}

// Get data for the current user group.
	$sql_where		 = array(
	    $this->flexi_auth->db_column('user_group', 'id')=>$group_id);
	$this->data['group']	 = $this->flexi_auth->get_groups_row_array(FALSE, $sql_where);

// Get all privilege data.
	$sql_select			 = array(
	    $this->flexi_auth->db_column('user_privileges', 'id'),
	    $this->flexi_auth->db_column('user_privileges', 'name'),
	    $this->flexi_auth->db_column('user_privileges', 'description')
	);
	$this->data['privileges']	 = $this->flexi_auth->get_privileges_array($sql_select);

// Get data for the current privilege group.
	$sql_select		 = array(
	    $this->flexi_auth->db_column('user_privilege_groups', 'privilege_id'));
	$sql_where		 = array(
	    $this->flexi_auth->db_column('user_privilege_groups', 'group_id')=>$group_id);
	$group_privileges	 = $this->flexi_auth->get_user_group_privileges_array($sql_select, $sql_where);

// For the purposes of the example demo view, create an array of ids for all the privileges that have been assigned to a privilege group.
// The array can then be used within the view to check whether the group has a specific privilege, this data allows us to then format form input values accordingly.
	$this->data['group_privileges'] = array();
	foreach($group_privileges as $privilege){
	    $this->data['group_privileges'][] = $privilege[$this->flexi_auth->db_column('user_privilege_groups', 'privilege_id')];
	}

// Set any returned status/error messages.
	$this->data['message'] = (!isset($this->data['message']))?$this->session->flashdata('message'):$this->data['message'];
    }
    /**
     * delete_users
     * Delete all user accounts that have not been activated X days since they were registered.
     */
    function delete_users($inactive_days){
// Deleted accounts that have never been activated.
	$this->flexi_auth->delete_unactivated_users($inactive_days);

// Save any public or admin status or error messages to CI's flash session data.
	$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	redirect('auth_admin/manage_user_accounts');
    }
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
// User Groups
###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
    /**
     * manage_user_groups
     * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated user groups.
     */
    function update_groups(){
// Delete groups.
	if($this->flexi_auth->is_privileged('Delete Groups')){
	    if($delete_groups = $this->input->post('delete_group')){
		foreach($delete_groups as $group_id=> $delete){
// Note: As the 'delete_group' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
		    $this->flexi_auth->delete_group($group_id);
		}
// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
		redirect('auth_admin/manage_user_groups');
	    }
	}
    }
    /**
     * update_user_accounts
     * The function loops through all POST data checking the 'Suspend' and 'Delete' checkboxes that have been checked, and updates/deletes the user accounts accordingly.
     */
    function update_users(){
// If user has privileges, delete users.
	if($this->input->post()){
	    if($this->flexi_auth->is_privileged('Delete Users')){
		if($delete_users = $this->input->post('delete_user')){
		    foreach($delete_users as $user_id=> $delete){
// Note: As the 'delete_user' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
			$this->flexi_auth->delete_user($user_id);
		    }
		}
	    }

// Update User Suspension Status.
// Suspending a user prevents them from logging into their account.
	    if($user_status = $this->input->post('suspend_status')){
// Get current statuses to check if submitted status has changed.
		$current_status = $this->input->post('current_status');

		foreach($user_status as $user_id=> $status){
		    if($current_status[$user_id] != $status){
			if($status == 1){
			    $this->flexi_auth->update_user($user_id, array(
				$this->flexi_auth->db_column('user_acc', 'suspend')=>1));
			}else{
			    $this->flexi_auth->update_user($user_id, array(
				$this->flexi_auth->db_column('user_acc', 'suspend')=>0));
			}
		    }
		}
	    }

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/users/view');
	}
    }
    /**
     * manage_privileges
     * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated privileges.
     */
    function update_privileges(){
// Delete privileges.
	if($delete_privileges = $this->input->post('delete_privilege')){
	    foreach($delete_privileges as $privilege_id=> $delete){
// Note: As the 'delete_privilege' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
		$this->flexi_auth->delete_privilege($privilege_id);
	    }


// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/privileges/view');
	}
    }
    /**
     * update st_lights
     * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated st_lights.
     */
    function update_st_lights(){
// Delete st_lights.
	if($this->flexi_auth->is_privileged('Delete St Lights')){
	    if($delete_st_lights = $this->input->post('delete_st_light')){
		foreach($delete_st_lights as $st_light_id=> $delete){
// Note: As the 'delete_privilege' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
		    $sql_where = array('id'=>$st_light_id);
// Delete privileges.
		    $this->db->delete('st_light', $sql_where);
		}
// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
		redirect('module/st_lights/view');
	    }
	}
    }
    /**
     * update defects
     * The function loops through all POST data checking the 'Delete' checkboxes that have been checked, and deletes the associated defects.
     */
    function update_defects(){
// Delete defects.
	if($this->flexi_auth->is_privileged('Delete St Lights')){
	    if($delete_defects = $this->input->post('delete_defect')){
		foreach($delete_defects as $defect_id=> $delete){
// Note: As the 'delete_privilege' input is a checkbox, it will only be present in the $_POST data if it has been checked,
// therefore we don't need to check the submitted value.
		    $sql_where = array('id'=>$defect_id);
// Delete privileges.
		    $this->db->delete('defect', $sql_where);
		}
// Save any public or admin status or error messages to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
		redirect('module/defects/view');
	    }
	}
    }
    /**
     * insert_user_group
     * Inserts a new user group.
     */
    function insert_user_group(){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'insert_group_name',
		'label'	=>'Group Name',
		'rules'	=>'required'),
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get user group data from input.
	    $group_name	 = $this->input->post('insert_group_name');
	    $group_desc	 = $this->input->post('insert_group_desc');

	    $this->flexi_auth->insert_group($group_name, $group_desc, 0);

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/groups/view');
	}
    }
    /**
     * insert_privilege
     * Inserts a new privilege.
     */
    function insert_privilege(){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'insert_privilege_name',
		'label'	=>'Privilege Name',
		'rules'	=>'required')
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get privilege data from input.
	    $privilege_name	 = $this->input->post('insert_privilege_name');
	    $privilege_desc	 = $this->input->post('insert_privilege_desc');

	    $this->flexi_auth->insert_privilege($privilege_name, $privilege_desc);

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/privileges/view');
	}
    }
    /**
     * insert_user
     * Inserts a new user .
     */
    function insert_user(){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'insert_user_user_name',
		'label'	=>'User Name',
		'rules'	=>'required'),
	    array(
		'field'	=>'insert_user_user_name',
		'label'	=>'User Name',
		'rules'	=>'is_unique[user_accounts.uacc_username]'),
	    array(
		'field'	=>'insert_user_first_name',
		'label'	=>'First Name',
		'rules'	=>''),
	    array(
		'field'	=>'insert_user_last_name',
		'label'	=>'Last Name',
		'rules'	=>''),
	    array(
		'field'	=>'insert_user_email',
		'label'	=>'Email',
		'rules'	=>'required|valid_email'),
	    array(
		'field'	=>'insert_user_group_id',
		'label'	=>'Group ID',
		'rules'	=>'integer|required'),
	    array(
		'field'	=>'insert_user_password',
		'label'	=>'Password',
		'rules'	=>'required'),
	    array(
		'field'	=>'insert_user_password_confirmation',
		'label'	=>'Password Confirmation',
		'rules'	=>'matches[insert_user_password]')
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get user group data from input.
	    $user_name	 = $this->input->post('insert_user_user_name');
	    $user_email	 = $this->input->post('insert_user_email');
	    $password	 = $this->input->post('insert_user_password');
	    $user_first_name = $this->input->post('insert_user_first_name');
	    $user_last_name	 = $this->input->post('insert_user_last_name');
	    $user_group_id	 = $this->input->post('insert_user_group_id');
	    $user_data	 = array(
		'upro_first_name'	=>$user_first_name,
		'upro_last_name'	=>$user_last_name,
	    );
	    if($this->flexi_auth->insert_user($user_email, $user_name, $password, $user_data, $user_group_id, true)){
// Redirect user.
		redirect('module/users/view');
	    }
// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());
	}
    }
    /**
     * insert_st_light
     * Inserts a new st_light.
     */
    function insert_st_light($ajax){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'insert_st_light_desc',
		'label'	=>'St. Light Description',
		'rules'	=>'required'),
	    array(
		'field'	=>'insert_st_light_location',
		'label'	=>'St. Light Location',
		'rules'	=>'required'
	    ),
	    array(
		'field'	=>'insert_st_light_defect',
		'label'	=>'St. Light Defect',
		'rules'	=>'integer'
	    )
	);

	$this->form_validation->set_rules($validation_rules);
	$ret = false;
	if($this->form_validation->run()){
// Get st_light data from input.
	    $st_light_location		 = $this->input->post('insert_st_light_location');
	    $st_light_desc			 = $this->input->post('insert_st_light_desc');
	    $st_light_lat_loc		 = $this->input->post('insert_st_light_lat_loc');
	    $st_light_long_loc		 = $this->input->post('insert_st_light_long_loc');
	    $st_light_defect		 = $this->input->post('insert_st_light_defect');
	    $st_light_active		 = $this->input->post('insert_st_light_active');
// Set standard privilege data.
	    $sql_insert['location']		 = $st_light_location;
	    $sql_insert['description']	 = $st_light_desc;
	    $sql_insert['lat']		 = $st_light_lat_loc;
	    $sql_insert['long']		 = $st_light_long_loc;
	    $sql_insert['defect_id']	 = $st_light_defect;
	    $sql_insert['active']		 = $st_light_active;
	    $this->db->insert('st_light', $sql_insert);

	    $ret = ($this->db->affected_rows() == 1)?$this->db->insert_id():FALSE;
	    if($ret){
		$this->flexi_auth_model->set_status_message('update_successful', 'config');
	    }else{
		$this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
	    }

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    if($ajax){
		return $ret;
	    }
	    redirect('module/st_lights/view');
	}
    }
    function insert_defect(){
	$this->load->library('form_validation');

// Set validation rules.
	$validation_rules = array(
	    array(
		'field'	=>'insert_defect_name',
		'label'	=>'Defect Name',
		'rules'	=>'required'),
	);

	$this->form_validation->set_rules($validation_rules);

	if($this->form_validation->run()){
// Get defect data from input.
	    $defect_name			 = $this->input->post('insert_defect_name');
	    $defect_desc			 = $this->input->post('insert_defect_desc');
	    $defect_active			 = $this->input->post('insert_defect_active');
// Set standard privilege data.
	    $sql_insert['name']		 = $defect_name;
	    $sql_insert['description']	 = $defect_desc;
	    $sql_insert['active']		 = $defect_active;
	    $this->db->insert('defect', $sql_insert);

	    if(($this->db->affected_rows() == 1)?$this->db->insert_id():FALSE){
		$this->flexi_auth_model->set_status_message('update_successful', 'config');
	    }else{
		$this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
	    }

// Save any public or admin status or error messages to CI's flash session data.
	    $this->session->set_flashdata('message', $this->flexi_auth->get_messages());

// Redirect user.
	    redirect('module/defects/view');
	}
    }
}

/* End of file demo_auth_admin_model.php */
/* Location: ./application/models/demo_auth_admin_model.php */