<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Application Taxonomy
|--------------------------------------------------------------------------
|
| Use this section to define messages about the status of this application.
| Each status array should have the following array keys:
|
|		enabled		- whether or not the status message should be enabled
|   	message 	- the message to display
|		data 		- an array of data used in replacing variables in the message
|
| NOTE: Only one alert will be displayed at a time!
|
*/
$config['org'] = 'Calvary Revival Church, Norfolk';
$config['greeting'] = 'God bless';
$config['group_alias'] = 'ministry';
$config['feed_url'] = 'http://www.courtneysblogsite.com/feed/';
$config['feed_cache_lifetime'] = 720;
$config['admin_email'] = 'crcvols@crcglobal.org'; 

/*
|--------------------------------------------------------------------------
| Maintenance Mode
|--------------------------------------------------------------------------
|
| Determines whether or not the tool is in maintenance mode.
|
*/
$config['maintenance']['enabled'] = false;
$config['maintenance']['return_timestamp'] = strtotime('+3days');

/*
|--------------------------------------------------------------------------
| Status Alerts
|--------------------------------------------------------------------------
|
| Use this section to define messages about the status of this application.
| Each status array should have the following array keys:
|
|		enabled		- whether or not the status message should be enabled
|   	message 	- the message to display
|		data 		- an array of data used in replacing variables in the message
|
| NOTE: Only one alert will be displayed at a time!
|
*/
$config['alerts'] = array(

	'beta'			=> array(
		'enabled'	=> true,
		'message'	=> '<strong>This tool is in beta</strong>. Please report any issues to <a href="mailto:%s">%s</a>.',
		'data'		=> array($config['admin_email'], $config['admin_email'])
	),

	'maintenance'	=> array(
		'enabled'	=> false,
		'message'	=> 'This tool will be down for maintenance from %s to %s.',
		'data'		=> array()
	)

);




