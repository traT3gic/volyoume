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
 * VMT Application View Class
 *
 * This class helps further separate application logic from presentation logic.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */
class VMT_View
{

	/**
	 * An instance of the CI super object.
	 * @var object
	 */	
	private $_ci;
	
	/**
	 * Variables that will be accessed in the views.
	 * @var array
	 */
	private $_view_data = array();
	
	// --------------------------------------------------------------------

    /**
	 * Constructor. Invokes CI Controller, applies application-wide, custom
	 * configuration settings, and registers needed models & libraries with
	 * the controller.
	 * @return null
	*/
	public function __construct()
	{
		$this->_ci =& get_instance();
    	$this->_ci->output->enable_profiler(VMT_DEBUG);
    	$this->_ci->load->library('table');
	}

	// --------------------------------------------------------------------
	
	/**
     * Sets defaults and some "global" variables, then loads the appropriate
     * layout to render the page.
     */	
	public function render($template = 'master')
	{
        $this->_ci->load->view('master', array('page'=>$this->_view_data));
	}

	// --------------------------------------------------------------------
	
	/**
	 * Sets the value of variables accessible by the view.
	 * 
	 * @param string $key  The name of the variable
	 * @param mixed $value  The value of the variable
	 * @param mixed $replacements  OPTIONAL Replacement values
	 */
	public function set($key, $value, $replacements = null)
	{
		if (func_num_args() <= 2) { 
			$this->_view_data[$key] = $value;
		} else {
			$args = array_slice(func_get_args(), 1);
			$this->_view_data[$key] = call_user_func_array('sprintf', $args);
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Retrieves the value of a view variable.
	 * 
	 * @param string $key  The name of the key
	 * @return mixed
	 */
	public function get($key)
	{
		if ($this->has($key)) {
			return $this->_view_data[$key];
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Determines whether or not a given view variable exists.
	 * 
	 * @param string $key  The desired view variable
	 * @return bool
	 */
	public function has($key)
	{
		return array_key_exists($key, $this->_view_data);
	}
	
}