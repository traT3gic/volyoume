<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MMT Connect
 *
 * A user management system for religious organizations.
 *
 * @package     MMT
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @copyright   Copyright (c) 2009 - 2010, Guillermo A. Fisher
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * MMT Connect Template Helpers
 *
 * @package     MMT
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @todo        Finish out documentation
 * @todo        Figure out what methods are needed
 * @todo        Figure out best way to output data in multiple ways
 */

// ------------------------------------------------------------------------

function show_401()
{
	$heading = 'Authentication Required';
	$message = 'You need a valid username and password to enter this area.';
	return show_error($message, 401, $heading);
}

function show_403()
{
	$heading = 'Access Forbidden';
	$message = 'Oops! You do not have permission to access this page. If you '
		. 'think you should, contact your administrator.';
	return show_error($message, 403, $heading);
}

function show_503()
{
	$ci =& get_instance();
	$heading = 'Undergoing Maintenance';
	$maintenance = $ci->config->item('maintenance');
	$timestamp = $maintenance['return_timestamp'];
	$datetime = date('g:i A \o\n F d, Y', $timestamp);
	$message = 'This site is presently down for maintenance. '
		. 'It will be ready for use at <strong>' . $datetime
		. '</strong>; so please check back at that time. Thank '
		. 'you for your patience!';
	return show_error($message, 503, $heading);	
}