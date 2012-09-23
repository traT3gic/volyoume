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
 * VMT Application Controller Class
 *
 * This class, which extends CodeIgniter's core controller class, is the
 * base class for the controllers in this application.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */
class VMT_Controller extends CI_Controller
{
	
	/**
	 * The controller name.
	 * @var string
	 */	
	protected $_controller;	
	
	/**
	 * The requested command.
	 * @var string
	 */	
	protected $_command;	

	/**
	 * Whether or not the controller manages items.
	 * @var boolean
	 */
	protected $_is_manager = true;	
	
	/**
	 * The type of item on which this controller will be acting.
	 * @var string
	 */
	protected $_item_type;
	
	/**
	 * The human readable label for the type of item.
	 * @var string
	 */	
	protected $_item_type_label;
	
	/**
	 * The number of items to display on a page.
	 * @var int
	 */	
	protected $_items_per_page = 15;
	
	/**
	 * The total number of items.
	 * @var int
	 */	
	protected $_num_total_items;
	
	/**
	 * The ruleset used to validate data.
	 * @var string
	 */	
	protected $_item_validation_rule;

	// --------------------------------------------------------------------

    /**
	 * Constructor. Invokes CI Controller, applies application-wide, custom
	 * configuration settings, and registers needed models & libraries with
	 * the controller.
	*/
	final public function __construct()
	{
    	// invoke the parent constructor
		parent::__construct();
		
		// load the authentication library
		$this->load->library('VMT_Auth', '', 'auth');
		
		// load the view library
		$this->load->library('VMT_View', '', 'view');

		// change the error delimiters on the form validation library
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
		
		// load the data models
		$this->load->model('message_model', 'message');
		$this->load->model('user_model', 'user');
		$this->load->model('group_model', 'group');
		
		// if we're in maintenance mode, notify the user
		$maintenance = $this->config->item('maintenance');
		if (isset($maintenance['enabled']) && $maintenance['enabled']) {
			show_error($message, 503);
		}
		
		// redirect to the login screen if not logged in
		$this->_controller = strtolower(get_class($this)); 
		if ($this->_controller != 'account') {
			if (!$this->auth->is_logged_in()) {
				redirect('account/login');
			}
		}
		
		// pass the name of the controller
		$this->view->set('controller', $this->_controller);
		
		// set the item type
		if ($this->_is_manager) {
			$this->_item_type = singular($this->_controller);
			$this->_item_type_label = ucwords(humanize($this->_item_type));
			if ($this->_item_type == 'group') {
				$this->_item_type_label = ucwords(humanize(config_info('group_alias')));
			}
			$this->_item_validation_rule = $this->_item_type;
		}
		
		// display any alerts
		$alerts = $this->config->item('alerts');
		foreach ($alerts as $code => $settings) {
			if ($settings['enabled']) {
				$alert = vsprintf($settings['message'], $settings['data']);
				$this->view->set('alert', $alert);
				break;
			}
		}
		
		// set the user if we're logged in
		if ($this->auth->is_logged_in()) {
			$user_id = $this->session->userdata('user_id');
			$user = $this->user->find_by_id($user_id);
			$this->view->set('user', $user);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Handles all requests and routes them to the appropriate methods
	 * according to authentication settings.
	 * 
	 * @param string $method  OPTIONAL The requested controller method
	 */
	final public function _remap($method = 'index')
	{
		// execute initialization code
		$this->_init();
		
		// if this is NOT an item-managing controller, execute the method
		if (!$this->_is_manager) {
			$this->_command = $method;
		} else {
			// localize the item type
			$item_type = $this->_item_type;
			
			// derive the requested command
			$command = $id = null;
			if ($method != 'index') {
				// if ID is passed as second segment, command is third segment
				if (preg_match('/[0-9]+/', $method, $matches)) {
					if ($matches[0] == $method) {
						$command = $this->uri->segment(3, 'view');
						$id = $method;
					} else {
						show_404($method);
					}
				} else if ($method == 'new') {
					$command = 'create';
				} else if ($method == 'page') {
					$command = 'index';
					$this->view->set('screen', 'manager/index');
				} else if ($method == 'delete') {
					$command = 'delete';
				}
			} else {
				$command = 'index';
			}
			
			// set the command
			$this->_command = $command;
		}

		// check that the user has permission to execute the desired command
		if (!in_array($this->_controller, array('account', 'dashboard'))) {
			if (!$this->auth->has_permission($this->_controller, $this->_command)) {
				show_403($this->_controller);
			}
		}
		
		// execute the desired command
		$func = $this->_command;
		if ($this->_item_type && $func != 'index') {
			$func = '_' . $func;
		}		
		$this->$func();
		
		// render the page
		$this->_render();
	}
	
	// --------------------------------------------------------------------
	
	/**
     * Performs some initialization tasks before the request is fulfilled.
     */
    protected function _init(){}
    
	// --------------------------------------------------------------------
    
	/**
	 * Creates a new item of the current item type.
	 */	
	protected function _create()
	{
		$this->view->set('title', 'Create a New ' . $this->_item_type_label);
		if ($this->form_validation->run($this->_item_validation_rule)) {
			$data = $this->input->post();
			unset($data['submit']);			
			if ($this->{$this->_item_type}->create($data)) {
				$status = '%s successfully created.';
			} else {
				$status = 'An error occurred. Please try again later.';
			}
			$this->_set_status($status, $this->_item_type_label);
			redirect('/' . plural($this->_item_type));	
		}
	}	
	
	// --------------------------------------------------------------------

	/**
	 * Edits the requested item.
	 */	
	protected function _edit()
	{
		$this->view->set('title', 'Edit ' . $this->_item_type_label);
		$this->_set_item();
		$item = $this->view->get('item');
		if ($this->form_validation->run($this->_item_validation_rule)) {
			$id = $item->{$this->_item_type . '_id'};
			$data = $this->input->post();
			unset($data['submit']);
			if ($this->{$this->_item_type}->update($id, $data)) {
				$status = '%s successfully edited.';
			} else {
				$status = 'An error occurred. Please try again later.';
			}
			$this->_set_status($status, $this->_item_type_label);
			redirect('/' . plural($this->_item_type));
        }		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Deletes the requested items.
	 */
	protected function _delete()
	{
		$ids = array();
		$success_prefix = $this->_item_type_label;
		$segment = $this->uri->segment(2);
		if (is_integer($segment)) {
			$ids[] = $segment;
		} elseif ($ids = $this->input->post('ids')) {
			$success_prefix = plural($this->_item_type_label);		
		}
		if (!empty($ids)) {
			if ($this->{$this->_item_type}->delete($ids)) {
				$status = '%s succesfully deleted.';
			} else {
				$status = 'An error occurred. Please try again later.';
			}
			$this->_set_status($status, $success_prefix);
			redirect('/' . plural($this->_item_type));
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Displays the selected item.
	 */	
	protected function _view()
	{
		$this->view->set('title', 'View ' . $this->_item_type_label);
		$this->view->set('screen', plural($this->_item_type) . '/view');
		$this->_set_item();
	}	
	
	// --------------------------------------------------------------------

    /**
     * Sets defaults and some "global" variables, then loads the appropriate
     * layout to render the page.
     */
    final protected function _render()
    {
    	// localize the vol id
    	$user_id = $this->session->userdata('user_id');
    	
    	// get new messages
    	if ($this->auth->is_logged_in()) {
			$num_new_messages = $this->message->find_new_by_recipient_id($user_id, null, 0, true);
			$this->view->set('num_new_messages', $num_new_messages);
    	}

		// set the view container
    	$container = $this->auth->is_logged_in() ? 'master' : 'auth';
    	$this->view->set('container', $container);

    	// set the default item type
    	if (!$this->view->has('item_type')) {
    		if (strtolower(get_class($this)) == 'groups') {
    			$this->view->set('item_type', config_item('group_alias'));
    		} else {
    			$this->view->set('item_type', $this->_item_type);
    		}
    	}

        // set the default page title
        if (!$this->view->has('title')) {
        	$title = $this->uri->segment(3, 'view');
        	$title = str_replace('_', ' ', $title);
            $this->view->set('title', ucwords($title . ' ' . $this->_controller));
        }

        // set the default screen
        if (!$this->view->has('screen')) {
        	$action = $this->uri->segment(2, 'index');
        	if ($this->_is_manager) {
        		if ($action == 'index') {
        			$action = 'index';
        		} else {
        			$action = 'manage';
        		}
        	}
	        $screen = $this->_controller . '/' . $action;
	        if (!file_exists(APPPATH.'/views/screens/'.$screen.'.php')) {
	        	$screen = 'empty';
	        	if (file_exists(APPPATH.'/views/screens/'.$action.'.php')) {
	        		$screen = $action;
	        	}
	        }
	        $this->view->set('screen', $screen);
        }
        
        // set pagination if it's an index
        if ($this->_command == 'index' && $this->_is_manager) {
			$this->config->item('base_url', site_url("{$this->_controller}/page"));
			$this->config->item('total_rows', $this->_num_total_items);
			$this->config->item('per_page', $this->_items_per_page);	        	
	        $this->view->set('pagination', $this->pagination->create_links());
        }
        
        // set the body element's class
		$body_class = $this->uri->segment(1, 'dashboard');
		if ($body_class == 'users') {
			$body_class = 'profile'; 
		}
		$this->view->set('body_class', $body_class);
        
        // set the path to the actions template
        $actions = 'common/actions';
        $local_actions = 'screens/' . $this->_controller . '/actions';
        if (file_exists(APPPATH . '/views/' . $local_actions . '.php')) {
	        $actions = $local_actions;
		}
		$this->view->set('actions', $actions);
        
        // pull in the feed
        if ($feed_url = config_item('feed_url')) {
        	$this->load->library('VMT_Rss', '', 'rss');
        	$feed = $this->rss->parse(config_item('feed_url'), 5, config_item('feed_cache_lifetime'));
        	$this->view->set('feed', $feed);
        }

        // load the view
        $this->view->render('master');
    }
    
	// --------------------------------------------------------------------

	/**
     * Sets the requested item.
     */     
    protected function _set_item()
    {
		$id = $this->uri->segment(2);
		if ($item = $this->{$this->_item_type}->find_by_id($id)) {
			$this->view->set('item', $item);
		} else {
			$message = 'Cannot find the requested ' . $this->_item_type . '.'; 
			show_error($message, 404);
		}
    }     
    
	// --------------------------------------------------------------------

	/**
     * Sets a status message using session flashdata.
     * 
     * @param string $status  The status message
     * @param mixed $replacements  OPTIONAL The replacement values if $status is
     * 							   a pattern
     */    
    protected function _set_status($status, $replacements = null)
    {
    	$status = '';
    	if (func_num_args() <= 1) { 
    		$status = $status;
		} else {
			$status = call_user_func_array('sprintf', func_get_args());
		}
		$this->session->set_flashdata('status', $status);
    }
    
	// --------------------------------------------------------------------

	/**
     * Gets the filtered post data.
     * 
     * @return array  The post data
     */     
    protected function _get_post()
    {
    	$data = array();
    	$extra_data = array('submit', 'password_confirmation');
    	foreach($_POST as $k => $v) {
    		$is_extra = in_array(strtolower($k), $extra_data);
    		$is_temp = (substr(strtolower($k), 0, 4) == '_tmp');
    		if (!$is_extra && !$is_temp) {
    			$data[$k] = $this->input->post($k);
    		}
    	}
    	return $data;
    }
        
}
