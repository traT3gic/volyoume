<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * VMT
 *
 * A user management system for religious organizations.
 *
 * @package     VMT
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @copyright   Copyright (c) 2009 - 2010, Guillermo A. Fisher
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * VMT Connect Template Helpers
 *
 * @package     VMT
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @todo        Finish out documentation
 * @todo        Figure out what functions are needed
 * @todo        Figure out best way to output data in multiple ways
 */

// ------------------------------------------------------------------------
/**
 * Prints information about an expression.
 * 
 * @param mixed $x  The expression
 * @param bool $die  OPTIONAL Whether or not to stop script execution
 * @param bool $verbose  OPTIONAL Whether or not to print verbose information
 */
function dump($x, $die = false, $verbose = false)
{
	echo '<pre>';
	if ($verbose) {
		echo var_dump($x);
	} else {
		echo print_r($x, true);
	}
	echo '</pre>';
	if ($die) {
		exit;
	}
}

function session_info($string)
{
	$ci =& get_instance();
	return $ci->session->userdata($string);
}

function page_info($page_variable = '', $property = '', $format = '')
{
	$ci =& get_instance();
	$page = $ci->load->_ci_cached_vars['page'];
	$data = '';
	if (empty($page_variable)) {
    		$data = $page;
	} else {
		switch($page_variable) {
		    case 'screen':
		    	$file = APPPATH . '/views/screens/' . $page['screen'] . '.php';
	    		$screen = file_exists($file) ? $page['screen'] : 'empty';
				$data = $screen;
				break;
		    default:
	      		if (array_key_exists($page_variable, $page)) {
        	        $data = $page[$page_variable];
				}
				break;
		}
	}
	return $data;
}

function config_info($string)
{
	$ci =& get_instance();
	return $ci->config->item($string);
}

function nav_anchor($segment, $text, $attributes = array())
{
	$ci =& get_instance();
	$segments = explode('/', $segment);
	if ($segments[1] == $ci->uri->segment(1)) {
		$attributes['class'] = 'active';
	}
	return anchor($segment, $text, $attributes);
}

function set_item_form_value($field, $is_dropdown = false)
{
	$ci =& get_instance();
	$initial_value = null;
	if ($item = $ci->view->get('item')) {
		if (isset($item->$field)) {
			$initial_value = $item->$field;
		}
	}
	if (!$is_dropdown) {
		return set_value($field, $initial_value);
	} else {
		if ($value = $ci->input->post($field)) {
			return $value;
		}
		return $initial_value;
	}
}