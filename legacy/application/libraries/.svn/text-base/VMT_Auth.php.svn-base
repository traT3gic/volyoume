<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * VMT
 *
 * A volunteer management system.
 *
 * @package     VMT
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @copyright   Copyright (c) 2009 - 2010, Guillermo A. Fisher
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * VMT Authentication Library
 *
 * This class handles authentication.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */

class VMT_Auth
{

	/**
	 * The key to be used for authentication.
	 * @access private
	 * @var string
	 */
	private $_key = '_is_auth';

	/**
	 * An instance of the CodeIgniter super object.
	 * @access private
	 * @var object
	 */
	private $_ci;

	/**
	 * Constructor. Register the CI super object.
	 * @access public
	 * @return null
	 */
	public function __construct()
	{
		$this->_ci =& get_instance();
	}

    /**
     * Logs a volunteer in.
     * @access public
     * @return object|false
     */
    public function login()
    {
    	if ($user = $this->_ci->session->userdata('auth')) {
    		$this->_ci->session->set_userdata($this->_key, true);
    		$this->_ci->session->unset_userdata('auth');
			return $user;
		}
		return false;
    }
    
    /**
     * Logs a volunteer out.
     * @access public
     * @return null
     */
	public function logout()
	{
		$this->_ci->session->sess_destroy();
	}

	/**
	 * Determine whether or not the volunteer is logged in.
	 * @access public
	 * @return bool
	 */
	public function is_logged_in()
	{
		if ($logged_in = $this->_ci->session->userdata($this->_key)) {
			return true;
		}
		return false;
	}

	/**
	 * Determine whether or not the volunteer is the active group's
	 * leader.
	 * @access public
	 * @return bool
	 */
	public function is_leader()
	{
		return ($this->_ci->session->userdata('role_id') == 2);
	}
	
	/**
	 * Determine whether or not the volunteer is an auditor.
	 * @access public
	 * @return bool
	 */
	public function is_auditor()
	{
		return ($this->_ci->session->userdata('role_id') == 3);
	}	

	/**
	 * Determine whether or not the volunteer is a super administrator.
	 * @access public
	 * @return bool
	 */
	public function is_super_admin()
	{
		return ($this->_ci->session->userdata('role_id') == 4);
	}
	
	public function has_permission($module, $action)
	{
		// if it's a super admin, return true
		if ($this->is_super_admin()) {
			return true;
		}
		
		// otherwise, assume no permission by default
		$has_permission = false;
		
		// get the user ID
		$user_id = $this->_ci->session->userdata('user_id');
		
		// get the item ID if provided
		$segment = $this->_ci->uri->segment(2, false);
		if (is_integer($segment)) {
			$item_id = $segment;
		}
		
		// get the right action
		if ($action == 'index') $action = 'view';
		
		// query the db for role permissions
		$role_id = $this->_ci->session->userdata('role_id');
		$this->_ci->db->from('roles_permissions');
		$this->_ci->db->where('role_id', $role_id);
		$this->_ci->db->join('permissions', 'permissions.permission_id = roles_permissions.permission_id');
		$this->_ci->db->where('value', $action . '_' . $module);
		$has_permission = ($this->_ci->db->count_all_results() > 0);
		
		// if the user has permission, make sure he/she owns the item
		if ($has_permission) {
			switch($module) {
				case 'requests':
				case 'ministries':
				case 'groups':
					if (isset($item_id)) {
						$item_type = singular($module);
						$items = $this->_ci->$item_type->find_by_user_id($user_id);
						$item_ids = array();
						foreach ($items as $item) {
							$field = singular($module) . '_id';
							$item_ids[] = $item->$field;
						}
						$has_permission = in_array($item_id, $item_ids);
					}
					break;
				case 'messages':
					if ($messages = $this->_ci->message->find_by_recipient_id($user_id)) {
						$message_ids = array();
						foreach ($messages as $message) {
							$message_ids[] = $message->message_id;
						}
						if (isset($item_id)) {
							$has_permission = in_array($item_id, $item_ids);
						} else if ($segment == 'delete') {
							$ids = $this->_ci->input->post('ids');
							$intersection = array_intersect($ids, $message_ids);
							$has_permission = ($intersection == $ids);
						}
					}
					break;
			}
		}
		
		// return the result
		return $has_permission;
	}

}