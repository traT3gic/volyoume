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
 * VMT Exceptions Class
 *
 * This class, which inherits from CodeIgniter's exception class, adds some
 * much needed functionality to this application's error handling.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */
class VMT_Exceptions extends CI_Exceptions
{

	/**
	 * Overrides the {@link CI_Exceptions::show_error()} method and provides
	 * a customized error message as well as detailed error logging.
	 *
	 * @see CI_Exceptions::show_error()
	 */
	public function show_error($heading, $message, $template = 'error_general', $code = 500)
	{
		// get the requested page
		$page = filter_input(INPUT_SERVER, 'REQUEST_URI');

		// log the error
		log_message('error', '(' . $code .')' . ' ' . $heading
			. ' on ' . $page . ' => ' . $message);

		// if the error message is an array, implode it
		if (is_array($message)) {
			$message = implode(' ', $message);
		}	
			
		// if in debug mode, show a detailed error message
		if (VMT_DEBUG) {
			if (function_exists('xdebug_print_function_stack')) {
				xdebug_print_function_stack($message);
			} else {
				debug_print_backtrace();
			}
			exit;
		}
		
		// if not in debug mode, show a user-friendly message
		return parent::show_error($heading, $message, $template, $code);
	}

	// --------------------------------------------------------------------

	/**
	 * Shows the user an error page when they request a page that does not
	 * exist.
	 *
	 * @uses VMT_Exceptions::show_error()
	 */
	public function show_404()
	{
		$heading = 'Page Not Found';
		$message = 'The page you requested was not found.';
		return $this->show_error($heading, $message, '', 404);
	}
	
}