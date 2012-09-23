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
 * VMT Minification Library
 *
 * This class provides functionality for minifying CSS and JavaScript files.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */
class VMT_Minify
{
	
	public function __construct()
	{
		$this->_ci =& get_instance();
	}
	
	// --------------------------------------------------------------------
	
	public function css($files)
	{
		// get the output
		$output = $this->_get_content('css', $files);
		
		// apply further css-specific logic
		$output .= '#codeigniter_profiler{clear:both;}';
		$output = str_replace(array("\n", "\r\n"), '', $output);
		
		// set the output
		$this->_set_output($output);
	}
	
	// --------------------------------------------------------------------
	
	public function js($files)
	{
		// get the output
		$output = $this->_get_content('js', $files);
		
		// minify the output further
		// add js minification here
				
		// set the output
		$this->_set_output($output);		
	}
	
	// --------------------------------------------------------------------
	
	protected function _get_content($type, $files)
	{
		// get the file list
		if (!is_array($files)) {
			$files = array($files);
		}
		
		// get the name of the file
		$name = implode('-', $files);
		
		// get the content
		ob_start();
		foreach ($files as $file) {
			if ($path = realpath($file . '.' . $extension)) {
				$content = file($path);
				echo implode('', $content);
			}
		}
		$content = ob_get_clean();
		
		// apply basic minification to the content
		$content = str_replace(array(' {', '{ '), '{', $content);
		$content = str_replace(array(' }', '} '), '}', $content);
		$content = str_replace(array(' ;', '; '), ';', $content);
		$content = str_replace(array(' :', ': '), ':', $content);
		$content = str_replace(array(' ,', ', '), ',', $content);
		$content = str_replace("\t", '', $content);		
		
		// return the content
		return $content;
	}

	// --------------------------------------------------------------------
	
	protected function _set_output($type, $output)
	{
		if ($content_type = $this->_get_type($type, 'content_type')) {
			$this->_ci->output->set_content_type($content_type);
			$this->_ci->output->set_output($output);
		}
	}
	
	// --------------------------------------------------------------------
	
	protected function _get_type($type, $option = '')
	{
		$types = $this->_ci->config->item('minify_types');
		foreach ($types as $t) {
			if ($t['name'] == $type) {
				if (is_null($option)) {
					return $t;
				}
				if (isset($t[$option])) {
					return $t[$option];
				}
			}
		}		
	}	
}
